@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        {{$field->buildingid}}#楼glTF模型
    </h1>
    <link href="{{asset('css/smi/perfect-scrollbar.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/smi/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/smi/xeogl.js')}}"></script>

    <script src="{{asset('js/smi/vectorTextGeometry.js')}}"></script>

    <script src="{{asset('js/smi/glTFModel.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/smi/smi.js')}}"></script>
    <script src="{{asset('js/smi/movedobject.js')}}"></script>

    <link href="{{asset('css/smi/styles.css')}}" rel="stylesheet"/>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <canvas id="myCanvas3" style="width: 100%;height: 600px;background: #00FFFF"></canvas>
                    <div id="explorer" class="dark" style="left: 40px;top:50px">构件清单</div>
                    <div id="exploreright" class="dark" style="left: 600px;top:100px">构件属性</div>

                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" language="javascript">
    movedobject("#explorer","click_event1");
    movedobject("#exploreright","click_event2");
    smi("explorer","exploreright", "myCanvas3",[
        {
            src: "/images/models4.0.gltf"
        }
    ]);
</script>
@stop
