<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Models\project_user;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'user_id'=>'required',

        ]);
        $idSES = Session::get('id');

        $request = project_user::create([
            'user_id'=>$request->user_id,
            'project_id'=> $idSES,
            ]);
        
            
        return redirect(route('project.show', $idSES));
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project_user  $project_user
     * @return \Illuminate\Http\Response
     */
    public function show(project_user $project_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project_user  $project_user
     * @return \Illuminate\Http\Response
     */
    public function edit(project_user $project_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project_user  $project_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project_user $project_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project_user  $project_user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        project_user::destroy($id);

        $idSES = Session::get('id');
        return redirect(route('project.show', $idSES));
    }
}
