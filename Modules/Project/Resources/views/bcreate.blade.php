@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        创建项目的建筑
    </h1>
@stop

@section('content')
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
                    <form action="{{ url('building') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">项目名称</label>
                                <div class="col-sm-9">
                                    <select name="project_id" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($project as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">栋号</label>
                                <div class="col-sm-9">
                                    <input type="text" name="buildingid" lay-verify="name" autocomplete="off" placeholder="输入数字" class="form-control">

                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">层数</label>
                                <div class="col-sm-9">
                                    <input type="text" name="floors" lay-verify="name" autocomplete="off" placeholder="输入数字" class="form-control">

                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">面积(m²)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="area" lay-verify="required" autocomplete="off" class="form-control" placeholder="面积">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">层高(m)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="floor_height" lay-verify="required" autocomplete="off" class="form-control" placeholder="层高">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">相同于</label>
                                <div class="col-sm-9">
                                    <input type="text" name="sameas" lay-verify="required" autocomplete="off" class="form-control" placeholder="相同于">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">结构体系</label>
                                <div class="col-sm-9">
                                    <select name="structure_type" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($structure_type as $s)
                                            <option value="{{$s}}">{{$s}}</option><!--TODO 这里需要解决值是数字的问题 -->
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">营销经理</label>
                                <div class="col-sm-9">
                                    <select name="market_manager" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($user as $u)
                                            <option value="{{$u->id}}">{{$u->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">类型</label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="file">选择文件</label>
                            <input id="file" type="file" class="form-control" name="source">
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


@stop
