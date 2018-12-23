@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        创建项目
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
                                <label class="col-sm-3 control-label">项目名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入项目名称" class="form-control">
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
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">预计完成</label>
                                <div class="col-sm-9">
                                    <input name="complet_time"  class="form-control layer-date" placeholder="YYYY-MM-DD hh:mm:ss" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">

                                </div>
                            </div>
                            </div>
                            <div class="col-md-3">项目地点
                                <div  style="height: 500px" id="map-container"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-3 control-label">上传文件</label>
                                <div class="col-md-9"> <input type="file" name="files" class="form-control"></div>
                            </div>
                        <div class="form-group col-md-12">
                            <div class="col-sm-12 col-sm-offset-5">
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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=HFQRg1xTCB9904KXqr6audLj"></script>
<script type="text/javascript">
    var map = new BMap.Map('map-container');
    var point = new BMap.Point(118.78,32.06);
    map.centerAndZoom(point, 12);
    map.enableScrollWheelZoom(true);
    // 编写自定义函数,创建标注
    function addMarker(point){
        var marker = new BMap.Marker(point);
        map.addOverlay(marker);
        marker.setLabel(label);
    }
    // 随机向地图添加25个标注
    var bounds = map.getBounds();
    var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();
    var lngSpan = Math.abs(sw.lng - ne.lng);
    var latSpan = Math.abs(ne.lat - sw.lat);
    for (var i = 0; i < 25; i ++) {
        var point = new BMap.Point(sw.lng + lngSpan * (Math.random() * 0.7), ne.lat - latSpan * (Math.random() * 0.7));
        var label = new BMap.Label("项目"+i,{offset:new BMap.Size(20,-10)});
        addMarker(point,label);
    }
</script>
@stop
