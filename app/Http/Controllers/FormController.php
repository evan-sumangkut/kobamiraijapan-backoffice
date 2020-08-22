<?php

namespace App\Http\Controllers;

use App\{ Form, Question, FormQuestion, Tag, Branch };

use Auth;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      if(Auth::user()->branch_id){
        $get_data = Form::whereBranch_id(Auth::user()->branch_id)->orderBy('id','asc')->get();
      }else{
        $get_data = Form::orderBy('id','desc')->get();
      }
      $branch = Branch::all();
      $params = [
          'title'=>'Form Builder',
          'data'=>$get_data,
          'branch'=>$branch
      ];
      return view('backoffice.form.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
      ];
      if(Auth::user()->branch_id){
        $put['branch_id'] = Auth::user()->branch_id;
      }else{
        $put['branch_id'] = $request->get('branch_id');
      }
      try {
        Form::create($put);
        return redirect()->back()->with('success','Successful add new form');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = Form::whereId($id)->firstOrFail();
      $put = [
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
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
      $data = Form::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function view_question($id)
    {
      $form = Form::whereId($id)->first();
      $get_data = FormQuestion::whereForm_id($id)->orderBy('qid','asc')->get();
      $last_question = FormQuestion::whereForm_id($id)->orderBy('qid','desc')->first();
      if($last_question){
        $last_id = $last_question->qid;
      }else{
        $last_id = 0;
      }
      $stu_id = [];
      foreach($get_data as $d){
        array_push($stu_id,$d->question_id);
      }
      // if(Auth::user()->branch_id){
      //   $question = Question::whereNotIn('id',$stu_id)->whereBranch_id(Auth::user()->branch_id)->orderBy('id','asc')->get();
      // }else{
        $question = Question::whereNotIn('id',$stu_id)->orderBy('id','asc')->get();
      // }
      $params = [
          'title'=>'Form '.$form->name,
          'data'=>$get_data,
          'question'=>$question,
          'form'=>$form,
          'last_qid'=>$last_id+1
      ];
      return view('backoffice.form.question')->with($params);
    }
    public function create_question(Request $request,$id)
    {
      $question = Question::whereId($request->get('question_id'))->first();
      // $tag = Tag::all();
      // $choices = explode("~",$question->choice);
      // $choices_description = explode("~",$question->choice_description);
      $params = [
          'title'=>'Add Question',
          'question'=>$question,
          'form_id'=>$id,
          // 'choice'=>$choices,
          // 'choice_description'=>$choices_description,
          'qid'=>$request->get('qid'),
          // 'tag'=>$tag
      ];
      return view('backoffice.form.question_create')->with($params);

      // $put = [
      //   'form_id'=>$id,
      //   'qid'=>$request->get('qid'),
      //   'question_id'=>$request->get('question_id')
      // ];
      // try {
      //   FormQuestion::create($put);
      //   return redirect()->back()->with('success','Successful add new question');
      // } catch (\Exception $e) {
      //   return redirect()->back()->with('error','Error info: '.$e->getMessage());
      // }
    }

    public function add_question(Request $request,$id)
    {
      // $scoring = implode('~',$request->get('scoring'));
      // $tag = implode(',',$request->get('tags_id'));
      $form = Form::whereId($id)->first();
      $put = [
        'form_id'=>$id,
        'qid'=>$request->get('qid'),
        'branch_id'=>$form->branch_id,
        // 'tag'=>$tag,
        'question_id'=>$request->get('question_id'),
        // 'choice_next_qid'=>$request->get('choice_next_qid'),
        // 'scoring'=>$scoring,
        // 'duration'=>$request->get('duration'),
        // 'next_qid'=>$request->get('next_qid'),
        'choice'=>implode('~',$request->get('choice')),
        'choice_description'=>implode('~',$request->get('choice_description'))
      ];
      try {
        FormQuestion::create($put);
        return redirect()->route('form.question',$id)->with('success','Successful add new question');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update_question(Request $request)
    {
      $id = $request->get('stateId');
      $data = FormQuestion::whereId($id)->firstOrFail();

      $qid = $request->get('qid');

      $put = [
        // 'qid'=>$request->get('qid'),
        // 'question_id'=>$request->get('question_id'),
        // 'choice_next_qid'=>$request->get('choice_next_qid'),
        'scoring'=>$request->get('scoring'),
        // 'duration'=>$request->get('duration'),
        // 'next_qid'=>$request->get('next_qid'),
        'choice'=>$request->get('choice'),
        'choice_description'=>$request->get('choice_description')
      ];

      if($data->qid!=$qid){
        $other = FormQuestion::whereQid($qid)->first();
        if($other){
            $other->update(['qid'=>$data->qid]);;
        }
        $put['qid'] = $qid;
      }
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function delete_question(Request $request)
    {
      $data = FormQuestion::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
