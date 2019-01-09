@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css" class="init">
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/buttons.dataTables.css')}}">
    <!--<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.css')}}">-->

    <script type="text/javascript" language="javascript" src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('js/jquery.dataTables.js')}}"></script>

@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        项目管理
        <a href="{{url('project/create')}}" class="btn btn-success">创建</a>
    </h1>
@stop
@section('content')
   <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <button   class="btn btn-danger btn-sm" id="deleteAll">批量删除</button>
                        <button   class="btn btn-primary btn-sm addBtn" >新增</button>
                       <iframe id="exp" style="display:none;">
      </iframe><button  class="btn btn-info btn-sm" id="expCsv">导出全部</button>
                <table class="display" id="table" style="width:100%">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="allChecked" /></th>
                        <th>ID</th>
                        <th>项目编号</th>
                        <th>项目名称</th>
                        <th>状态</th>
                        <th>预计图纸量</th>
                        <th>难度</th>
                        <th>类型</th>
                        <th>创建人</th>
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
                                <form class="form-horizontal" role="form" action="{{url('project')}}" method="post"  id="category_add" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {!! csrf_field() !!}

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
                                                <label class="col-sm-3 control-label">项目经理(A)</label>
                                                <div class="col-sm-9">
                                                    <select name="manager" class="form-control">
                                                        <option value="">请选择</option>

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
                                                <label class="col-sm-3 control-label">预计图纸总量（张）</label>
                                                <div class="col-sm-9">
                                                    <input name="pro_drawings"  lay-verify="required" autocomplete="off" class="form-control" placeholder="根据构件数量">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-sm-3 control-label">主要设计类型</label>
                                                <div class="col-sm-9">
                                                    <select name="type" class="form-control">
                                                        <option value="">请选择</option>

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
                                                    <input name="complet_time" class="form-control" size="16" type="text" readonly>
                                                    <span class="add-on"><i class="icon-th"></i></span>
                                                </div>
                                            </div>


                                        <div class="col-md-12">
                                            <label for="file">选择文件</label>
                                            <input id="file" type="file" class="form-control" name="source">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">关闭
                                            </button>
                                            <button type="button" class="btn btn-primary" id="btnsubmit">
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
                    { data: 'id', name: 'id' ,
                        'render':function(id){
                            return '<a href="project/'+id+'/show">'+id+'</a>';
                        }
                    },
                    { data: 'project_id', name: 'project_id' },
                    {
                        'data': 'name',
                        'name': 'name'
                    },
                    { data: 'statue', name: 'statue' },
                    { data: 'pro_drawings', name: 'pro_drawings' },
                    { data: 'harder', name: 'harder' },
                    { data: 'type', name: 'type' },
                    { data: 'pro_creator', name: 'pro_creator' },
                    { data: 'manager', name: 'manager' },
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
                //console.log(id);
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
            $(document).delegate('#deleteAll','click',function() {
                var theArray=[];
                $("input[name=id]:checked").each(function() {
                    theArray.push($(this).val());
                });
                if(theArray.length<1){
                    alert("请至少选择一个");
                }else{
                    //这里填写要删除的Php代码
                    alert(theArray);
                }
            });

        });
    </script>

@stop
