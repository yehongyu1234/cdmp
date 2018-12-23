@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-home"></i>主页</h1>
@stop
@section('content')
    <style>
       video{max-width: 800px;width: 100%;}
    </style>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="col-md-12">
                        <h3>项目分布</h3>
                    <div class="col-md-8" style="height: 500px" id="map-container">

                    </div>
                    <div class="col-md-4"><h3>项目清单</h3>
                    这里导入项目信息
                        再加入话测试git的更新情况
                    </div>

                    </div>
                    <div class="col-md-12">项目监控显示
                        <video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay>
                            <source src="rtmp://rtmp.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b" type="" />
                            <source src="http://hls.open.ys7.com/openlive/f01018a141094b7fa138b9d0b856507b.m3u8" type="application/x-mpegURL" />
                        </video>
                    </div>
                    <div class="col-md-12">项目任务</div>
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
    for (var i = 0; i <10;i++) {
        var point = new BMap.Point(sw.lng + lngSpan * (Math.random() * 0.7), ne.lat - latSpan * (Math.random() * 0.7));
        var label = new BMap.Label("项目"+i,{offset:new BMap.Size(20,-10)});
        addMarker(point,label);
    }
</script>
<script src="https://open.ys7.com/sdk/js/1.4/ezuikit.js"></script>
<script>
    var player = new EZUIPlayer('myPlayer');
    player.on('error', function(){
        console.log('error');
    });
    player.on('play', function(){
        console.log('play');
    });
    player.on('pause', function(){
        console.log('pause');
    });
</script>

@stop
