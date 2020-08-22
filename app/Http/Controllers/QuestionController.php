<?php

namespace App\Http\Controllers;

use App\{ Question, Tag, Branch };

use Auth;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $tag = Tag::all();
      $branch = Branch::all();
      // if(Auth::user()->branch_id){
      //   $get_data = Question::whereBranch_id(Auth::user()->branch_id)->orderBy('id','desc')->get();
      // }else{
      //   $get_data = Question::orderBy('id','desc')->get();
      // }
      $get_data = Question::orderBy('created_at','asc')->get();
      $params = [
          'title'=>'Question',
          'data'=>$get_data,
          'tag'=>$tag,
          'branch'=>$branch
      ];
      return view('backoffice.question.view')->with($params);
    }

    public function create()
    {
      $tag = Tag::all();
      $branch = Branch::all();
      $get_data = Question::all();
      $params = [
          'title'=>'Add Question',
          'data'=>$get_data,
          'tag'=>$tag,
          'branch'=>$branch
      ];
      return view('backoffice.question.create')->with($params);
    }

    public function add(Request $request)
    {
      $tag = implode(',',$request->get('tags_id'));
      // $tag = $request->get('tags_id');
      $put = [
        'tag_id'=>$tag,
        'type_content'=>$request->get('type_content'),
        'content'=>$request->get('content'),
        // 'choice'=>implode('~',$request->get('choice')),
        // 'choice_description'=>implode('~',$request->get('choice_description'))
      ];
      if(Auth::user()->branch_id){
        $put['branch_id'] = Auth::user()->branch_id;
      }else{
        $put['branch_id'] = $request->get('branch_id');
      }

      try {
        Question::create($put);
        return redirect()->route('question')->with('success','Successful add new question');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = Question::whereId($id)->firstOrFail();
      $put = [
        'tag_id'=>$request->get('tag_id'),
        'type_content'=>$request->get('type_content'),
        'content'=>$request->get('content'),
        'choice'=>$request->get('choice'),
        'choice_description'=>$request->get('choice_description')
      ];
      if(!Auth::user()->branch_id){
        $put['branch_id']=$request->get('branch_id');
      }
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function delete(Request $request)
    {
      $data = Question::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
