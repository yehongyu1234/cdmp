@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        编辑任务
    </h1>
@stop

@section('content')
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="{{ url('tasks/'.$field->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            {!! csrf_field() !!}
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">任务名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="taskname" lay-verify="name" autocomplete="off" class="form-control" value="{{$field->taskname}}">
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">内容介绍</label>
                                <div class="col-sm-9">
                                    <textarea name="body" placeholder="请输入内容" class="form-control" required="required">{{$field->body}}</textarea>
                                </div>
                            </div>
                            @if(Auth::user()->role_id==1)
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        @if($field->status==0)
                                        <option value="0" selected>未完成</option>
                                            <option value="1">已完成</option>
                                        @else
                                        <option value="0" >未完成</option>
                                        <option value="1" selected>已完成</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">执行人</label>
                                <div class="col-sm-9">
                                    <select name="personid" class="form-control">
                                        <option value="{{$field->personid}}">{{$field->personid}}</option><!-- TODO这里要搞清楚blade中通过标识ID检索数据库的其他信息-->
                                        @foreach($user as $u)
                                            <option value="{{$u->id}}">{{$u->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">预计完成</label>
                                <div class="input-append date form_datetime col-md-9">
                                    <input name="pro_complatetime" class="form-control" size="16" type="text" value="{{$field->pro_complatetime}}" readonly>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                            @endif
                                <div class="form-group col-md-8">
                                    <div class="col-sm-12 col-sm-offset-3">
                                        <button class="btn btn-primary">提交</button>
                                        <button type="reset" class="btn btn-white">重置</button>
                                    </div>
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
