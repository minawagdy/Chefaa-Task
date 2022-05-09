<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UserWalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    private $WalletService;

    public function __construct(UserWalletService  $WalletService)
    {
        $this->WalletService = $WalletService;
    }


    public function index(){

        $data=$this->WalletService->getAll(request()->all());

        return view('AdminPanel.PagesContent.Wallets.index')->with('wallets',$data);
    }

}
