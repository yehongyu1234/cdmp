@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        任务审核
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="{{ url('tchecks/'.$field->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            {!! csrf_field() !!}
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">项目名称：</label>
                                <div class="col-sm-10">
                                    {{$project->name}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">审核任务名称：</label>
                                <div class="col-sm-10">
                                    {{$taskname->taskname}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">审核意见：</label>
                                <div class="col-sm-10">
                                    <textarea name="body" placeholder="请输入内容" class="form-control" required="required">{{$field->body}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">审核意见：</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        @if($field->status==0)
                                        <option value="0" selected>未通过</option>
                                            <option value="1">通过</option>
                                        @else
                                        <option value="0" >未通过</option>
                                        <option value="1" selected>通过</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                                <div class="form-group col-md-12">
                                    <label class="col-sm-2 control-label">评分：</label>
                                    <div class="col-sm-10">
                                        <input name="numbers" class="form-control" required="required" value="{{$field->numbers}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-sm-12 col-sm-offset-3">
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
@stop
