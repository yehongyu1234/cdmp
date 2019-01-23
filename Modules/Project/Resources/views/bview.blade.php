@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        {{$field->buildingid}}#楼信息
    </h1>
        <a href="{{url('building/'.$field->id.'/edit')}}" class="btn btn-success">编辑</a>
    <a href="{{url('building/'.$field->guid.'/model')}}" class="btn btn-info">查看模型</a>
    <!--
    <a onclick="alert('还在开发中，采用的glTF技术！')" class="btn btn-warning">查看模型</a>
        <a href="{{url('project/'.$field->id.'/creatask')}}" class="btn btn-info pull-right">创建任务</a>
        -->


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
                        <div class="col-md-5">
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label"><strong>项目名称:</strong></label>
                                <div class="col-sm-8">
                                    <a href="{{url('project/'.\Modules\Project\Entities\Project::where('id',$field->project_id)->first()->project_id.'/show')}}">{{\Modules\Project\Entities\Project::where('id',$field->project_id)->first()->name}}</a>
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">内容介绍</label>
                                <div class="col-sm-8">
                                    {{$field->floors}}
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
                                <label class="col-sm-3 control-label">相同于</label>
                                <div class="col-sm-9">
                                    {{$field->sameas}}
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">层高</label>
                                <div class="col-sm-9">
                                    {{$field->floor_height}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">设计师</label>
                                <div class="col-sm-9">
                                    {{$field->designer_id}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">项目二维码
                            <br>
                            {!! QrCode::size(400)->generate('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.base64_decode($field->guid).'/out'); !!}
                        </div>
                    </div>
                    {{'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.base64_decode($field->guid).'/out'}}
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
        $(document).delegate('#removerow', 'click', function () {
            removerow();
        });
    });
</script>
@stop
