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
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
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
                                <label class="col-sm-3 control-label">项目负责人</label>
                                <div class="col-sm-9">
                                    <select name="manager" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($user as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">营销经理</label>
                                <div class="col-sm-9">
                                    <select name="market_manager" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($user as $u)
                                            <option value="{{$u->id}}">{{$u->name}}</option>
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
                                <label class="col-sm-3 control-label">预计产生工作量</label>
                                <div class="col-sm-9">
                                    <input name="pro_drawings"  lay-verify="required" autocomplete="off" class="form-control" placeholder="用于计算总设计工作量限制">
                                </div>
                            </div>


                            </div>
                        <div class="col-md-6">

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
                                <label class="col-sm-3 control-label">建设方</label>
                                <div class="col-sm-9">
                                    <select name="construction_company_id" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">建设方联系人</label>
                                <div class="col-sm-9">
                                    <select name="construction_connector" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">设计单位</label>
                                <div class="col-sm-9">
                                    <select name="design_company_id" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">施工单位</label>
                                <div class="col-sm-9">
                                    <select name="building_company_id" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($designtype as $d)
                                            <option value="{{$d->workbody}}">{{$d->workbody}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-sm-3 control-label">监理单位</label>
                                <div class="col-sm-9">
                                    <select name="vis_company_id" class="form-control">
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
                                <div class="input-append date form_datetime col-md-9">
                                    <input name="complet_time" class="form-control" size="16" type="text" value="{{date('Y-m-d h:i')}}" readonly>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-sm-12 control-label">项目地点(选取位置后点击位置确定后再提交！)</label>
                            <div class="col-sm-12">
                                <div  style="height: 400px" id="map-container"></div>
                                <input id="location" name="location" type="text" hidden/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="file">选择文件</label>
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
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('js/locale/bootstrap-datetimepicker.zh-CN.js')}}" charset="UTF-8"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        language:  'zh-CN',
        format: "yyyy-mm-dd hh:ii"
    });
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=HFQRg1xTCB9904KXqr6audLj"></script>
<script type="text/javascript">
    var map = new BMap.Map('map-container');
    var point = new BMap.Point(118.78,32.06);
    map.centerAndZoom(point, 12);
    // 添加带有定位的导航控件
    var navigationControl = new BMap.NavigationControl({
        // 靠左上角位置
        anchor: BMAP_ANCHOR_TOP_LEFT,
        // LARGE类型
        type: BMAP_NAVIGATION_CONTROL_LARGE,
        // 启用显示定位
        enableGeolocation: true
    });
    map.addControl(navigationControl);
    var marker = new BMap.Marker(point);
    map.addOverlay(marker);
    marker.enableDragging();
    marker.addEventListener("click",getAttr);
    function getAttr(){
        var p = marker.getPosition();       //获取marker的位置
        var newpt=p.lng + "," + p.lat;
        document.getElementById('location').value=newpt;
        alert("您选取的位置坐标是：" + p.lng + "," + p.lat);
    }
</script>
@stop
