<?php

namespace Modules\Design\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Modules\Design\Entities\Task;
use Modules\Design\Entities\Tcheck;
use Modules\Project\Entities\Project;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Expr\Array_;
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
    //导出excel
    public function exportxls(Request $request){
        $taskid=$request->get('id');
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $arraydata=array();
        ini_set('memory_limit','500M');
        set_time_limit(0);//设置超时限制为0分钟
        for ($m=0;$m<count($taskid);$m++){
            $cellData = Task::where('id',$taskid[$m])->first();
            $newcd=json_decode(json_encode($cellData), true);
            array_push($arraydata,$newcd);
        }
        $headdata=array('id','名称','内容','执行者','项目名称','提交者','预计完成时间','创建时间','更新时间','状态','积分');
        //设置工作表标题名称
        $worksheet->setTitle('任务清单'.date('Ymd'));
        //表头
        //设置单元格内容
        $worksheet->setCellValueByColumnAndRow(1, 1, '任务清单');
        for($i=0;$i<count($headdata);$i++){
            $worksheet->setCellValueByColumnAndRow($i, 2, $headdata[$i]);
        }
       // dd($arraydatakey[0  ]);
        for($m=0;$m<count($arraydata);$m++){
            for($n=0;$n<count($arraydata[$m]);$n++){
                $arraydatakey=array_keys($arraydata[$m]);//求取所有的key
                $worksheet->setCellValueByColumnAndRow($n, $m+3, $arraydata[$m][$arraydatakey[$n]]);
            }
        }
        //合并单元格
        $worksheet->mergeCells('A1:J1');

        $filename = '任务清单'.date('Ymd').'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer =new Xlsx($spreadsheet);
        $writer->save($filename);
        //return $writer->save('php://output');
        //return view('design::index') ;

    }
    //ojbect转化为array
    function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)object_to_array($v);
            }
        }

        return $obj;
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
            //这里加入等于0的判断是应该在日常工作中并不是所有的都是项目工作
            if($projctid==0){
                $senderid=intval($jsondata[$i]['senterid']);
                $personname=$this->getusername($personid);
                $projectname="日常工作";
                $sendername=$this->getusername($senderid);
                $jsondata[$i]['personid']=$personname;
                $jsondata[$i]['projectid']=$projectname;
                $jsondata[$i]['senterid']=$sendername;
            }else{
                $senderid=intval($jsondata[$i]['senterid']);
                $personname=$this->getusername($personid);
                $projectname=$this->getprojectname($projctid);
                $sendername=$this->getusername($senderid);
                $jsondata[$i]['personid']=$personname;
                $jsondata[$i]['projectid']=$projectname;
                $jsondata[$i]['senterid']=$sendername;
            }
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
        $project = new Task;
        $project->taskname = $request->get('taskname');
        $project->body= $request->get('body');
        $project->personid= $request->get('personid');
        $project->projectid= $request->get('projectid');
        $project->senterid= Auth::user()->id;
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
        $tcheck=Tcheck::where('taskid',$task_id)->paginate(10);
        $field=Task::where('id',$task_id)->first();
        $projectname=Project::where('id',$field->projectid)->first();
        $username=User::where('id',$field->personid)->first();
        $sendername=User::where('id',$field->senterid)->first();
        return view('design::view',compact('field','projectname','username','sendername','tcheck'));
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
        $taskdata=Task::where('id',$id)->first();
        //dd($taskdata);
        $re = Task::where('id',$id)->update(["status"=>1]);

        //这里创建一个审查任务
        $check=New Tcheck;

        $check->taskid=$id;
        $check->status=0;//0为未审核状态，1为审核状态
        $check->checker=$taskdata->senterid;
        $check->body=null;
        $check->times=1;
        $check->numbers=0;
        $check->another=0;
        if($check->save() and $re){
            return redirect('task');
        }else{
            return back()->with('errors','更新失败！');
        }

    }
}
