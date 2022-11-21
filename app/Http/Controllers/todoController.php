<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\todos;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL as FacadesURL;

class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){

        $this->middleware('auth')->except(['index']);


    }
    public function index()
    {
        // return view('list.project');

        //TRY TO JOIN PRIORITES, USERS AND TODOS SO YOU CAN REFREANCE STUFF IN VIEWN BEFORE MOVING ONTO SOMETHING ELSE
        $d = DB::table('todos')->join('users', 'todos.user_id', '=', 'users.id')
        ->join('priorities','todos.priority_id','=','priorities.id')->
        where('user_id', auth::id())->
        select('todos.*', 'users.name','priorities.*','todos.id')->orderBy('deadline','asc')->paginate(20);

        Session::put('currSession','list');
        
        return view('list.index', [
            'todos' =>  $d
            ]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $p = DB::table('project_users')
        ->join('projects', 'projects.id','=','project_users.project_id')
        ->where('user_id', auth::id())
        ->select('project_users.*', 'projects.*')
        ->get()
        ;


        $d = DB::table('priorities')->get();
        $d2 = DB::table('projects')->get();

        return view('list.create',[
            'priorities' =>  $d,
            'projects' => $p,
            ]);
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

            'title'=>'required|unique:todos|max:255',
            'deadline'=>'required',
            'priority_id'=>'required',

        ]);
        $todo = todo::create([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'details'=>$request->details,
            'deadline'=>$request->deadline,
            'priority_id'=>$request->priority_id,
            'project_id'=>$request->project_id,
            ]);
            
         
           if (Session::get('currSession') == 'project') {
            $idSES = Session::get('id');
            return redirect(route('project.show', $idSES));
        } 
            else {
                return redirect(route('list.index'));
            }
           
           
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        Session::put('currSession','list');


        $d = DB::table('todos')->join('users', 'todos.user_id', '=', 'users.id')
        ->join('priorities','todos.priority_id','=','priorities.id')->
        select('todos.*', 'users.name','priorities.*','todos.id')->orderBy('deadline','asc')->paginate(20);

        return view('list.show',[

            'todos' =>  $d

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $d = DB::table('priorities')->get();

        return view('list.edit', [
            'todos'  => todo::where('id', $id)->first(), 'priorities'=> $d
        ]);

        

        
    }

    public function test(){
        return view('list.test');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response


     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|unique:todos|max:255',
            'priority_id'=>'required',   
            
        ]);

        todo::where('id',$id)->update($request->except([
            '_token','_method',
        ]));

        return redirect(route('list.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        todo::destroy($id);

        if (Session::get('currSession') == 'project') {
            $idSES = Session::get('id');
            return redirect(route('project.show', $idSES));
        } 
            else {
                return redirect(route('list.index'))->with('message','post has been deleted');
            }
    }
}
