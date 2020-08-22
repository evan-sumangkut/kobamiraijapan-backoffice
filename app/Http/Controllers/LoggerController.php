<?php

namespace App\Http\Controllers;

use App\{ Logger };

use Auth;

use Illuminate\Http\Request;

class LoggerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {


      if(Auth::user()->branch_id){
        $get_data = Logger::whereBranch_id(Auth::user()->branch_id)->orderBy('created_at','asc')->take(1000)->get();
      }else{
        $get_data = Logger::orderBy('created_at','asc')->take(1000)->get();
      }

      $params = [
          'title'=>'Logger',
          'data'=>$get_data
      ];
      return view('backoffice.logger.view')->with($params);
    }

}
