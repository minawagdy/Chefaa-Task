<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderTypesCommissions\CreateUserCommission;
use App\Mail\RegistrationEmail;

use App\Models\City;
use App\Models\Image;//d
use App\Models\OrderHeader;
use App\Models\OrderLine;
use App\Models\Paragraph;//d;

use App\Models\RegisterLink;
use App\Models\User;
use App\Models\Area;
use App\Models\AccountType as Accout_type;
use App\Models\AccountLevel as Account_levels;
use App\Models\NettingJoin as Nettingjoin;
use App\Models\UserCommission as User_commission;
use App\Models\UserCommission;
use App\SendMessage\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function home()
    {

        return view('HomePage');
    }


    public function productDetails($id)
    {
       return view('productDetails',compact('id'));
    }
}
