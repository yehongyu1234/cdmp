<?php

namespace Modules\Setting\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Design\Entities\Work;
use Modules\Project\Entities\Custome;
use Modules\Setting\Entities\Company;
use Yajra\DataTables\DataTables;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $comdata=Company::all();
        return view('setting::index');
    }
    #获取ajax列表
    public function getlist() {
        $field = Company::select(['id', 'name', 'location', 'zhizhao','connectorid','com_code','type','location','history','marketmanager_id']);
        $data= DataTables::of($field)->make();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user=User::where("role_id","4")->get();
        //dd($user);
        $connect=Custome::all();
        $company=Company::all();
        $designtype=Work::all();
        return view('setting::companycreate',compact('connect','designtype','company','user'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //项目编号计算
        $maxid=DB::table('projects')->select('project_id')->max('project_id');
        //项目数据创建
        $project = new Company;
        $project->name = $request->get('name');
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
        $allowedImageMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/bmp',
            'image/svg+xml',
        ];
        if ($fileCharater->isValid() and $allowedImageMimeTypes) { //括号里面的是必须加的哦
            //如果括号里面的不加上的话，下面的方法也无法调用的
            //获取文件的扩展名
            $fileoriginname=$fileCharater->getClientOriginalName();
            $ext = $fileCharater->getClientOriginalExtension();
            //获取文件的绝对路径
            $path = $fileCharater->getRealPath();
            //定义文件名
            $filename = base64_encode($fileoriginname.date('YMDHMS')).'.'.$ext;
            //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
            Storage::disk('public')->put($filename, file_get_contents($path));
            $project->images='storage/'.$filename;
        }
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
    public function show()
    {
        return view('setting::show');
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('setting::edit');
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
    public function destroy(Request $request,$project_id)
    {
        $re=Project::where('id',$project_id)->delete();
        if($re){
            return redirect('projects');
        }else{
            return back()->with('errors','删除失败！');
        }
    }
}
