@extends('project::layouts.master')
@section('content')
    <div class="col-xs-12 col-sm-6 col-md-8">
<img src="http://61.132.72.194:9272/storage/f5dIGcQwygzmMknojDaitCTHNxGsir8ZS4moc6Tl.jpeg" width="100%">
    </div>
<p>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-8">
    <h2>项目简介</h2>
    <hr width="100%" color="#bbe6ff">
    {{$field->body}}
</div>
<div class="col-md-12">
    <h2>工程概况</h2>
    <hr width="100%" color="#bbe6ff">
    <label>项目名称：</label>{{$field->name}}
    <br>
    <label>建设地点：</label>{{$field->location}}
    <br>
    <label>建设单位：</label>{{$field->name}}
    <br>
    <label>设计单位：</label>{{$field->name}}
    <br>
    <label>施工单位：</label>{{$field->name}}
    <br>
    <label>监理单位：</label>{{$field->name}}
    <br>
    <label>建筑面积：</label>{{$field->area}}㎡
    <br>
    <label>结构类别：</label>{{$field->structure_type}}
</div>
<div>
    <h2>项目监护</h2>
    <hr width="100%" color="#bbe6ff">
    <label>项目经理：</label>{{$field->name}}
    <br>
    <label>生产经理：</label>{{$field->location}}
    <br>
    <label>技术经理：</label>{{$field->name}}
    <br>
    <label>施工员：</label>{{$field->name}}
    <br>
    <label>安全员：</label>{{$field->name}}
    <br>
    <label>物资材料员：</label>{{$field->name}}
    <br>
    <label>测量员：</label>{{$field->area}}㎡
    <br>
    <label>项目总监：</label>{{$field->structure_type}}
</div>
<div>
    <h2>项目信息</h2>
    <hr width="100%" color="#bbe6ff">
    <a href="#">安全检查项</a>
    <br>
    <a href="#">质量检查项</a>
    <br>
    <a href="#">项目通讯录</a><br>
    <a href="#">查看详情</a><br>
</div>
    <hr width="100%" color="#bbe6ff">
    <span class="copyright-text"><span>©2018&nbsp;中民筑友&nbsp;</span><br>
    <img src="http://61.132.72.194:9272/storage/zaa5RzziNWX4m7HQarNrDrW1so4lhWCuUbphu182.png" width="120px">
    </span>
</div>
@stop
