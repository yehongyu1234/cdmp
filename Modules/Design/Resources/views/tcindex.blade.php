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
                                <th>任务名称</th>
                                <th>任务状态</th>
                                <th>审查人</th>
                                <th>审查意见</th>
                                <th>审查次数</th>
                                <th>评分</th>
                                <th>是否需要重新审核</th>
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
                                                data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            提示信息
                                        </h4>
                                    </div>
                                    <div class="modal-body" style="text-align: left;">
                                        <h5 id="showdata">您确定要删除当前信息吗？</h5>
                                    </div>
                                    <div class="modal-footer" id="modalfooter">
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
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "bStateSave": true,
                "order":  [ 1, 'desc' ],
                "ajax": {
                    'url':'tcheck/getlist',
                    'type':"GET"
                },
                "dom": '<l<\'#topPlugin\'>f>rt<ip><"clear">',
                "columns": [
                    {
                        "mData" : "id",
                        "sDefaultContent" : "",
                        "sWidth" : "2%"
                    },
                    { data: 'id',
                        name: 'id' ,
                        'render':function(id){
                            return '<a href="tcheck/'+id+'/show">'+id+'</a>';
                        }
                    },
                    { data: 'taskid', name: 'taskid' },
                    {
                        'data':'status',
                        'name':'status',
                        "render":function(data) {
                            if (data == 0) {
                                return '<button class="btn btn-sm btn-warning" data-id=' + data + '>未审核</button>';
                            } else {
                                return '<button class="btn btn-sm btn-success">审核完成</button>';
                            }
                        }
                    },
                    { 'data': 'checker',
                        'name': 'checker'
                    },
                    { data: 'body', name: 'body' },
                    { data: 'times', name: 'times' },
                    { data: 'numbers',
                        name: 'numbers'
                    },
                    { data: 'another',
                        name: 'another'
                    },
                    {
                        "mData" : "id",
                        "orderable" : false,
                        "sDefaultContent" : '',
                        "sWidth" : "10%",
                        "render":function(data){
                            return data='<button id="editOne" class="btn btn-sm btn-primary" data-id='+data+'>编辑</button>';
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
                self.location='tcheck/'+data+'/edit';
            }
            $(document).delegate('#editOne','click',function() {
                var id=$(this).data("id");
                editOne(id);
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
            /**
             * 未选择提示
             */
            $(document).delegate('#deleteAll','click',function() {
                var theArray=[];
                $("input[name=id]:checked").each(function() {
                    theArray.push($(this).val());
                });
                if(theArray.length<1){
                    document.getElementById('showdata').innerHTML="未选择任何数据？";
                    $("#deleteOneModal").modal('show');
                }else{
                    $("#delSubmit").val(theArray);
                    document.getElementById('showdata').innerHTML="确定删除选择？";
                    $('#deleteOneModal').modal('show');
                }
            });
            /**
             * 未选择提示
             */
            $(document).delegate('#delSubmit','click',function(){
                $('#deleteOneModal').modal('hide');
            });
            /**
             * 点击确认删除按钮
             */
            $(document).delegate('#delSubmit','click',function(){
                var id=$(this).val();
                $('#deleteOneModal').modal('hide');
                $.ajax({
                    url:'tcheck/'+id+'/destroy',
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
@stop
