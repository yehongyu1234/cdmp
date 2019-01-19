@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        任务审核状态
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-bordered">
                    <div class="panel-body">
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
                                    {{$field->body}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">审核意见：</label>
                                <div class="col-sm-10">
                                        @if($field->status==0)
                                           未通过
                                        @else
                                            通过
                                        @endif
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">评分：</label>
                                <div class="col-sm-10">
                                    {{$field->numbers}}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
@stop
