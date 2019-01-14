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
                    <form action="{{ url('company') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">企业名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入企业名称" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">主营业务</label>
                                <div class="col-sm-9">
                                    <textarea name="body" placeholder="请输入内容" class="form-control" required="required"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">联系人</label>
                                <div class="col-sm-9">
                                    <select name="connectorid" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($connect as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">诚信评价</label>
                                <div class="col-sm-9">
                                    <input name="history"  autocomplete="off" class="form-control" placeholder="输入级别">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">组织机构代码</label>
                                <div class="col-sm-9">
                                    <input name="com_code"  autocomplete="off" class="form-control" placeholder="输入组织机构代码">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">类型</label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control">
                                        <option value="">请选择</option>
                                        <option value="政府">政府</option>
                                        <option value="施工单位">施工单位</option>
                                        <option value="设计院">设计院</option>
                                        <option value="建设单位">建设单位</option>
                                        <option value="构件供应商">构件供应商</option>
                                        <option value="监理单位">监理单位</option>
                                        <option value="材料供应商">材料供应商</option>
                                        <option value="劳务分包">劳务分包</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">营销经理</label>
                                <div class="col-sm-9">
                                    <select name="marketmanager_id" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($user as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
                        <div class="col-md-6">
                            <label for="file">营业执照</label>
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
