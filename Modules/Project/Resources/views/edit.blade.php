@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        编辑项目
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="{{ url('projects/'.$field->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            {!! csrf_field() !!}
                            <div class="col-md-12">
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">项目名称</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" lay-verify="name" class="form-control" value="{{$field->name}}">
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">内容介绍</label>
                                    <div class="col-sm-9">
                                        <textarea name="body" class="form-control" required="required">{{$field->body}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">面积(m²)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="area" lay-verify="required" autocomplete="off" class="form-control" value="{{$field->area}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">结构体系</label>
                                    <div class="col-sm-9">
                                    <select name="structure_type" class="form-control">
                                        <option value="{{$field->structure_type}}">{{$field->structure_type}}</option>
                                        @if($field->structure_type=="框架结构")
                                        <option value="剪力墙结构">剪力墙结构</option>
                                        @else
                                        <option value="框架结构">框架结构</option>
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">项目经理(A)</label>
                                    <div class="col-sm-9">
                                        <select name="manager" class="form-control">
                                            <option value="{{$field->manager}}">{{$field->manager}}</option>
                                            @foreach($user as $u)
                                                <option value="{{$u->name}}">{{$u->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
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
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">预计图纸总量（张）</label>
                                    <div class="col-sm-9">
                                        <input name="pro_drawings"  lay-verify="required" autocomplete="off" class="form-control" value=" {{$field->pro_drawings}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">主要设计类型</label>
                                    <div class="col-sm-9">
                                    <select name="type" class="form-control">
                                        <option value="{{$field->type}}">{{$field->type}}</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">预计难度</label>
                                    <div class="col-sm-9">
                                        <input name="harder"  lay-verify="required" autocomplete="off" class="form-control" value=" {{$field->harder}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-sm-3 control-label">预计完成</label>
                                    <div class="col-sm-9">
                                        <input name="complet_time"  class="form-control layer-date" placeholder="YYYY-MM-DD hh:mm:ss" value=" {{$field->complet_time}}">
                                    </div>
                                </div>
                                <div class="col-md-8 form-group">
                                    <label class="col-sm-3 control-label">上传文件</label>
                                    <div class="col-md-9"> <input id="file" type="file" name="source" class="form-control" ></div>
                                </div>
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
   
@stop
