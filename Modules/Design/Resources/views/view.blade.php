@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
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
                                        在审核
                                        @elseif($field->status==0)
                                        未完成
                                        @else
                                    已完成
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
                            @if(Auth::user()->role_id==1)

                                <div class="form-group col-md-12">
                                    <label class="col-sm-4 control-label">实际得到积分</label>
                                    <div class="col-sm-8">
                                        {{$field->fraction}}
                                    </div>
                                </div>
                                @endif
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
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>审核状态</th>
                                    <th>审核人</th>
                                    <th>评语</th>
                                    <th>当前审核次数</th>
                                    <th>评分</th>
                                    @if(Auth::user()->role_id==1)
                                    <th>原始积分</th>
                                    @endif
                                    <th>是否需要再次审核</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tcheck as $bd)
                                    <tr>
                                        @if($bd->status==0)
                                        <td>未审核</td>
                                        @else
                                            <td><button class="btn-xs btn-success">审核通过</button><i class="voyager-check"></i> </td>
                                        @endif
                                        <td>{{\App\User::where('id',$bd->checker)->first()->name}}</td>
                                        <td>{{$bd->body}}</td>
                                        <td>{{$bd->times}}</td>
                                        <td>{{$bd->numbers}}</td>
                                            @if(Auth::user()->role_id==1)
                                         <td>{{floatval($field->fraction)*100/intval($bd->numbers)}}</td>
                                            @endif
                                        @if($bd->another==0)
                                            <td>否</td>
                                        @else
                                            <td>需要</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $tcheck->links() }}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@stop
