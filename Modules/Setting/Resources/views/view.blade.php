@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
    {{$field->name}}信息
    </h1>
        <a href="{{url('company/'.$field->id.'/edit')}}" class="btn btn-success">编辑</a>
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
                                <label class="col-sm-4 control-label">企业名称:</label>
                                <div class="col-sm-8">
                                    {{$field->name}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label"><strong>主营业务:</strong></label>
                                <div class="col-sm-8">
                                    {{$field->body}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">执照</label>
                                <div class="col-sm-8">
                                    {{$field->zhizhao}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">联系人</label>
                                <div class="col-sm-8">
                                    {{\Modules\Project\Entities\Custome::where('id',$field->connectorid)->first()->name}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">信誉</label>
                                <div class="col-sm-8">
                                    {{$field->history}}
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-4"><h4>营业执照</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <div class="col-sm-8">
                                    <img src="{{asset($field->zhizhao)}}" style="height: 400px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-4"><h4>拜访记录</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <div class="col-sm-8">
                                    这里显示拜访记录清单
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
