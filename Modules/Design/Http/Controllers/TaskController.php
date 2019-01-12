<?php

namespace Modules\Design\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Design\Entities\Task;
use Modules\Design\Entities\Work;
use Modules\Project\Entities\Project;
use function PHPSTORM_META\type;
use Yajra\Datatables\Datatables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        //$field=Task::all();
        //$users=$request->user()->id;
        //dd($users);
        return view('design::index');
    }
    #获取ajax列表
    public function getlist(Request $request) {
        //dd($request->user()->id); //这里需要加入数据筛选同时设置权限
        $field = Task::select(['id','taskname', 'body', 'personid', 'projectid','senterid','pro_complatetime','status','created_at','updated_at'])->get();
        $newdata=json_encode($field);
        $jsondata=json_decode($newdata,true);
        for ($i=0;$i<count($jsondata);$i++){
            $personid=intval($jsondata[$i]['personid']);
            $projctid=intval($jsondata[$i]['projectid']);
            $senderid=intval($jsondata[$i]['senterid']);
            $personname=$this->getusername($personid);
            $projectname=$this->getprojectname($projctid);
            $sendername=$this->getusername($personid);
            $jsondata[$i]['personid']=$personname;
            $jsondata[$i]['projectid']=$projectname;
            $jsondata[$i]['senterid']=$sendername;
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
    public function getprojectname($id){
        $projectname=Project::where('id',$id)->first();
        //dd($projectname);
        return $projectname->name;
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user=User::where("name","<>","Admin")->get();
        $project=Project::all();
        return view('design::createtask',compact('user','project'));
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
        $project->status= 0;
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
    public function edit(Request $request,$task_id)
    {
        $field=Task::find($task_id);
        $project=Project::all();
        $user=User::where("name","<>","Admin")->get();
        return view('design::editask',compact('field','user','project'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$task_id)
    {
        $rawinput = Input::except('_token','_method');
        $re = Task::where('id',$task_id)->update($rawinput);
        if($re){
            return redirect('task');
        }else{
            return back()->with('errors','更新失败！');
        }

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

    /**
     * 状态调整
     * 根据ajax发送过来的状态调整数据库内的信息，状态不可逆，如果提交完成，无法在改为未完成
     */
    public function status(Request $request){
        $id= $request->get('id');
        $re = Task::where('id',$id)->update(["status"=>1]);
        if($re){
            return redirect('task');
        }else{
            return back()->with('errors','更新失败！');
        }

    }
}
