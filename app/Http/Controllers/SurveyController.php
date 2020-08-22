<?php

namespace App\Http\Controllers;

use App\{ Survey, SurveyForm, SurveyResponden, SurveyFormQuestion, SurveyFormConfirmation, Form, Responden, FormQuestion, TransactionSurvey, TransactionSurveyValue, Branch, SurveyGreeting };

use Illuminate\Http\Request;
use DB;
use Auth;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      if(Auth::user()->branch_id){
        $get_data = Branch::whereId(Auth::user()->branch_id)->orderBy('id','desc')->get();
      }else{
        $get_data = Branch::orderBy('id','desc')->get();
      }
      $params = [
          'title'=>'Scenario Builder',
          'data'=>$get_data
      ];
      return view('backoffice.survey.view')->with($params);
    }

    public function survey($id)
    {
      if(Auth::user()->branch_id){
        $get_data = Survey::whereBranch_id(Auth::user()->branch_id)->orderBy('id','desc')->get();
      }else{
        $get_data = Survey::whereBranch_id($id)->orderBy('id','desc')->get();
      }
      $branch = Branch::all();
      $params = [
          'title'=>'Survey Builder',
          'data'=>$get_data,
          'branch'=>$branch,
          'id'=>$id
      ];
      return view('backoffice.survey.survey')->with($params);
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
        Survey::create($put);
        return redirect()->back()->with('success','Successful add new survey');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = Survey::whereId($id)->firstOrFail();
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
      $data = Survey::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function opening(Request $request)
    {
      $id = $request->get('stateId');
      $data = Survey::whereId($id)->firstOrFail();
      if($data->is_opening){
        $put = ['is_opening'=>0];
      }else{
        Survey::whereIs_opening(1)->update(['is_opening'=>0]);
        $put = ['is_opening'=>1];
      }
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function active(Request $request)
    {
      $id = $request->get('stateId');
      $data = Survey::whereId($id)->firstOrFail();
      if($data->is_active){
        $put = ['is_active'=>0];
      }else{
        $put = ['is_active'=>1];
      }
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function view_form($id)
    {
      $get_data = SurveyForm::whereSurvey_id($id)->orderBy('order','asc')->get();
      $last_order = SurveyForm::whereSurvey_id($id)->orderBy('order','desc')->first();
      if($last_order){
        $order = $last_order->order+1;
      }else{
        $order = 1;
      }
      $stu_id = [];
      foreach($get_data as $d){
        array_push($stu_id,$d->form_id);
      }
      // $form = Form::whereNotIn('id',$stu_id)->get();
      if(Auth::user()->branch_id){
        $form = Form::whereBranch_id(Auth::user()->branch_id)->orderBy('id','asc')->get();
      }else{
        $form = Form::orderBy('id','asc')->get();
      }
      $params = [
          'title'=>'Form Survey',
          'data'=>$get_data,
          'form'=>$form,
          'id'=>$id,
          'order'=>$order,
          'branch_id'=>$last_order->branch_id
      ];
      return view('backoffice.survey.form')->with($params);
    }

    public function create_form(Request $request,$id)
    {
      $survey_form = SurveyForm::whereId($id)->firstOrFail();
      $form_question = FormQuestion::whereForm_id($survey_form->form_id)->get();
      $params = [
        'title'=>'Question Score',
        'survey_form_id'=>$survey_form->id,
        'survey_id'=>$survey_form->survey_id,
        'form_question'=>$form_question
      ];
      // foreach ($form_question as $key => $value) {
      //   dd($value->question->choice);
      // }
      try {
        return view('backoffice.survey.form_create')->with($params);
        // SurveyForm::create($put);
        // return redirect()->back()->with('success','Successful add form');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function form_question(Request $request,$id)
    {
      $survey_form = SurveyForm::whereId($id)->firstOrFail();
      $form_question = FormQuestion::whereForm_id($survey_form->form_id)->orderBy('qid','asc')->get();
      $params = [
        'title'=>'Question Score',
        'survey_form_id'=>$survey_form->id,
        'survey_id'=>$survey_form->survey_id,
        'form_question'=>$form_question
      ];
      // foreach ($form_question as $key => $value) {
      //   dd($value->question->choice);
      // }
      try {
        return view('backoffice.survey.form_question')->with($params);
        // SurveyForm::create($put);
        // return redirect()->back()->with('success','Successful add form');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function form_question_add(Request $request,$id)
    {
      $state = $request->get('state');
      $score = $request->get('content');
      try {
        $survey_form = SurveyForm::whereId($id)->first();
        $form = Form::whereId($survey_form->form_id)->first();
        $form_question = FormQuestion::whereForm_id($form->id)->get();
        $total_max = 0;
        $total_min = 0;
        foreach($form_question as $d){
          $max = max($request->get('scoring_'.$d->id));
          $min = min($request->get('scoring_'.$d->id));
          $get_data = implode('~',$request->get('scoring_'.$d->id));
          $put_key = [
            'survey_form_id'=>$survey_form->id,
            'form_question_id'=>$d->id
          ];
          $put_data = [
            'score'=>$get_data
          ];
          $total_max += $max;
          $total_min += $min;
          SurveyFormQuestion::updateOrCreate(
              $put_key,
              $put_data
          );
        }
        $put_survey_form = [
          'max'=>$total_max,
          'min'=>$total_min
        ];
        $survey_form->update($put_survey_form);
        return redirect()->route('survey.form',$survey_form->survey_id)->with('success','Successful add score');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function form_confirmation(Request $request,$id)
    {
      $survey_form = SurveyForm::whereId($id)->firstOrFail();
      $survey_form_all = SurveyForm::whereSurvey_id($survey_form->survey_id)->where('type','!=','confirmation')->get();
      $survey_form_question = SurveyFormQuestion::whereSurveyFormId($id)->get();
      $params = [
        'title'=>'Question Confirmation',
        'survey_form_id'=>$survey_form->id,
        'survey_id'=>$survey_form->survey_id,
        'form_question'=>$survey_form_question,
        'survey_form'=>$survey_form_all
      ];
      try {
        return view('backoffice.survey.form_confirmation')->with($params);
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function form_confirmation_create(Request $request,$id)
    {

      $survey_form_id = $id;
      $survey_form_question_id = $request->get('stateId');
      $condition = $request->get('condition');
      $to_survey_form_id = $request->get('to_survey_form_id');
      $params = [
        'title'=>'Question Confirmation Create',
        'survey_form_id'=>$survey_form_id,
        'survey_form_question_id'=>$survey_form_question_id,
        'to_survey_form_id'=>$to_survey_form_id,
        'condition'=>$condition
      ];
      if($condition=='respond'){
        $survey_form = SurveyForm::whereId($to_survey_form_id)->firstOrFail();
        $params['survey_form'] = $survey_form;
      }
      try {
        return view('backoffice.survey.form_confirmation_create')->with($params);
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function form_confirmation_add(Request $request)
    {
      $params = [
        "survey_form_id" => $request->get('survey_form_id'),
        "survey_form_question_id" => $request->get('survey_form_question_id'),
        "method" => $request->get('method'),
        "operation" => $request->get('operation'),
        "if_score" => $request->get('if_score'),
        "to_survey_form_id" => $request->get('to_survey_form_id'),
      ];
      if($request->get('method')=='score_all'){
        $params['to_survey_form_id'] = null;
      }
      if($request->get('method')=='respond'){
        $respond_id = $request->get('respond_id');
        $respond_break = explode('-',$respond_id);
        $to_form_question_id = $respond_break[0];
        $if_respond = $respond_break[1];
        $params['to_form_question_id'] = $to_form_question_id;
        $params['if_respond'] = $if_respond;
      }
      try {
        SurveyFormConfirmation::create($params);
        return redirect()->route('survey.form.confirmation',$request->get('survey_form_id'))->with('success','Successful add validation');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function form_confirmation_delete(Request $request)
    {
      $data = SurveyFormConfirmation::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Validation successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }











    public function add_form(Request $request,$id)
    {
      $survey = Survey::whereId($id)->firstOrFail();
      $put = [
        'branch_id'=>$survey->branch_id,
        'survey_id'=>$id,
        'form_id'=>$request->get('form_id'),
        'type'=>$request->get('type'),
        'order'=>$request->get('order')
      ];
      try {
        SurveyForm::create($put);
        return redirect()->back()->with('success','Successful add form');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update_form(Request $request)
    {
      $id = $request->get('stateId');
      $data = SurveyForm::whereId($id)->firstOrFail();
      $put = [
        'order'=>$request->get('order')
      ];
      try {
        $data->update($put);
        return redirect()->back()->with('success','Data successfuly updated');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function delete_form(Request $request)
    {
      $data = SurveyForm::whereId($request->get('stateId'))->firstOrFail();
      try {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $data->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function view_responden($id)
    {
      $get_data = SurveyResponden::whereSurvey_id($id)->get();
      $survey = Survey::where('id','!=',$id)->get();
      $stu_id = [];
      foreach($get_data as $d){
        array_push($stu_id,$d->form_id);
      }
      $form = Responden::whereNotIn('id',$stu_id)->get();
      $params = [
          'title'=>'Form Responden',
          'data'=>$get_data,
          'form'=>$form,
          'id'=>$id,
          'survey'=>$survey
      ];
      return view('backoffice.survey.responden')->with($params);
    }

    public function add_responden(Request $request,$id)
    {
      $put = [
        'survey_id'=>$id,
        'responden_id'=>$request->get('responden_id'),
      ];
      try {
        SurveyResponden::create($put);
        return redirect()->back()->with('success','Successful add form');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update_responden(Request $request)
    {
      $id = $request->get('stateId');
      $data = SurveyResponden::whereId($id)->firstOrFail();
      $put = [
        'survey_id'=>$request->get('survey_id'),
      ];
      try {
        $data->update($put);
        return redirect()->back()->with('success','Responden successfuly moved');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: '.$e->getMessage());
      }
    }

    public function delete_responden(Request $request)
    {
      $data = SurveyResponden::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    ////////////// VIEW CHATBOT ///////////////
    public function view_chatbot($id){
      $survey = Survey::whereId($id)->first();
      $params = [
          'title'=>'Chatbot Tester',
          'survey_id'=>$id,
          'branch_id'=>$survey->branch_id
      ];
      return view('backoffice.survey.chatbot')->with($params);
    }

    public function view_recapitulation($id)
    {
      $get_data = TransactionSurvey::whereSurvey_id($id)->orderBy('id','desc')->groupBy('responden_id')->get();
      $survey = Survey::whereId($id)->first();
      $params = [
          'title'=>'Recapitulation Survey',
          'data'=>$get_data,
          'branch_id'=>$survey->branch_id
      ];
      return view('backoffice.survey.recapitulation')->with($params);
    }

    public function responden_recapitulation($id)
    {
      $data = TransactionSurvey::whereId($id)->first();
      $get_data = TransactionSurvey::whereResponden_id($data->responden_id)->whereSurvey_id($data->survey_id)->orderBy('id','desc')->get();
      $params = [
          'title'=>'Recapitulation Survey Responden',
          'data'=>$get_data,
          'survey_id'=>$data->survey_id
      ];
      return view('backoffice.survey.recapitulation_responden')->with($params);
    }

    public function delete_recapitulation(Request $request)
    {
      $data = TransactionSurvey::whereId($request->get('stateId'))->first();
      try {
        TransactionSurveyValue::whereTransaction_survey_id($request->get('stateId'))->delete();
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function look_recapitulation($id)
    {
      $get_data = TransactionSurvey::whereId($id)->firstOrFail();
      $params = [
          'title'=>'Recapitulation Detail',
          'survey_id'=>$get_data->survey_id,
          'data'=>$get_data,
      ];
      return view('backoffice.survey.recapitulation_look')->with($params);
    }

    public function view_greeting($id){
      dd('masuk');
    }
}
