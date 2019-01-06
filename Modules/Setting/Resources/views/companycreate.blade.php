@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        增加企业
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
                    <form action="{{ url('project') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">企业名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入企业名称" class="form-control">
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
                                <label class="col-sm-3 control-label">面积(m²)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="area" lay-verify="required" autocomplete="off" class="form-control" placeholder="面积">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">结构体系</label>
                                <div class="col-sm-9">
                                    <select name="structure_type" class="form-control">
                                        <option value="">请选择</option>
                                            <option value="框架结构">框架结构</option>
                                            <option value="剪力墙结构">剪力墙结构</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">项目经理(A)</label>
                                <div class="col-sm-9">
                                    <select name="manager" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($user as $u)
                                        <option value="{{$u->name}}">{{$u->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" checked="" value="未开始" id="optionsRadios1" name="statue" checked="">未开始</label>
                                    <label class="radio-inline">
                                        <input type="radio" value="进行中" id="optionsRadios2" name="statue">进行中</label>
                                    <label class="radio-inline">
                                        <input type="radio" checked="" value="已开始" id="optionsRadios1" name="statue" checked="">已开始</label>
                                    <label class="radio-inline">
                                        <input type="radio" value="已结束" id="optionsRadios2" name="statue">已结束</label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">预计图纸总量（张）</label>
                                <div class="col-sm-9">
                                    <input name="pro_drawings"  lay-verify="required" autocomplete="off" class="form-control" placeholder="根据构件数量">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">主要设计类型</label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">预计难度</label>
                                <div class="col-sm-9">
                                    <input name="harder"  lay-verify="required" autocomplete="off" class="form-control" placeholder="预计难度1~5,1难度最低，5难度最高">
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
