<?php

namespace Modules\Design\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Design\Entities\Task;
use Modules\Design\Entities\Work;
use Modules\Project\Entities\Project;
use Yajra\Datatables\Datatables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('design::index');
    }
    #获取ajax列表
    public function getlist() {
        $field = Task::select(['id','taskname', 'body', 'personid', 'projectid','senterid','pro_complatetime','status','created_at','updated_at']);
        $data= DataTables::of($field)->make();
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user=User::where("name","<>","Admin")->get();
        $project=Project::all();
        $designtype=Work::all();
        return view('design::createtask',compact('user','designtype','project'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $project = new Task;
        $project->taskname = $request->get('taskname');
        $project->body= $request->get('body');
        $project->personid= $request->get('personid');
        $project->projectid= $request->get('projectid');
        $project->senterid= $request->user()->id;
        $project->pro_complatetime= $request->get('pro_complatetime');
        $project->status= $request->get('status');
        if ($project->save()) {
            return redirect('task');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request,$task_id)
    {
        $field=Task::find($task_id);
        return view('design::view',compact('field'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('design::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request,$task_id)
    {
        $newarray=explode(",",$task_id);
        for ($i=0;$i<count($newarray);$i++){
            $re=Task::where('id',$newarray[$i])->delete();
        }
        if($re){
            return redirect('task');
        }else{
            return back()->with('errors','删除失败！');
        }
    }
}
