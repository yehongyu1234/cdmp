<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
       video{height: 300px;
           width: 400px;}
        body{background: #050d1d
        }
    </style>
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="col-md-4"><h5>中民筑友项目分布</h5></div> <div class="col-md-8"><h5>项目信息</h5></div></div>
                        <div class="col-md-8" style="height: 400px;width:300px" id="map-container">
                        </div>
                        <div class="col-md-4" style="border: #0c199c;height: 100px">项目总数：10</div>
                        <video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay>
                            <source src="rtmp://rtmp.open.ys7.com/openlive/1d598db1b29042749447a2324b89a5ae" type="" />
                            <source src="http://hls.open.ys7.com/openlive/1d598db1b29042749447a2324b89a5ae.m3u8" type="application/x-mpegURL" />
                        </video>

                    </div>
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
<script language="JavaScript">
    function myrefresh(){
    window.location.reload();
    }
    setTimeout('myrefresh()',1000000); //指定10秒刷新一次
</script>
