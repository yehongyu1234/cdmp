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
                            <div class="col-md-8">
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">项目名称</label>
                                    <div class="col-sm-9">
                                        {{$field->name}}
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">内容介绍</label>
                                    <div class="col-sm-9">
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
                                    <label class="col-sm-3 control-label">项目经理(A)</label>
                                    <div class="col-sm-9">
                                        {{$field->manager}}
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">状态</label>
                                    <div class="col-sm-9">
                                        {{$field->statue}}
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">预计图纸总量（张）</label>
                                    <div class="col-sm-9">
                                        {{$field->pro_drawings}}
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">主要设计类型</label>
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

                        <div class="col-md-4">图片（项目二维码）
                            <br>
                            {!! QrCode::size(400)->generate(Request::url()); !!}
                        </div>


                    </div>
                </div>
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-8">
                            项目任务信息
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    
@stop
