<?php

namespace App\Http\Controllers;

use App\{ Survey, SurveyForm, SurveyResponden, SurveyFormQuestion, SurveyFormConfirmation, Form, Responden, FormQuestion, TransactionSurvey, TransactionSurveyValue, Branch, SurveyGreeting, BranchGreeting };

use Illuminate\Http\Request;
use DB;
use Auth;

class ScenarioGreetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view($id){
      $get_data = BranchGreeting::whereBranch_id($id)->whereIs_default(0)->orderBy('id','desc')->get();
      $greeting = BranchGreeting::firstOrCreate(
        ['branch_id'=>$id,'is_default'=>1],
        []
      );

      $survey = Survey::whereBranch_id($id)->get();

      $params = [
          'title'=>'Greeting',
          'data'=>$get_data,
          'greeting'=>$greeting,
          'id'=>$id,
          'survey'=>$survey
      ];
      return view('backoffice.survey.greeting')->with($params);
    }

    public function edit($id){
      $greeting = BranchGreeting::whereBranch_id($id)->whereIs_default(1)->first();
      $params = [
          'title'=>'Greeting Edit',
          'greeting'=>$greeting,
          'id'=>$id
      ];
      return view('backoffice.survey.greeting_edit')->with($params);
    }

    public function update(Request $request,$id){
      $greeting = $request->get('greeting');
      $put = [
        'text'=>$greeting
      ];

      try {
        $data = BranchGreeting::updateOrCreate(
          ['branch_id'=>$id,'is_default'=>1],
          $put
        );
        return redirect()->route('scenario.greeting',$id)->with('success','Successful add new persona');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function add(Request $request,$id){
      $put = [
        'key'=>strtoupper($request->get('key')),
        'text'=>$request->get('text'),
        'type'=>$request->get('type'),
        'survey_id'=>$request->get('survey_id'),
        'is_default'=>0
      ];
      if(Auth::user()->branch_id){
        $put['branch_id'] = Auth::user()->branch_id;
      }else{
        $put['branch_id'] =$id;
      }

      $check_duplicate = BranchGreeting::whereBranch_id($put['branch_id'])->where('key',$put['key'])->get();
      if($check_duplicate->count()){
        return redirect()->back()->with('warning','Key cannot be the same');
      }

      try {
        BranchGreeting::create($put);
        return redirect()->back()->with('success','Successful add new Greeting');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function delete(Request $request)
    {
      $data = BranchGreeting::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function information_update(Request $request){
      $id = $request->get('stateId');
      $data = BranchGreeting::whereId($id)->firstOrFail();
      $put = [
        'key'=>$request->get('key'),
        'text'=>$request->get('text'),
        'type'=>$request->get('type'),
        'survey_id'=>$request->get('survey_id'),
        'is_default'=>0
      ];
      // if(Auth::user()->branch_id){
      //   $put['branch_id'] = Auth::user()->branch_id;
      // }else{
      //   $put['branch_id'] =$id;
      // }
      try {
        $data->update($put);

        return redirect()->back()->with('success','Successful Update Greeting');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

}
