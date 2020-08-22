<?php

namespace App\Http\Controllers;

use App\{ MPersona };

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
      $get_data = MPersona::all();
      $params = [
          'title'=>'Persona',
          'data'=>$get_data
      ];
      return view('backoffice.persona.view')->with($params);
    }

    public function add(Request $request)
    {
      $put = [
        'field'=>$request->get('field'),
        'question'=>$request->get('question')
      ];
      try {
        MPersona::create($put);
        return redirect()->back()->with('success','Successful add new persona');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }

    public function update(Request $request)
    {
      $id = $request->get('stateId');
      $data = MPersona::whereId($id)->firstOrFail();
      $put = [
        'field'=>$request->get('field'),
        'question'=>$request->get('question')
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
      $data = MPersona::whereId($request->get('stateId'))->firstOrFail();
      try {
        $data->delete();
        return redirect()->back()->with('success','Data successfuly deleted');
      } catch (\Exception $e) {
        return redirect()->back()->with('error','Error info: '.$e->getMessage());
      }
    }
}
