<?php

namespace App\Http\Controllers;

use App\{ Category, Branch };

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $branch = Branch::all();
      $get_data = Category::all();
      $params = [
          'title'=>'Category',
          'data'=>$get_data,
          'branch'=>$branch
      ];
      return view('backoffice.category.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'branch_id'=>$request->get('branch_id'),
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
      ];
      try {
        Category::create($put);
        return redirect()->back()->with('success','Successful add new category');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = Category::whereId($id)->firstOrFail();
      $put = [
        'branch_id'=>$request->get('branch_id'),
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
      ];
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function delete(Request $request)
    {
      $data = Category::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
