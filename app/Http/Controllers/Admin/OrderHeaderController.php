<?php

namespace App\Http\Controllers\Admin;



use App\Exports\OrdersExport;
use App\Exports\ShippingSheetSheetExport;
use App\Http\Controllers\Application\FawryPaymentController;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\ExportOrderHeadersSheet;
use App\Http\Requests\ExportShippingSheetSheetRequest;
use App\Http\Requests\OrderHeaderRequest;
use App\Http\Services\OrderService;
use App\Models\OrderHeader;
use App\Models\OrderLine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderHeaderController extends HomeController
{
    private $OrderHeaderService;
    private $OrderRequest;

    public function __construct(OrderService $OrderHeaderService ,Request  $OrderRequest)
    {
        $this->OrderHeaderService  = $OrderHeaderService;
        $this->OrderRequest        = $OrderRequest;
    }

    public function index()
    {
        $data = $this->OrderHeaderService->getAll(request()->all());
        return view('AdminPanel.PagesContent.OrderHeaders.index')->with('orderHeaders',$data);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show(OrderHeader $orderHeader)
    {
        $orderNumber=$orderHeader->id;
        $invoicesCount=OrderLine::select('oracle_num')->where('order_id',$orderNumber)->distinct()->count('oracle_num');
        $invoicesNumber=OrderLine::select('oracle_num')->where('order_id',$orderNumber)->distinct()->get();
        $invoicesLines =DB::select('SELECT ol.oracle_num ,p.price pprice,p.tax ptax,ol.price olprice,p.name_en psku,ol.quantity olquantity FROM order_lines ol,products p
     	                        where 	ol.order_id ='.$orderNumber.'
     	                        and ol.product_id = p.id ');
        $invoicesTotalPrice=OrderLine::where('order_id',$orderNumber)->sum('quantity');
        $user=User::where('id',$orderHeader->created_for_user_id)->first();
        return view('AdminPanel.PagesContent.OrderHeaders.show',compact('orderHeader','invoicesNumber','invoicesCount','invoicesLines','invoicesTotalPrice','user'));
    }

    public function edit(OrderHeader $OrderHeader)
    {

    }

    public function update(OrderHeaderRequest $request,$id)
    {

    }
    public function destroy(OrderHeader $product)
    {

    }

    public function ExportOrderHeadersSheet(ExportOrderHeadersSheet $request)
    {
        $validated = $request->validated();
        try {
            return Excel::download(new OrdersExport($validated['start_date'],$validated['end_date']), 'orders.xlsx');
        }
        catch (\Exception $exception)
        {

            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function ExportShippingSheetSheet()
    {
        return view('AdminPanel.PagesContent.OrderHeaders.shippingSheet');
    }

    public function HandelExportShippingSheetSheet(ExportShippingSheetSheetRequest $request)
    {
        $validated = $request->validated();
        try {
            return Excel::download(new ShippingSheetSheetExport($validated['start_date'],$validated['end_date']), 'orders.xlsx');
        }
        catch (\Exception $exception)
        {

            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function ChangeStatusForOrder()
    {
        $orderHeaders = $this->OrderHeaderService->getPendingOrders();
        return view('AdminPanel.PagesContent.OrderHeaders.changeOrderStatus',compact('orderHeaders'));
    }

    public function HandelChangeStatusForOrder(ChangeStatusRequest  $request)
    {
        $inputs            = $request->validated();
        $order_id          = $inputs['order_id'];
        $data['item_code'] = "orderNumber-".$order_id;
        $this->OrderRequest->request->add([
            'fawryRefNumber' => '123454',
            'orderStatus'    => 'PAID',
            'paymentMethod' => 'BackEndPAY',
            'orderItems' => [
                $data
            ]
        ]);
        $order = app(FawryPaymentController::class)->changeOrderStatus($this->OrderRequest);
        return redirect()->back()->with(['message' => json_encode($order->original)]);
    }
}
