<?php

namespace App\Http\Controllers;

use App\{ Form, Question, FormQuestion, Tag };

use Auth;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $get_data = Form::all();
      $params = [
          'title'=>'Scenario Builder',
          'data'=>$get_data
      ];
      return view('backoffice.scenario.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
      ];
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

    public function view_weight($id)
    {
      $form = Form::whereId($id)->first();
      $get_data = FormQuestion::whereForm_id($id)->orderBy('qid','asc')->get();
      $last_question = FormQuestion::whereForm_id($id)->orderBy('qid','desc')->first();
      if($last_question){
        $last_id = $last_question->qid;
      }else{
        $last_id = 0;
      }
      $question = Question::all();
      $params = [
          'title'=>'Form '.$form->name,
          'data'=>$get_data,
          'question'=>$question,
          'form'=>$form,
          'last_qid'=>$last_id+1
      ];
      return view('backoffice.scenario.weight')->with($params);
    }

    public function update_weight(Request $request)
    {
      $form_question_ids = $request->get('form_question_ids');
      $bobots = $request->get('bobots');

      try {
        for ($i = 0; $i <= count($form_question_ids) - 1; $i++){
          $data = FormQuestion::whereId($form_question_ids[$i])->update(['bobot'=>$bobots[$i]]);
        }
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function view_schedule($id)
    {
      $form = Form::whereId($id)->first();
      $get_data = FormQuestion::whereForm_id($id)->orderBy('qid','asc')->get();
      $last_question = FormQuestion::whereForm_id($id)->orderBy('qid','desc')->first();
      if($last_question){
        $last_id = $last_question->qid;
      }else{
        $last_id = 0;
      }
      $question = Question::all();
      $params = [
          'title'=>'Set Schedule',
          'data'=>$get_data,
          'question'=>$question,
          'form'=>$form,
          'last_qid'=>$last_id+1
      ];
      return view('backoffice.scenario.schedule')->with($params);
    }

    public function update_schedule(Request $request)
    {
      $form_question_ids = $request->get('form_question_ids');
      $bobots = $request->get('bobots');

      try {
        for ($i = 0; $i <= count($form_question_ids) - 1; $i++){
          $data = FormQuestion::whereId($form_question_ids[$i])->update(['bobot'=>$bobots[$i]]);
        }
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }
}
