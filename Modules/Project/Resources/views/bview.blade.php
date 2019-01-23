@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        {{$field->buildingid}}#楼信息
    </h1>
        <a href="{{url('project/'.$field->id.'/edit')}}" class="btn btn-success">编辑</a>
    <!--
    <a onclick="alert('还在开发中，采用的glTF技术！')" class="btn btn-warning">查看模型</a>
        <a href="{{url('project/'.$field->id.'/creatask')}}" class="btn btn-info pull-right">创建任务</a>
        -->
    <link href="{{asset('css/smi/perfect-scrollbar.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/smi/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/smi/xeogl.js')}}"></script>

    <script src="{{asset('js/smi/vectorTextGeometry.js')}}"></script>
    <script src="{{asset('js/smi/axisHelper.js')}}"></script>

    <script src="{{asset('js/smi/glTFModel.js')}}"></script>
    <script src="{{asset('js/smi/dat.gui.min.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/smi/gltfExplorer.js')}}"></script>

    <link href="{{asset('css/smi/styles.css')}}" rel="stylesheet"/>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                            {!! csrf_field() !!}
                        <div class="col-md-12"><h4>基本信息</h4></div>
                        <hr width="100%" color=#987cb9 SIZE=10 />
                        <div class="col-md-5">
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label"><strong>项目名称:</strong></label>
                                <div class="col-sm-8">
                                    {{$field->project_id}}
                                </div>
                                <br>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-2 control-label">内容介绍</label>
                                <div class="col-sm-8">
                                    {{$field->floors}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">面积(m²)</label>
                                <div class="col-sm-9">
                                    {{$field->area}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">结构体系</label>
                                <div class="col-sm-9">
                                    {{$field->structure_type}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">相同于</label>
                                <div class="col-sm-9">
                                    {{$field->sameas}}
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">层高</label>
                                <div class="col-sm-9">
                                    {{$field->floor_height}}
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="col-sm-3 control-label">设计师</label>
                                <div class="col-sm-9">
                                    {{$field->designer_id}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">项目二维码
                            <br>
                            {!! QrCode::size(400)->generate('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.base64_decode($field->id).'/out'); !!}
                        </div>
                        <div class="col-md-4">项目
                            <canvas id="myCanvas3" class="multiCanvas" width="820px" height="400px"></canvas>
                        </div>
                    </div>
                    {{'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/project/'.base64_decode($field->guid).'/out'}}
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var trlisthtml = $("#trlist").html();//获取默认的一行tr，用作复制
        function removerow(){//移除
            $('input[name="checkbox"]:checked').each(function(){
                $(this).parent().parent().remove();//移除当前行 checkbox的父级是td，td的父级是tr，然后删除tr。就ok了。用each，选择多行遍历删除
            });
        };
        //增加数据弹窗
        $(document).delegate('#addrow', 'click', function () {
            $("#adddata").modal('show');
        });
        $(document).delegate('#removerow', 'click', function () {
            removerow();
        });
    });
</script>
<script type="text/javascript" language="javascript">
    var scene3 = new xeogl.Scene({
        canvas: "myCanvas3"
    });
    var camera = scene3.camera;
    camera.eye = [-14.63, 22.88, 10.04];
    camera.look = [10.98, 5.82, -11.23];
    camera.up = [0.35, 0.88, -0.29];
    camera.perspective.near=0.4;
    camera.perspective.fov=45;
    camera.perspective.far=100000;
    var cameraControl = new xeogl.CameraControl({
        doublePickFlyTo: false
    });
    var gearbox = new xeogl.GLTFModel(scene3, {
        src: "http://localhost/images/models4.0.gltf"
    });
    /**
    scene3.on("tick", function () {
        this.camera.orbitYaw(-0.2);
        this.camera.orbitPitch(0.1);
    });
     **/
    var cameraFlight = new xeogl.CameraFlightAnimation();

    //选择模型
    cameraControl.on("hoverEnter", function (hit) {
        hit.entity.highlighted = true;
    });

    cameraControl.on("hoverOut", function (hit) {
        hit.entity.highlighted = false;
    });

    cameraControl.on("picked", function (hit) {
        var entity = hit.entity;
        if (input.keyDown[input.KEY_SHIFT]) {
            entity.selected = !entity.selected;
            entity.highlighted = !entity.selected;
        } else {
            cameraFlight.flyTo(entity);
            //显示信息
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(infoId).innerHTML = this.responseText;
                }
            };
            str = entity.id;
            uid = str.split("#");
            endid = uid[1].split(".")
            xmlhttp.open("GET", "2.php?id=" + endid[0], true);
            xmlhttp.send();
        }
    });
    cameraControl.on("pickedNothing", function (hit) {
        cameraFlight.flyTo(model);
    });
    new xeogl.CameraControl(scene3);
    var cameraFlight = new xeogl.CameraFlightAnimation();
    //选择模型
    cameraControl.on("hoverEnter", function (hit) {
        hit.entity.highlighted = true;
    });

    cameraControl.on("hoverOut", function (hit) {
        hit.entity.highlighted = false;
    });

    cameraControl.on("picked", function (hit) {
        var entity = hit.entity;
        if (input.keyDown[input.KEY_SHIFT]) {
            entity.selected = !entity.selected;
            entity.highlighted = !entity.selected;
        } else {
            cameraFlight.flyTo(entity);
            //显示信息
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(infoId).innerHTML = this.responseText;
                }
            };
            str = entity.id;
            uid = str.split("#");
            endid = uid[1].split(".")
            xmlhttp.open("GET", "2.php?id=" + endid[0], true);
            xmlhttp.send();
        }
    });
    cameraControl.on("pickedNothing", function (hit) {
        cameraFlight.flyTo(model);
    });
    //选择列表
    window.selectObject = (function () {
        var lastEntity;
        var htmlinfo ='';
        return function (id) {
            //console.log(id);
            if (!id) {
                cameraFlight.flyTo();
                if (lastEntity) {
                    lastEntity.ghosted = false;
                    lastEntity.highlighted = false;
                    lastEntity = null;
                }
                return;
            }
            var entity = model.scene.entities[id];
            //console.log(entity.id);
            //通过php获取数据的信息并检索出显示出来
            //模型调转到选择编号的位置
            if (entity) {
                if (lastEntity) {
                    lastEntity.ghosted = false;
                    lastEntity.highlighted = false;
                }
                entity.ghosted = false;
                entity.highlighted = true;
                cameraFlight.flyTo({
                    aabb: entity.aabb,
                    fitFOV: 25,
                    duration: 1.0,
                    showAABB: false
                });
                lastEntity = entity;
                //显示信息
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(infoId).innerHTML = this.responseText;
                    }
                };
                str=entity.id;
                uid=str.split("#");
                endid=uid[1].split(".")
                xmlhttp.open("GET", "2.php?id=" + endid[0], true);
                xmlhttp.send();
            }
        };
    })();
    model.on("loaded", function () {
        var html = [""];
        var i = 0;
        //console.log(model.entities);
        html.push("构件清单：<br>");
        html.push("<hr/>");
        for (var entityId in model.entities) {
            if (model.entities.hasOwnProperty(entityId)) {
                var entity = model.entities[entityId];
                var numberid=entity.id.split("/")[0].split('#')[1];
                // console.log(numberid);
                html.push("<a href='javascript:selectObject(\"" + entity.id + "\")'>" + numberid + "</a><br>")

            }
        }
        document.getElementById(menuId).innerHTML = html.join("");

        cameraFlight.jumpTo({
            aabb: model.aabb,
            fit: true,
            fitFOV: 45
        });
    });

</script>
@stop
