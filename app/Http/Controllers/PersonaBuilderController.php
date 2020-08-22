<?php

namespace App\Http\Controllers;

use App\{ MPersona, Branch, BranchPersona };

use Auth;

use Illuminate\Http\Request;

class PersonaBuilderController extends Controller
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
          'title'=>'Persona Builder',
          'data'=>$get_data
      ];
      return view('backoffice.persona_builder.view')->with($params);
    }

    public function open($id)
    {
      $branch = Branch::whereId($id)->first();
      $get_data = BranchPersona::whereBranch_id($id)->get();

      $stu_id = [];
      foreach($get_data as $d){
        array_push($stu_id,$d->m_persona_id);
      }
      $mpersona = MPersona::whereNotIn('id',$stu_id)->orderBy('id','asc')->get();
      $params = [
          'title'=>'Persona Builder',
          'branch'=>$branch,
          'mpersona'=>$mpersona,
          'data'=>$get_data,
          'branch_id'=>$id
      ];
      return view('backoffice.persona_builder.open')->with($params);
    }

    public function create(Request $request)
    {
      $get_data = MPersona::whereId($request->get('persona_id'))->firstOrFail();
      $branch_id = $request->get('branch_id');
      $params = [
          'title'=>'Add Persona',
          'data'=>$get_data,
          'branch_id'=>$branch_id
      ];
      return view('backoffice.persona_builder.create')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'branch_id'=>$request->get('branch_id'),
        'm_persona_id'=>$request->get('m_persona_id'),
        'custom_question'=>$request->get('custom_question')
      ];
      try {
        BranchPersona::create($put);
        return redirect()->route('persona.builder.open',$request->get('branch_id'))->with('success','Successful add new persona');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = BranchPersona::whereId($id)->firstOrFail();
      $put = [
        'custom_question'=>$request->get('custom_question')
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
      $data = BranchPersona::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly removed');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function chatbot()
    {
      $get_data = Branch::all();
      $params = [
          'title'=>'Persona Chatbot Tester',
          'data'=>$get_data,
          'survey_id'=>null
      ];
      return view('backoffice.persona_builder.chatbot')->with($params);
    }
}
