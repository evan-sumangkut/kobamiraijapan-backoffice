<?php

namespace App\Http\Controllers;

use App\{ Responden, Survey, SurveyResponden };

use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $get_data = Responden::all();
      $params = [
          'title'=>'Responden',
          'data'=>$get_data
      ];
      return view('backoffice.responden.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'telegram_id'=>$request->get('telegram_id'),
      ];
      $survey = Survey::whereIs_opening(1)->first();
      try {
        $responden = Responden::create($put);
        SurveyResponden::create(['responden_id'=>$responden->id,'survey_id'=>$survey->id]);
        return redirect()->back()->with('success','Successful add new responden');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = Responden::whereId($id)->firstOrFail();
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
      $data = Responden::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
