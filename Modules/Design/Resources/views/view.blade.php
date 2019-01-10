@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        {{$field->name}}信息
    </h1>
        <a href="{{url('task/'.$field->id.'/edit')}}" class="btn btn-success">编辑</a>
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
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">项目名称</label>
                                <div class="col-sm-9">
                                    {{$field->status}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">

                                <label class="col-sm-2 control-label"><strong>任务名称:</strong></label>
                                <div class="col-sm-8">
                                    {{$field->taskname}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">内容</label>
                                <div class="col-sm-8">
                                    {{$field->body}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">执行人</label>
                                <div class="col-sm-9">
                                    {{$field->personid}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-9">
                                    {{$field->status}}
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">发布者</label>
                                <div class="col-sm-9">
                                    {{$field->senterid}}
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">预计完成</label>
                                <div class="col-sm-9">
                                    {{$field->pro_complatetime}}
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
