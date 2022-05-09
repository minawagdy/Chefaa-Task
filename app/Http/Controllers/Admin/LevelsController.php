<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\IAccountLevelRepository;
use Illuminate\Http\Request;

class LevelsController extends HomeController
{
    //

    private $levels;
    public function __construct(IAccountLevelRepository $levels)
    {
        $this->levels=$levels;
    }

    public function index(){

        $data=$this->levels->getAllData(request()->all());
        return view('AdminPanel.PagesContent.Levels.index')->with('levels',$data);
    }
}
