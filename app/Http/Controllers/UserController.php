<?php

namespace App\Http\Controllers;

use App\{ User, Branch };

use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $get_data = User::orderBy('name','asc')->get();
      $branch = Branch::all();
      $params = [
          'title'=>'User',
          'data'=>$get_data,
          'user_id'=>null,
          'branch'=>$branch
      ];
      return view('backoffice.user.view')->with($params);
    }

    public function look($id)
    {
      $get_data = User::whereUser_id($id)->get();
      $params = [
          'title'=>'User',
          'data'=>$get_data,
          'user_id'=>$id
      ];
      return view('backoffice.user.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'branch_id'=>$request->get('branch_id'),
        'name'=>$request->get('name'),
        'email'=>$request->get('email'),
        'password'=>bcrypt($request->get('password')),
      ];
      try {
        User::create($put);
        return redirect()->back()->with('success','Successful add new user');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = User::whereId($id)->firstOrFail();
      $put = [
        'branch_id'=>$request->get('branch_id'),
        'name'=>$request->get('name'),
        'email'=>$request->get('email'),
      ];
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function password(Request $request)
    {
      $id = $request->get('stateId');
      $data = User::whereId($id)->firstOrFail();
      $put = [
        'password'=>bcrypt($request->get('password')),
      ];
      try {
        $data->update($put);
        return redirect()->back()->with('success','Password successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function delete(Request $request)
    {
      $data = User::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
