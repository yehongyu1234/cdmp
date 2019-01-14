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
    项目管理
    @if(Auth::user()->role_id==1)
        <button class="btn btn-success" id="createdata"><i class="voyager-plus">创建</i></button>&nbsp;&nbsp;&nbsp;
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
                        <th>项目编号</th>
                        <th>项目名称</th>
                        <th>状态</th>
                        <th>预计工作量</th>
                        <th>难度</th>
                        <th>类型</th>
                        <th>管理员</th>
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
                'url':'{{ url('project/getlist') }}',
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

                { data: 'project_id', name: 'project_id',
                    'render':function(id){
                        return '<a href="project/'+id+'/show">'+id+'</a>';
                    }
                    },
                {
                    'data': 'name',
                    'name': 'name'
                },
                { data: 'statue', name: 'statue' },
                { data: 'pro_drawings', name: 'pro_drawings' },
                { data: 'harder', name: 'harder' },
                { data: 'type', name: 'type' },
                { data: 'manager', name: 'manager' },
                {
                    "mData" : "id",
                    "orderable" : false,
                    "sDefaultContent" : '',
                    "sWidth" : "10%",
                    "render":function(data){
                        return	data='<button id="editOne" class="btn btn-sm btn-primary" data-id='+data+'>编辑</button>';
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
         * 创建事件
         */
         $(document).delegate('#createdata','click',function() {
             self.location='project/create';
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
        //导出csv格式表格
        $(document).delegate('#expCsv','click',function() {
            //alert('可以执行！');
            $("#exp").attr("src","/project/export.do?t=" + new Date().getTime());
        });
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
