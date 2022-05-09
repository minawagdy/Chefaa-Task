<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PharmacyRequest;
use App\Http\Services\PharmacyService;
use App\Models\Pharmacy;

class PharmacyController extends Controller
{

    private $PharmacyService;

    public function __construct(PharmacyService $PharmacyService)
    {
        $this->PharmacyService         = $PharmacyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->PharmacyService->getAll(request()->all());
        return view('AdminPanel.PagesContent.Pharmacy.index')->with('pharmacy',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.PagesContent.Pharmacy.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyRequest $request)
    {
        $validated = $request->validated();
        $this->PharmacyService->createRow($validated);
        return redirect()->route('pharmacy.index')->with('message','Pharmacy Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        return view('AdminPanel.PagesContent.Pharmacy.edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyRequest $request, $id)
    {
        $validated = $request->validated();
        $this->PharmacyService->updateRow($validated , $id);
        return redirect()->route('pharmacy.index')->with('message','Pharmacy Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacy.index')->with('message', 'Pharmacy Deleted Successfully');
    }
}
