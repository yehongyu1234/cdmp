@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
    {{$projectname->name}}-{{$field->taskname}}信息
    </h1>
        <a href="{{url('task/'.$field->id.'/edit')}}" class="btn btn-success">编辑</a>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                            {!! csrf_field() !!}
                        <div class="col-md-4"><h4>基本信息</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">项目名称</label>
                                <div class="col-sm-8">
                                    {{$projectname->name}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label"><strong>任务名称:</strong></label>
                                <div class="col-sm-8">
                                    {{$field->taskname}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">内容</label>
                                <div class="col-sm-8">
                                    {{$field->body}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">执行人</label>
                                <div class="col-sm-8">
                                    {{$username->name}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">状态</label>
                                <div class="col-sm-8">
                                    @if($field->status==1)
                                        已完成
                                        @else
                                    未完成
                                        @endif
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">发布者</label>
                                <div class="col-sm-8">
                                    {{$sendername->name}}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">预计完成</label>
                                <div class="col-sm-8">
                                    {{$field->pro_complatetime}}
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        {!! csrf_field() !!}
                        <div class="col-md-4"><h4>任务成果</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">成果内容</label>
                                <div class="col-sm-8">
                                    <strong>这里显示成果的内容，图纸、文字、等信息</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        {!! csrf_field() !!}
                        <div class="col-md-4"><h4>审阅信息</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">任务完成后审阅信息显示</label>
                                <div class="col-sm-8">
                                    <strong>显示审阅信息通过列表显示</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@stop
