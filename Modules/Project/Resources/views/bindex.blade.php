@extends('voyager::master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('js/jquery.dataTables.js')}}"></script>
@stop
@section('page_header')
<h1 class="page-title">
    <i class=""></i>
    项目楼栋管理
    @if(Auth::user()->role_id==1)
        <button class="btn btn-success" id="createdata"><i class="voyager-plus">创建</i></button>&nbsp;&nbsp;&nbsp;
        <button class="btn btn-danger" ><i class="voyager-trash">删除选中</i></button>
    @endif
</h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                <table class="display" id="table" style="width:100%">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="allChecked" /></th>
                        <th>楼栋号</th>
                        <th>项目名称</th>
                        <th>层数</th>
                        <th>结构类型</th>
                        <th>面积(m2)</th>
                        <th>相同于</th>
                        <th>设计人</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($feild as $f)
                        <tr>
                            <td><input type="checkbox" name="allChecked" /></td>
                            <td><a href="{{url('building/'.$f->id.'/show')}}">{{$f->buildingid}}</a></td>
                            <td><a href="{{url('project/'.\Modules\Project\Entities\Project::where('id',$f->project_id)->first()->project_id.'/show')}}" >{{\Modules\Project\Entities\Project::where('id',$f->project_id)->first()->name}}</a></td>
                            <td>{{$f->floors}}</td>
                            <td>{{$f->structure_type}}</td>
                            <td>{{$f->area}}</td>
                            <td>{{$f->sameas}}</td>
                            <td>{{$f->designerid}}</td>
                            <td><button class="btn btn-warning btn-xs">编辑</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                    <!--单个删除确认对话框-->
                    <div class="modal fade" id="deleteOneModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" >
                        <form class="form-horizontal" role="form">
                            <div class="modal-dialog modal-sm " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"
                                                data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            提示信息
                                        </h4>
                                    </div>
                                    <div class="modal-body" style="text-align: left;">
                                        <h5>您确定要删除当前信息吗？</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="delSubmit">
                                            确认
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
    </div>
<script>
    $(document).ready(function(){

        /**
         * 创建事件
         */
         $(document).delegate('#createdata','click',function() {
             self.location='project/bcreate';
         });
        /**
         * 单行编辑
         */
        function editOne(data) {
            self.location='project/'+data+'/edit';
        }
        $(document).delegate('#editOne','click',function() {
            var id=$(this).data("id");
            editOne(id);
        });
        /**
         * 单行删除按钮点击事件响应
         */
        $(document).delegate('#deleteOne','click',function() {
            var id=$(this).data("id");
            $("#delSubmit").val(id);
            $("#deleteOneModal").modal('show');
        });
        /**
         * 点击确认删除按钮
         */
        $(document).delegate('#delSubmit','click',function(){
            var id=$(this).val();
            $('#deleteOneModal').modal('hide');
            $.ajax({
                url:'project/'+id+'/destroy',
                async:true,
                type:"GET",
                dataType:"json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.location.reload();
        });
        /**
         * 多选选中和取消选中,同时选中第一个单元格单选框,并联动全选单选框
         */
        var table = $('#table').DataTable();
        $('#table tbody').on('click', 'tr', function(event) {
            var allChecked=$('input[name=allChecked]')[0];//关联全选单选框

            $($(this).children()[0]).children().each(function(){
                if(this.type=="checkbox" && (!$(event.target).is(":checkbox") && $(":checkbox",this).trigger("click"))){
                    if(!this.checked){
                        this.checked = true;
                        addValue(this);
                        // console.log(this);
                        //console.log(table.rows);
                        var selected=table.rows('.selected').data().length;//被选中的行数
                        //全选单选框的状态处理
                        var recordsDisplay=table.page.info().recordsDisplay;//搜索条件过滤后的总行数
                        var iDisplayStart=table.page.info().start;// 起始行数
                        if(selected === table.page.len()||selected === recordsDisplay||selected === (recordsDisplay - iDisplayStart)){
                            allChecked.checked = true;
                        }
                    }else{
                        this.checked = false;
                        cancelValue(this);
                        allChecked.checked = false;
                    }
                }
            });
            $(this).toggleClass('selected');//放在最后处理，以便给checkbox做检测
        });
        /**
         * 全选按钮被点击事件
         */
        $('input[name=allChecked]').click(function(){
            if(this.checked){
                $('#table tbody tr').each(function(){
                    if(!$(this).hasClass('selected')){
                        $(this).click();
                    }
                });
            }else{
                $('#table tbody tr').click();
            }
        });
        /**
         * 单选框被选中时将它的value放入隐藏域
         */
        function addValue(para) {
            var userIds = $("input[name=userIds]");
            if(userIds.val() === ""){
                userIds.val($(para).val());
            }else{
                userIds.val(userIds.val()+","+$(para).val());
            }
        }
        /**
         * 单选框取消选中时将它的value移除隐藏域
         */
        function cancelValue(para){
            //取消选中checkbox要做的操作
            var userIds = $("input[name=allChecked]");
            var array = userIds.val().split(",");
            userIds.val("");
            for (var i = 0; i < array.length; i++) {
                if (array[i] === $(para).val()) {
                    continue;
                }
                if (userIds.val() === "") {
                    userIds.val(array[i]);
                } else {
                    userIds.val(userIds.val() + "," + array[i]);
                }
            }
        }

        $(document).delegate('.addBtn','click',function() {
            $('#myModal-add-info').modal('show');
        });
        /**
         * 未选择提示
         */
        $(document).delegate('#deleteAll','click',function() {
            var theArray=[];
            $("input[name=id]:checked").each(function() {
                theArray.push($(this).val());
            });
            if(theArray.length<1){
                $('#selectnothing').modal('show');
            }else{
                $("#deleteselectmodelsubmit").val(theArray);
                $('#deleteselectmodel').modal('show');
            }
        });
        /**
         * 未选择提示
         */
        $(document).delegate('#selectnothingsubmit','click',function(){
            $('#selectnothing').modal('hide');
        });
        /**
         * 点击确认删除按钮
         */
        $(document).delegate('#deleteselectmodelsubmit','click',function(){
            var id=$(this).val();
            $('#deleteselectmodel').modal('hide');
            $.ajax({
                url:'project/'+id+'/destroy',
                async:true,
                type:"GET",
                dataType:"json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.location.reload();
        });
    });
</script>

@stop
