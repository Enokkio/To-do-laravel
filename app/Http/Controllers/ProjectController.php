<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response;
     */
    // 'users.name','users.id'


    public function __construct(){

        $this->middleware('auth')->except(['show']);


    }


    public function index()
    {
        // $d= DB::table('projects')->join('users','users.id')
        // ->where('project.id','users.id' );
        $d = DB::table('users')->join('projects', 'users.id', '=', 'projects.creator_user_id')->select('projects.*','users.name')->get();

        return view('project.index',[
            'projects'=> $d
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
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

            'title'=>'required|unique:projects|max:255',

        ]);
        $project = project::create([
            'creator_user_id'=>1,
            'title'=>$request->title,

            ]);
            $d = DB::table('users')->join('projects', 'users.id', '=', 'projects.creator_user_id')->select('projects.*','users.name')->get();

        return view('project.index',[
            'projects'=>$d
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        // $number = $id;
        // $d = DB::table('projects')->join('todos', `$number`, '=', 'todo.project_id')->get();

        // dd($d);
        $d  = DB::table('todos')
        ->join('priorities','todos.priority_id','=','priorities.id')
        ->join('users','user_id','=','users.id')
        ->where('project_id', $id)
        ->select('todos.*','users.name','priorities.*','todos.id')->orderBy('deadline','desc')->paginate(20);

        // ->where('project_id', $id)->get();
        $c = DB::table('projects')->where('id', $id)->select('title','id','creator_user_id')->first();

        $u = DB::table('users')->get();


        Session::put('currSession','project');
        Session::put('id',$id);

        $p = DB::table('project_users')
        ->join('users', 'users.id', '=', 'project_users.user_id')
        ->where('project_id', $id)->select('users.*','project_users.*','project_users.id','users.name')
        ->get();



        // 



        
        return view('project.show',[
            'todos'=> $d,
            'project'=> $c,
            'users'=> $u,
            'projectUsers'=> $p,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        project::destroy($id);
        return redirect(route('project.index'))->with('message','post has been deleted');
    }
}
