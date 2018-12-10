<table style="width:100%">
    <tr>
        <th>ID</th>
        <th>项目编号</th>
        <th>项目名称</th>
        <th>内容</th>
        <th>状态</th>
        <th>预计图纸量</th>
        <th>难度</th>
        <th>类型</th>
        <th>创建人</th>
        <th>管理员</th>
        <th>操作</th>
    </tr>
    @if (isset($results) && count($results) > 0)
        @foreach( $results as $business )
            <tr>
                <td>{{$f->id}}</td>
                <td>{{$f->project_id}}</td>
                <td><a href="{{url("project/".$f->id."/show")}}" style="text-decoration: none">{{$f->name}}</a></td>
                <td>{{$f->body}}</td>
                <td>{{$f->statue}}</td>
                <td>{{$f->pro_drawings}}</td>
                <td>{{$f->harder}}</td>
                <td>{{$f->type}}</td>
                <td>{{$f->pro_creator}}</td>
                <td>{{$f->manager}}</td>
                <td>
                    <a class="btn-sm btn-primary edit" href="{{url('project/'.$f->id.'/edit')}}">编辑</a>
                    <a href="{{url('project/'.$f->id.'/destroy')}}" class="btn-sm btn-danger">删除</a>
                </td>
            </tr>
@endforeach
@endif