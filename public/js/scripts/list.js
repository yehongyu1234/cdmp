$(document).ready(function(){
    $('#table').DataTable({
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
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
        },
        initComplete:initComplete,
            drawCallback: function( settings ) {
            $('input[name=allChecked]')[0].checked=false;//取消全选状态
        }
    },
    buttons: [
        {
            extend: 'excel',
            text: 'Save current page',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        }
    ]
});
    function initComplete(data){
        var topPlugin='<button   class="btn btn-danger btn-sm" id="deleteAll">批量删除</button> <button   class="btn btn-primary btn-sm addBtn" >新 增</button>             <iframe id="exp" style="display:none;"></iframe><button  class="btn btn-info btn-sm" id="expCsv">导 出全部</button>             <button  class="btn btn-warning btn-sm" id="reset">重置搜索条件</button>' ;
        $("#topPlugin").append(topPlugin);
    }
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
    });
});