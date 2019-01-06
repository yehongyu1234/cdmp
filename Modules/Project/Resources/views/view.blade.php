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
                        <input id="location" name="loaction" value="{{$field->location}}" hidden\>
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
                            {!! QrCode::size(400)->generate('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.$field->id.'/nice'); !!}
                        </div>
                        <div class="col-md-4">项目效果图
                            <br><img src="{{url('/'.$field->images)}}" width="100%">
                        </div>
                    </div>
                </div>
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4 class="col-md-11">设计任务信息</h4>
                            <a href="{{url('tasks')}}" class="btn btn-sm btn-info pull-right col-md-1">任务管理</a>
                        </div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                        <table class="table table-striped">
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
                                <td>{{$tf->personid}}</td>
                                <td>{{$tf->pro_complatetime}}</td>
                                <td>{{$tf->status}}</td>
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
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4>人员责任</h4>
                        </div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <table class="table table-striped">
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
                                        <td>{{$tf->personid}}</td>
                                        <td>{{$tf->pro_complatetime}}</td>
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
    <input id="location" name="location" type="text" hidden/>
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
