$(function(){
    var table=$('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                'url':‘task/getlist’,
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
        $('#myModal-add-info').modal('show');
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