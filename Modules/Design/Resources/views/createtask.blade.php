@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        创建任务
    </h1>
@stop

@section('content')
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>新增失败</strong> 输入不符合要求<br><br>
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                @endif
                <div class="panel-body">
                    <form action="{{ url('task') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label">任务名称</label>
                            <div class="col-sm-9">
                                <input type="text" name="taskname" lay-verify="name" autocomplete="off" placeholder="请输入任务名称" class="form-control">
                            </div>
                            <br>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label">内容介绍</label>
                            <div class="col-sm-9">
                                <textarea name="body" placeholder="请输入内容" class="form-control" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label">状态</label>
                            <div class="col-sm-9">
                                <select name="status" class="form-control">
                                    <option value="0">未完成</option>
                                    <option value="1">已完成</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label">执行人</label>
                            <div class="col-sm-9">
                                <select name="personid" class="form-control">
                                    <option value="">请选择</option>
                                    @foreach($user as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label">项目名称</label>
                            <div class="col-sm-9">
                                <select name="projectid" class="form-control">
                                    <option value="">请选择</option>
                                    @foreach($project as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-3 control-label">预计完成</label>
                            <div class="input-append date form_datetime col-md-9">
                                <input name="pro_complatetime" class="form-control" size="16" type="text" readonly>
                                <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-sm-12 col-sm-offset-11">
                                <button class="btn btn-primary">提交</button>
                                <button type="reset" class="btn btn-white">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('js/locale/bootstrap-datetimepicker.zh-CN.js')}}" charset="UTF-8"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        language:  'zh-CN',
        format: "yyyy-mm-dd hh:ii"
    });
</script>
@stop
