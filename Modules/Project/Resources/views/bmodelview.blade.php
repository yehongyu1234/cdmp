@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        {{$field->buildingid}}#楼gltf模型
    </h1>

    <link href="{{asset('css/smi/perfect-scrollbar.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/smi/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/smi/xeogl.js')}}"></script>

    <script src="{{asset('js/smi/vectorTextGeometry.js')}}"></script>
    <script src="{{asset('js/smi/axisHelper.js')}}"></script>

    <script src="{{asset('js/smi/glTFModel.js')}}"></script>
    <script src="{{asset('js/smi/dat.gui.min.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/smi/smi.js')}}"></script>
    <link href="{{asset('css/smi/styles.css')}}" rel="stylesheet"/>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <canvas id="myCanvas3" style="width: 100%;height: 600px"></canvas>
                    <div id="explorer" class="dark" style="left: 40px;top:50px">构件清单</div>
                    <div id="exploreright" class="dark" style="left: 600px;top:100px">构件属性</div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/jquery.min.js')}}"></script>
<script type="text/javascript" language="javascript">
    smi("explorer","exploreright", "myCanvas3",[
        {
            src: "http://localhost/images/models4.0.gltf"
        }
    ]);
</script>
<script type="text/javascript" language="javascript">

    function movedobject(tagid,clickid) {
        var _move = false; //移动标记
        var _x, _y; //鼠标离控件左上角的相对位置

        $(document).ready(function () {
            $(tagid).click(function () {
                //alert("click");//点击（松开后触发）
            }).mousedown(function (e) {
                _move = true;
                _x = e.pageX - parseInt($(tagid).css("left"));
                _y = e.pageY - parseInt($(tagid).css("top"));

                $(tagid).fadeTo(20, 0.3); //点击后开始拖动并透明显示
            });
            $(document).mousemove(function (e) {
                if (_move) {
                    var x = e.pageX - _x; //移动时根据鼠标位置计算控件左上角的绝对位置
                    var y = e.pageY - _y;
                    $(tagid).css({
                        top: y,
                        left: x
                    }); //控件新位置
                }
            }).mouseup(function () {
                _move = false;
                $(tagid).fadeTo(20, 0.6); //松开鼠标后停止移动并恢复成不透明
            });
        });
    };
    movedobject("#explorer","click_event1");
    movedobject("#exploreright","click_event2");

</script>

@stop
