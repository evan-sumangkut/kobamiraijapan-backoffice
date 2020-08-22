<?php

namespace App\Http\Controllers;

use App\{ User };
use Auth;
use Hash;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backoffice.home');
    }

    public function user_update(Request $request)
    {
      $password_lama = $request->get('password_lama');
      $password = $request->get('password');
      $password_ulang = $request->get('password_ulang');
      $put = [
        'name'=>$request->get('name'),
        'email'=>$request->get('email'),
      ];
      $data = User::whereId(Auth::user()->id)->first();

      if($password_lama || $password || $password_ulang){
          if (!Hash::check($password_lama, $data->password)) {
            return redirect()->back()->with('warning','Old Password not Match');
          }
          if ($password!=$password_ulang) {
            return redirect()->back()->with('warning','New Password not Match');
          }
          $put['password'] = bcrypt($password);
      }
      try {
        $data->update($put);
        return redirect()->back()->with('success','Successful update user');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
