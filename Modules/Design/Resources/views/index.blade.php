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
        任务管理
        @if(Auth::user()->role_id==1)
            <button class="btn btn-success" id="addBtn"><i class="voyager-plus">创建</i></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" id="deleteAll"><i class="voyager-trash">删除选中</i></button>
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
                                <th>ID</th>
                                <th>名称</th>
                                <th>内容</th>
                                <th>状态</th>
                                <th>执行人</th>
                                <th>项目名称</th>
                                <th>发布人</th>
                                <th>预计完成时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
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
                    <!--没有选择到的时候弹窗话框-->
                    <div class="modal fade" id="selectnothing" tabindex="-1" role="dialog"
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
                                        <h5>您什么都没选择，至少需要选择一项！</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="selectnothingsubmit">
                                            确认
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--多个删除确认对话框-->
                    <div class="modal fade" id="deleteselectmodel" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" >
                        <form class="form-horizontal" role="form">
                            <div class="modal-dialog modal-sm " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"
                                                data-dismiss="modal" aria-hidden="true">&times; </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            提示信息
                                        </h4>
                                    </div>
                                    <div class="modal-body" style="text-align: left;">
                                        <h5>您确定要删除当前选择信息吗？</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="deleteselectmodelsubmit">
                                            确认
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--显示任务内容-->
                    <div class="modal fade" id="taskshow" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" >
                        <form class="form-horizontal" role="form">
                            <div class="modal-dialog modal-sm " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"
                                                data-dismiss="modal" aria-hidden="true">&times; </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            提示信息
                                        </h4>
                                    </div>
                                    <div class="modal-body" style="text-align: left;">
                                        <div class="col-md-5">
                                            <div class="form-group col-md-8">
                                                <label class="col-sm-3 control-label">项目名称</label>
                                                <div class="col-sm-9">
                                                    {{$field->status}}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">

                                                <label class="col-sm-2 control-label"><strong>任务名称:</strong></label>
                                                <div class="col-sm-8">
                                                    {{$field->taskname}}
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-sm-2 control-label">内容</label>
                                                <div class="col-sm-8">
                                                    {{$field->body}}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label class="col-sm-3 control-label">执行人</label>
                                                <div class="col-sm-9">
                                                    {{$field->personid}}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-8">
                                                <label class="col-sm-3 control-label">状态</label>
                                                <div class="col-sm-9">
                                                    {{$field->status}}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-8">
                                                <label class="col-sm-3 control-label">发布者</label>
                                                <div class="col-sm-9">
                                                    {{$field->senterid}}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-8">
                                                <label class="col-sm-3 control-label">预计完成</label>
                                                <div class="col-sm-9">
                                                    {{$field->pro_complatetime}}
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!--新增页面开始-->
                    <div class="modal fade" id="myModal-add-info" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width:800px">
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        新 增
                                    </h4>
                                </div>
                                <form class="form-horizontal" role="form" action="{{url('task')}}" method="post"  id="task_add" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">任务名称</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入任务名称" class="form-control">
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
                                            <label class="col-sm-3 control-label">状态</label>
                                            <div class="col-sm-9">
                                                <select name="status" class="form-control">
                                                    <option value="0">未完成</option>
                                                    <option value="1">已完成</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">执行人</label>
                                            <div class="col-sm-9">
                                                <select name="personid" class="form-control">
                                                    <option value="">请选择</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-sm-3 control-label">预计完成</label>
                                            <div class="input-append date form_datetime col-md-9">
                                                <input name="pro_complatetime" class="form-control" size="16" type="text" readonly>
                                                <span class="add-on"><i class="icon-th"></i></span>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">关闭
                                            </button>
                                            <button type="button" class="btn btn-primary" id="taskaddbutton">
                                                提交
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div><!-- /.modal-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    'url':'{{ url('task/getlist') }}',
                    'type':"GET"
                },
                "dom": '<l<\'#topPlugin\'>f>rt<ip><"clear">',
                "columns": [
                    {
                        "mData" : "id",
                        "orderable": false , // 禁用排序
                        "sDefaultContent" : "",
                        "sWidth" : "2%"
                    },
                    { data: 'id', name: 'id' ,
                        'render':function(id){
                            return '<a href="task/'+id+'/show">'+id+'</a>';
                        }
                    },
                    { data: 'taskname', name: 'taskname' },
                    { data: 'body', name: 'body' },
                    { data: 'status', name: 'status' },
                    { data: 'personid', name: 'personid' },
                    { data: 'projectid', name: 'projectid' },
                    { data: 'senterid', name: 'senterid' },
                    { data: 'pro_complatetime', name: 'pro_complatetime' },
                    {
                        "mData" : "id",
                        "orderable" : false,
                        "sDefaultContent" : '',
                        "sWidth" : "10%",
                        "render":function(data, type, full, meta){
                            return	data='<button id="editOne" class="btn btn-sm btn-primary" data-id='+data+'>编辑</button>' +
                                '<button id="deleteOne" class="btn btn-sm btn-danger" data-id='+data+'>删除</button>';
                        }}
                ],
                "columnDefs" :
                    [{
                        "orderable" : false, // 禁用排序
                        "targets" : [0], // 指定的列
                        "data" : "id",
                        "render" : function(data, type, full, meta) {
                            return '<input type="checkbox" value="'+ data + '" name="id"/>';
                        }
                    }],
                "language" : {
                    "lengthMenu": "每页 _MENU_ 条记录",
                    "processing": "正在加载数据...",
                    "sZeroRecords" : "没有找到数据",
                    "info": "第 _START_ 到第 _END_ 条数据，总共有 _TOTAL_ 条记录",
                    "infoEmpty": "没有数据",
                    "infoFiltered": "（从 _MAX_ 条数据中过滤得到）",
                    "search":"搜索：",
                    "paginate": {
                        "first": "第一页",
                        "last": "最后一页",
                        "next": "下一页",
                        "previous": "上一页",
                    }
                }
            });

            /**
             * 单行编辑
             */
            function editOne(data) {
                self.location='task/'+data+'/edit';
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
                    url:'task/'+id+'/destroy',
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
            //导出csv格式表格
            $(document).delegate('#expCsv','click',function() {
                //alert('可以执行！');
                $("#exp").attr("src","/project/export.do?t=" + new Date().getTime());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).delegate('#addBtn','click',function() {
                self.location='task/create';
                //$('#myModal-add-info').modal('show');
            });
            /**
             * 点击增加内容按钮
             */
            $(document).delegate('#taskaddbutton','click',function(){
                $('#myModal-add-info').modal('hide');
                $.ajax({
                    url: "task",
                    method: "POST",
                    //data: {"_token": _token},
                    dataType: "json",
                    success: function success(data) {
                        if (data.error != 0) {
                            alert(data.msg);
                            return;
                        }
                    }
                });

                //window.location.reload();
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
                    url:'task/'+id+'/destroy',
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
    <script type="text/javascript" src="{{asset('js/scripts/task.js')}}"></script>

@stop
