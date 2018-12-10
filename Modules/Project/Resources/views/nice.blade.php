@extends('project::layouts.master')

@section('content')
    <h1>中民筑友项目信息显示</h1>

    <p>
        <br>
        项目id为{{$field->id}}
        <br>
        项目名称为{{$field->name}}
        <br>
    </p>
@stop
