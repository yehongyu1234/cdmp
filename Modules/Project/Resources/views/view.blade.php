@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        {{$field->name}}信息
    </h1>
        <a href="{{url('project/'.$field->id.'/edit')}}" class="btn btn-success">编辑</a>
    <a onclick="alert('还在开发中，采用的glTF技术！')" class="btn btn-warning">查看模型</a>
        <a href="{{url('project/'.$field->id.'/creatask')}}" class="btn btn-info pull-right">创建任务</a>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                            {!! csrf_field() !!}
                        <div class="col-md-12"><h4>基本信息</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <input id="location" name="loaction" value="{{$field->location}}" type="hidden"\>
                        <input name="projectid" value="{{$field->id}}" type="hidden"\>
                        <div class="col-md-5">
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label"><strong>项目名称:</strong></label>
                                <div class="col-sm-8">
                                    {{$field->name}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">内容介绍</label>
                                <div class="col-sm-8">
                                    {{$field->body}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">面积(m²)</label>
                                <div class="col-sm-9">
                                    {{$field->area}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">结构体系</label>
                                <div class="col-sm-9">
                                    {{$field->structure_type}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-9">
                                    {{$field->statue}}
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">图纸量</label>
                                <div class="col-sm-9">
                                    {{$field->pro_drawings}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">设计类型</label>
                                <div class="col-sm-9">
                                    {{$field->type}}
                                </div>

                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">预计难度</label>
                                <div class="col-sm-9">
                                    {{$field->harder}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">预计完成</label>
                                <div class="col-sm-9">
                                    {{$field->complet_time}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">项目二维码
                            <br>
                            {!! QrCode::size(400)->generate('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.base64_decode($field->guid).'/out'); !!}
                        </div>
                        <div class="col-md-4">项目效果图
                            <br><img src="{{url('/'.$field->images)}}" width="100%">
                        </div>
                    </div>
                    {{'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.base64_decode($field->guid).'/out'}}
                </div>
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4 class="col-md-11">楼栋管理</h4>
                        </div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div>
                                <a class="btn btn-info" id="addrow" value="新增" ><i class="voyager-plus"></i></a>
                                <a class="btn btn-danger" id="removerow" value="删除"><i class="voyager-trash"></i></a>
                            </div>
                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkbox"/></th>
                                    <th>楼栋号</th>
                                    <th>层数</th>
                                    <th>结构类型</th>
                                    <th>面积(m²)</th>
                                    <th>相同于</th>
                                    <th>层高(m)</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody  id="trlist">
                                @foreach($buildings as $bd)
                                    <tr>
                                        <td><input type="checkbox" name="checkbox"/></td>
                                        <td>{{$bd->buildingid}}</td>
                                        <td>{{$bd->floors}}</td>
                                        <td>{{$bd->structure_type}}</td>
                                        <td>{{$bd->area}}</td>
                                        <td>{{$bd->sameas}}</td>
                                        <td>{{$bd->floor_height}}</td>
                                        <td> <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-success">编辑</button>

                                                <button type="button" class="btn btn-danger">删除</button>
                                                <button type="button" class="btn btn-success">创建任务</button>
                                            </div></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $buildings->links() }}
                        </div>
                        <!--增加数据-->
                        <div class="modal fade" id="adddata" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <form class="form-horizontal" role="form" action="{{ url('building') }}" method="POST" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="modal-dialog modal-sm " >
                                    <div class="modal-content" style="width: 500px;">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                                    data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                增加楼栋
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">楼栋号</label>
                                            <div class="col-sm-9">
                                                <input name="buildingid" class="form-control" placeholder="输入数字">
                                            </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">层数</label>
                                            <div class="col-sm-9">
                                                <input name="floors" class="form-control" placeholder="">
                                            </div>
                                            </div><div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">结构类型</label>
                                            <div class="col-sm-9">
                                                <input name="structure_type" class="form-control" placeholder="">
                                            </div>
                                            </div><div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">面积(m²)</label>
                                            <div class="col-sm-9">
                                                <input name="area" class="form-control" placeholder="">
                                            </div>
                                            </div><div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">相同于</label>
                                            <div class="col-sm-9">
                                                <input name="sameas" class="form-control" placeholder="">
                                            </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-sm-3 control-label">层高(m)</label>
                                                <div class="col-sm-9">
                                                    <input name="floor_height" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="addSubmit">
                                                确认
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-bordered ">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4 class="col-md-11">设计任务信息</h4>
                            <a href="{{url('tasks')}}" class="btn btn-sm btn-info pull-right col-md-1">任务管理</a>
                        </div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>任务名称</th>
                                <th>内容</th>
                                <th>执行人</th>
                                <th>预计完成时间</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($taskfield as $tf)
                                <tr>
                                <td>{{$tf->id}}</td>
                                <td>{{$tf->taskname}}</td>
                                <td>{{$tf->body}}</td>
                                <td>{{\App\User::where("id",$tf->personid)->first()->name}}</td>
                                <td>{{$tf->pro_complatetime}}</td>
                                    @if($tf->status==0)
                                <td><button class="btn btm-xs btn-warning">未完成</button></td>
                                    @elseif($tf->status==1)
                                    <td><button class="btn btm-xs btn-info">在审核</button></td>
                                @else
                                    <td><button class="btn btm-xs btn-success">已完成</button></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $taskfield->links() }}
                        </div>
                    </div>
                </div>
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4 class="col-md-11">项目位置</h4>
                        </div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div  style="height: 500px" id="map-container"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-bordered ">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4>人员责任</h4>
                        </div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <table class="table table-striped  table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>设计人员名称</th>
                                    <th>职位</th>
                                    <th>联系方式</th>
                                    <th>状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($taskfield as $tf)
                                    <tr>
                                        <td>{{$tf->id}}</td>
                                        <td>{{$tf->taskname}}</td>
                                        <td>{{$tf->body}}</td>
                                        <td>{{$tf->personid}}</td>
                                        <td>{{$tf->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $taskfield->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var trlisthtml = $("#trlist").html();//获取默认的一行tr，用作复制
        function removerow(){//移除
            $('input[name="checkbox"]:checked').each(function(){
                $(this).parent().parent().remove();//移除当前行 checkbox的父级是td，td的父级是tr，然后删除tr。就ok了。用each，选择多行遍历删除
            });
        };
        //增加数据弹窗
        $(document).delegate('#addrow', 'click', function () {
            $("#adddata").modal('show');
        });
        /**
         * 点击确认后增加数据
         */
        $(document).delegate('#addSubmit','click',function(){
            var projectid=document.getElementsByName('projectid')[0].value;
            var buildingid=document.getElementsByName('buildingid')[0].value;
            var floors=document.getElementsByName('floors')[0].value;
            var structure_type=document.getElementsByName('structure_type')[0].value;
            var area=document.getElementsByName('area')[0].value;
            var sameas=document.getElementsByName('sameas')[0].value;
            var floor_height=document.getElementsByName('floor_height')[0].value;

            $('#adddata').modal('hide');
            var host = window.location.host;
            $.ajax({
                url:'http://'+host+'/building',
                async:true,
                type:"POST",
                data:{'projectid':projectid
                    ,'buildingid':buildingid,
                'floors':floors,
                'structure_type':structure_type,
                'area':area,
                'sameas':sameas,
                'floor_height':floor_height
                },
                dataType:"json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.location.reload();
        });


        $(document).delegate('#removerow', 'click', function () {
            removerow();
        });
    });
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=HFQRg1xTCB9904KXqr6audLj"></script>
<script type="text/javascript">
    var map = new BMap.Map('map-container');
    var newpt=document.getElementById('location').value;
    //console.log(Number(newpt.split(',')[0]));
    var point = new BMap.Point(Number(newpt.split(',')[0]),Number(newpt.split(',')[1]));
    map.centerAndZoom(point, 12);
    // 添加带有定位的导航控件
    var navigationControl = new BMap.NavigationControl({
        // 靠左上角位置
        anchor: BMAP_ANCHOR_TOP_LEFT,
        // LARGE类型
        type: BMAP_NAVIGATION_CONTROL_LARGE,
        // 启用显示定位
        enableGeolocation: true
    });
    map.addControl(navigationControl);
    var marker = new BMap.Marker(point);
    map.addOverlay(marker);
</script>
@stop
