<?php

namespace Modules\Project\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Modules\Project\Entities\Project;
use Modules\Design\Entities\Work;
use Modules\Design\Entities\Task;
use Modules\Setting\Entities\Company;
use Yajra\Datatables\Datatables;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $field=Project::paginate(15);

        return view('project::index',compact('field'));
    }
    #获取ajax列表
    public function getlist() {
        $field = Project::select(['id','project_id', 'name', 'body', 'manager','pro_drawings','harder','type','location','designer','statue','structure_type','pro_creator']);
        $data= Datatables::of($field)->make();
        return $data;
    }

    public function projectdata()
    {
        return datatables(Project::all())->toJson();
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user=User::where("name","<>","Admin")->get();
        $company=Company::all();
        $designtype=Work::all();
        //dd($designtype);
        return view('project::create',compact('user','designtype','company'));
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //**$this->validator($request, [
         //  'name' => 'required',
         //  'body' => 'required',
         //  'complet_time'=>'required',
        //  'files'=>'required',
        //]);*//
        //项目编号计算
        $maxid=DB::table('projects')->select('project_id')->max('project_id');

        if(strlen($maxid)>4){
            $maxyear=substr($maxid,2,2);
            $maxnumber=substr($maxid,4,2);
            if($maxyear<=substr(date('Y'),2,2)){
                $pulsone=intval($maxnumber)+1;
                if(strlen($pulsone)==1){
                    $proid="04".substr(date('Y'),2,2)."0".$pulsone;
                }else{
                    $proid="04".substr(date('Y'),2,2).$pulsone;
                }
            }else{
                $pulsone=intval($maxnumber)+1;
                if(strlen($pulsone)==1){
                    $proid="04".substr(date('Y'),2,2)."0".$pulsone;
                }else{
                    $proid="04".substr(date('Y'),2,2).$pulsone;
                }
            }
        }else{
            $proid="04".substr(date('Y'),2,2)."01";
        }
        //项目数据创建
        $project = new Project;
        $project->name = $request->get('name');
        $project->project_id = $proid;
        $project->body= $request->get('body');
        $project->area= $request->get('area');
        $project->manager= $request->get('manager');
        $project->managerid=User::where("name","==",$request->get('manager'))->select("id")->get();
        $project->location= $request->get('location');
        $project->structure_type= $request->get('structure_type');
        $project->statue= $request->get('statue');
        $project->complet_time= $request->get('complet_time');
        $project->pro_drawings= $request->get('pro_drawings');
        $project->harder= $request->get('harder');
        $project->type= $request->get('type');
        //上传文件
        $fileCharater=$request->file('source');
        if ($fileCharater->isValid()) { //括号里面的是必须加的哦
            //如果括号里面的不加上的话，下面的方法也无法调用的
            //获取文件的扩展名
            $ext = $fileCharater->getClientOriginalExtension();
            //获取文件的绝对路径
            $path = $fileCharater->getRealPath();
            //定义文件名
            $filename = date('Y-m-d-h-i-s').'.'.$ext;
            //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
            Storage::disk('public')->put($filename, file_get_contents($path));
            $project->images='storage/'.$filename;
        }
        //$project->pro_work_time=$hour;

        $project->pro_creator = $request->user()->name;
        $project->user_id = $request->user()->id;
        if ($project->save()) {
            return redirect('project');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request,$project_id)
    {

        $field=Project::find($project_id);
        $taskfield=Task::where('projectid',$project_id)->get();
        //dd($taskfield);
        return view('project::view',compact('field','taskfield'));
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function nice(Request $request,$project_id)
    {

        $field=Project::find($project_id);
        //dd($projectid);
        return view('project::nice',compact('field'));
    }
    public function edit(Request $request,$project_id)
    {
        $field=Project::find($project_id);
        $designtype=Work::all();
        $user=User::where("name","<>","Admin")->get();
        return view('project::edit',compact('field','user','designtype'));
    }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$project_id)
    {

        $rawinput = Input::except('_token','_method','source');
        //update图片文件
        $fileCharater=$request->file('source');
        if ($fileCharater->isValid()) {
            $ext = $fileCharater->getClientOriginalExtension();
            $path = $fileCharater->getRealPath();
            $filename = date('Y-m-d-h-i-s').'.'.$ext;
            Storage::disk('public')->put($filename, file_get_contents($path));
            $imager=array('images'=>'storage/'.$filename);
        }
        $input=array_merge($rawinput,$imager);
        //dd($input);
        $re = Project::where('id',$project_id)->update($input);
        if($re){
            return redirect('projects');
        }else{
            return back()->with('errors','更新失败！');
        }
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request,$project_id)
    {
        $re=Project::where('id',$project_id)->delete();
        if($re){
            return redirect('projects');
        }else{
            return back()->with('errors','删除失败！');
        }
    }
    //创建任务
    public function creatask(Request $request,$project_id){
        $taskname=Project::where('id',$project_id)->first();
        $tasklist=Work::where('workbody',$taskname->type)->first();
        //echo $taskname->type;
        $taskall=$tasklist->tasklist;
        $newtask=explode(',',$taskall);
        //dd($newtask);
        foreach ($newtask as $n){
            $tasks=New Task;
            $tasks->taskname = $n;
            $tasks->body = $n;
            $tasks->projectid = $project_id;
        }
        if ($tasks->save()) {
            return redirect('project');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

}
