@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">@stop
@section('page_header')
    <h1 class="page-title">
        <i class=""></i>
        物料库
        <a href="{{url('thing/create')}}" class="btn btn-success">创建</a>
    </h1>
@stop
@section('content')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form class="form-horizontal" action="${pageContext.request.contextPath}/equipment/list.do" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">部门名称：</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="deptname" name="deptname" style="width: 250px">
                                </div>
                                <label class="col-sm-2 control-label">部门状态：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" style="width: 250px" id="state" name="state">
                                        <option value="">请选择...</option>
                                        <option value="1">有 效</option>
                                        <option value="2">无 效</option>
                                    </select>
                                </div>
                                <!--
                            <div class="col-sm-2">
                               <button type="button" class="btn btn-primary" style="float: right;" onclick="javascript:window.location.href=''">添 加</button>
                             </div>
                             -->
                            </div>
                            <div class="form-group">

                                <label class="col-sm-2 control-label">创建开始时间：</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="startTime" name="startTime" style="width: 250px" onclick="laydate()">
                                </div>
                                <label class="col-sm-2 control-label">创建结束时间：</label>
                                <div class="col-sm-3">
                                    <!-- <input type="text" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"> 年月日时分秒-->
                                    <input type="text" class="form-control" id="endTime" name="endTime" style="width: 250px" onclick="laydate()">
                                </div>
                                <div class="col-sm-2">
                                    <button  type="button" class="btn btn-success search" style="float: right;" >查 询</button>
                                </div>
                            </div>


                        </form>
                        <table class="display" id="table" style="width:100%">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="allChecked" /></th>
                                <th>ID</th>
                                <th>分类编码</th>
                                <th>分类名称</th>
                                <th>物料编码</th>
                                <th>物料名称</th>
                                <th>物料规格</th>
                                <th>计量单位</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!--单个删除确认对话框-->
                        <div class="modal fade" id="deleteOneModal" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true" > <!-- data-backdrop="static" 禁止点击弹框后面内容 -->
                            <form class="form-horizontal" role="form">
                                <div class="modal-dialog modal-sm " > <!-- modal-sm 小的  modal-lg 大的 -->
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
                                            <!--
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">取消
                                                </button>
                                                 -->
                                            <button type="button" class="btn btn-primary" id="delSubmit">
                                                确认
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </form>
                        </div>
                        <!--多个删除确认对话框-->
                        <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <form class="form-horizontal" role="form">
                                <div class="modal-dialog">
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
                                            <h5>您确定要删除选中信息吗？</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <!--
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">取消
                                                </button>
                                                 -->
                                            <button type="button" class="btn btn-primary" id="delAllSubmit">
                                                确认
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </form>
                        </div>



                        <!--新增页面开始-->
                        <div class="modal fade" id="myModal-add-info" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"
                                                data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            新 增
                                        </h4>
                                    </div>
                                    <form class="form-horizontal" role="form" action="/category_add" method="post"  id="category_add">
                                        <div class="modal-body">
                                            <%--
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" >图 片：</label>
                                                <div class="col-sm-5">
                                                    <input  type="file" name="img1" class="file" id="img1"  style="width:180px; float: left" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <input class="btn btn-sm btn-info" type="button" value="上传" id="uploadimg"/><span id="t"></span>
                                                </div>
                                                <input name="categoryImg" type="hidden" id="imageUrl" />
                                            </div>
                                            --%>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" >部门名称： </label>

                                                <div class="col-sm-9">
                                                    <input type="text"  class="form-control" id="typename"  name="name" style="width: 250px" maxlength="15" placeholder="10个汉字以内" />

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" >备注： </label>

                                                <div class="col-sm-9">
                                                    <input type="text"   class=" sortNumber form-control"  name="sortNumber" id="sortNumber" style="width: 250px" maxlength="3"/>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" >状态：</label>
                                                <div class="control-group">
                                                    <div class="radio col-sm-3" style="float: left">
                                                        <label>
                                                            <input  type="radio" class=" yn1" name="isYn"  value="1"  checked/>
                                                            <span class="lbl">有效</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio col-sm-3" style="float: left">
                                                        <label>
                                                            <input  type="radio" class=" yn1" name="isYn"  value="0"/>
                                                            <span class="lbl">无效</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">关闭
                                            </button>
                                            <button type="button" class="btn btn-primary" id="btnsubmit">
                                                提交
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div>
                        </div>

                        <!-- 编辑状态弹框 -->

                        <div class="modal fade" id="editOrderStatus" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"
                                                data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            编辑状态弹框 &nbsp;&nbsp;<span id="titleId"></span>
                                        </h4>
                                    </div>
                                    <form class="form-horizontal" action="" method="post"  >
                                        <div class="modal-body ">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">请选择部门状态：</label>

                                                <input type="hidden" id="id" name="id" />
                                                <div class="col-sm-5">
                                                    <select class="form-control orderStatus" style="width: 150px"  name="orderStatus">

                                                        <option value="1">有 效</option>
                                                        <option value="2">无 效</option>
                                                    </select>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"  class="btn btn-primary" >
                                                确定
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.css')}}">
    <script type="text/javascript" charset="utf8" src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('js/dataTables.bootstrap.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    'url':'{{ url('factory/getlist') }}',
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
                    { data: 'id', name: 'id' },
                    { data: 'fenlei', name: 'fenlei' },
                    { data: 'fenleiname', name: 'fenleiname' },
                    { data: 'wuliaoid', name: 'wuliaoid' },
                    { data: 'wuliaoname', name: 'wuliaoname' },
                    { data: 'standard', name: 'standard' },
                    { data: 'units', name: 'units' },
                    {
                        "orderable" : false,
                        "mData" : "id",
                        "sDefaultContent" : '',
                        "render":function(data, type, full, meta){
                            return	data='<button id="deleteOne" class="btn btn-danger btn-sm" data-id='+data+'>删 除</button>';

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
                    "info": "第 _START_ 到第 _END_ 条数据，总共有 _TOTAL_ 条记录",
                    "infoEmpty": "没有数据",
                    "infoFiltered": "（从 _MAX_ 条数据中过滤得到）",
                    "search": "搜索：",
                    "paginate": {
                        "first": "第一页",
                        "last": "最后一页",
                        "next": "下一页",
                        "previous": "上一页",
                    },


                    initComplete: initComplete,
                    drawCallback: function (settings) {
                        $('input[name=allChecked]')[0].checked = false;
                    }
                }
            });
            function initComplete(data){

                var topPlugin='<button   class="btn btn-danger btn-sm" id="deleteAll">批量删除</button> <button   class="btn btn-primary btn-sm addBtn" >新 增</button>             <iframe id="exp" style="display:none;"></iframe><button  class="btn btn-info btn-sm" id="expCsv">导 出全部</button>             <button  class="btn btn-warning btn-sm" id="reset">重置搜索条件</button>' ;

                $("#topPlugin").append(topPlugin);//在表格上方topPlugin DIV中追加HTML

            }

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
                    url:contextPath+"/department/delete.do?id="+id,
                    async:true,
                    type:"GET",
                    dataType:"json",
                    cache:false,    //不允许缓存
                    success: function(data){
                        var obj = eval(data);
                        if(obj.code==1)
                        {

                            window.location.reload();
                        }
                        else
                        {
                            alert("删除失败");
                        }

                    },
                    error:function(data){
                        alert("请求异常");
                    }
                });
            });

            /**
             * 多选选中和取消选中,同时选中第一个单元格单选框,并联动全选单选框
             */
            $('#example tbody').on('click', 'tr', function(event) {
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
                    $('#example tbody tr').each(function(){
                        if(!$(this).hasClass('selected')){
                            $(this).click();
                        }
                    });
                }else{
                    $('#example tbody tr').click();
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


//   function exp1(){
//	   $("#exp").attr("src",contextPath+"/department/export.do?t=" + new Date().getTime());
//   }
            $(document).delegate('#expCsv','click',function() {

                $("#exp").attr("src",contextPath+"/department/export.do?t=" + new Date().getTime());
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
                    alert(theArray);
                }

            });
            $(document).delegate('.upOrderStatus','click',function() {
                var id=$(this).data("id");
                //alert(id);
                $("#titleId").html(id);
                $('#editOrderStatus').modal("show");
            });
            $(document).delegate('#reset','click',function() {
                $("#state").val("");
                $("#deptname").val("");
                $("#startTime").val("");
                $("#endTime").val("");
            });
            $(document).delegate('.search','click',function() {
                table.ajax.reload();
                // $("#example").dataTable().api().ajax.reload();
//		   table.search(
//				   "state="+$('#state').val()
//			    ).draw();
//		  var 	    state=$("#state").val();
//		   table.column(1).search(state, false, false).draw();
            });
        });
    </script>
@stop
