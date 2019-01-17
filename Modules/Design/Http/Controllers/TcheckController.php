<?php

namespace Modules\Design\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Design\Entities\Task;
use Modules\Design\Entities\Tcheck;
use Modules\Project\Entities\Project;
use Yajra\DataTables\DataTables;

class TcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('design::tcindex');
    }
    #获取ajax列表
    public function getlist(Request $request) {
        //dd($request->user()->id); //这里需要加入数据筛选同时设置权限
        $field = Tcheck::select(['id','taskid', 'status', 'checker', 'body','times','numbers','another','created_at','updated_at'])->get();
        dd($field);
        $newdata=json_encode($field);
        $jsondata=json_decode($newdata,true);
        for ($i=0;$i<count($jsondata);$i++){
            $checker=intval($jsondata[$i]['checker']);
            $taskid=intval($jsondata[$i]['taskid']);
            $checkername=$this->getusername($checker);
            $taskname=$this->gettaskname($taskid);
            $jsondata[$i]['checker']=$checkername;
            $jsondata[$i]['taskid']=$taskname;
        };
        //下面是用来转译的
        $data= DataTables::of($jsondata)->make();
        return $data;
    }
    /**
     * 检索用户名的函数
     */
    public function getusername($id){
        $username=User::where('id',$id)->first();
        return $username->name;
    }
    /**
     * 检索项目名称函数
     */
    public function gettaskname($id){
        $taskname=Task::where('id',$id)->first();
        return $taskname->body;
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('design::create');
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('design::show');
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request,$task_id)
    {
        $field=Tcheck::find($task_id);
        $project=Project::all();
        $user=User::where("name","<>","Admin")->get();
        return view('design::editcheck',compact('field','user','project'));
    }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$task_id)
    {
        $rawinput = Input::except('_token','_method');
        $tcheckdata = Tcheck::where('id',$task_id)->first();
        $re = Tcheck::where('id',$task_id)->update($rawinput);
        $realtaskid=$tcheckdata->taskid;
        //改变任务状态
        $changetaskstatus=Task::where('id',$realtaskid)->update(['status'=>2]);
        //dd($changetaskstatus);
        if($changetaskstatus and $re){
            return redirect('tcheck');
        }else{
            return back()->with('errors','更新失败！');
        }
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
