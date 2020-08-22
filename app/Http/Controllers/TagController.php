<?php

namespace App\Http\Controllers;

use App\{ Tag, Question };

use Auth;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $get_data = Tag::whereTag_id(null)->get();
      $params = [
          'title'=>'Tag',
          'data'=>$get_data,
          'tag_id'=>null,
          'name_tag'=>null,
          'tag'=>null
      ];
      return view('backoffice.tag.view')->with($params);
    }

    public function look($id)
    {
      $get_data = Tag::whereTag_id($id)->get();
      $tag = Tag::whereId($id)->first();
      $params = [
          'title'=>'Tag',
          'data'=>$get_data,
          'tag_id'=>$id,
          'tag'=>$tag
      ];
      return view('backoffice.tag.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'branch_id'=>Auth::user()->branch_id,
        'tag_id'=>$request->get('tag_id'),
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
      ];
      try {
        Tag::create($put);
        return redirect()->back()->with('success','Successful add new tag');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = Tag::whereId($id)->firstOrFail();
      $put = [
        // 'tag_id'=>$request->get('tag_id'),
        'branch_id'=>Auth::user()->branch_id,
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
      $data = Tag::whereId($request->get('stateId'))->firstOrFail();

      if(Tag::whereTag_id($data->id)->count()){
        return redirect()->back()->with('error','Gagal menghapus, Tag masih memiliki child');
      }
      if(Question::whereTag_id($data->id)->count()){
        return redirect()->back()->with('error','Gagal menghapus, Tag masih digunakan di Question');
      }
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
