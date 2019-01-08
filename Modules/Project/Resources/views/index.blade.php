@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css" class="init">
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/buttons.dataTables.css')}}">
    <!--<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.css')}}">-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/shCore.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/demo.css')}}">

    <script type="text/javascript" language="javascript" src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/dataTables.buttons.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/jszip.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pdfmake.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/buttons.flash.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/buttons.html5.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/buttons.print.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/shCore.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scripts/demo.js')}}"></script>

    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
    </script>
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
                        <section>
                            <h1>Buttons example <span>HTML5 export buttons</span></h1>
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                </tr>
                                <tr>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                <tr>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr>
                                <tr>
                                    <td>Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr>
                                <tr>
                                    <td>Brielle Williamson</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>2012/12/02</td>
                                    <td>$372,000</td>
                                </tr>
                                <tr>
                                    <td>Herrod Chandler</td>
                                    <td>Sales Assistant</td>
                                    <td>San Francisco</td>
                                    <td>59</td>
                                    <td>2012/08/06</td>
                                    <td>$137,500</td>
                                </tr>
                                <tr>
                                    <td>Rhona Davidson</td>
                                    <td>Integration Specialist</td>
                                    <td>Tokyo</td>
                                    <td>55</td>
                                    <td>2010/10/14</td>
                                    <td>$327,900</td>
                                </tr>
                                <tr>
                                    <td>Colleen Hurst</td>
                                    <td>Javascript Developer</td>
                                    <td>San Francisco</td>
                                    <td>39</td>
                                    <td>2009/09/15</td>
                                    <td>$205,500</td>
                                </tr>
                                <tr>
                                    <td>Sonya Frost</td>
                                    <td>Software Engineer</td>
                                    <td>Edinburgh</td>
                                    <td>23</td>
                                    <td>2008/12/13</td>
                                    <td>$103,600</td>
                                </tr>
                                <tr>
                                    <td>Jena Gaines</td>
                                    <td>Office Manager</td>
                                    <td>London</td>
                                    <td>30</td>
                                    <td>2008/12/19</td>
                                    <td>$90,560</td>
                                </tr>
                                <tr>
                                    <td>Quinn Flynn</td>
                                    <td>Support Lead</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2013/03/03</td>
                                    <td>$342,000</td>
                                </tr>
                                <tr>
                                    <td>Charde Marshall</td>
                                    <td>Regional Director</td>
                                    <td>San Francisco</td>
                                    <td>36</td>
                                    <td>2008/10/16</td>
                                    <td>$470,600</td>
                                </tr>
                                <tr>
                                    <td>Haley Kennedy</td>
                                    <td>Senior Marketing Designer</td>
                                    <td>London</td>
                                    <td>43</td>
                                    <td>2012/12/18</td>
                                    <td>$313,500</td>
                                </tr>
                                <tr>
                                    <td>Tatyana Fitzpatrick</td>
                                    <td>Regional Director</td>
                                    <td>London</td>
                                    <td>19</td>
                                    <td>2010/03/17</td>
                                    <td>$385,750</td>
                                </tr>
                                <tr>
                                    <td>Michael Silva</td>
                                    <td>Marketing Designer</td>
                                    <td>London</td>
                                    <td>66</td>
                                    <td>2012/11/27</td>
                                    <td>$198,500</td>
                                </tr>
                                <tr>
                                    <td>Paul Byrd</td>
                                    <td>Chief Financial Officer (CFO)</td>
                                    <td>New York</td>
                                    <td>64</td>
                                    <td>2010/06/09</td>
                                    <td>$725,000</td>
                                </tr>
                                <tr>
                                    <td>Gloria Little</td>
                                    <td>Systems Administrator</td>
                                    <td>New York</td>
                                    <td>59</td>
                                    <td>2009/04/10</td>
                                    <td>$237,500</td>
                                </tr>
                                <tr>
                                    <td>Bradley Greer</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>41</td>
                                    <td>2012/10/13</td>
                                    <td>$132,000</td>
                                </tr>
                                <tr>
                                    <td>Dai Rios</td>
                                    <td>Personnel Lead</td>
                                    <td>Edinburgh</td>
                                    <td>35</td>
                                    <td>2012/09/26</td>
                                    <td>$217,500</td>
                                </tr>
                                <tr>
                                    <td>Jenette Caldwell</td>
                                    <td>Development Lead</td>
                                    <td>New York</td>
                                    <td>30</td>
                                    <td>2011/09/03</td>
                                    <td>$345,000</td>
                                </tr>
                                <tr>
                                    <td>Yuri Berry</td>
                                    <td>Chief Marketing Officer (CMO)</td>
                                    <td>New York</td>
                                    <td>40</td>
                                    <td>2009/06/25</td>
                                    <td>$675,000</td>
                                </tr>
                                <tr>
                                    <td>Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td>New York</td>
                                    <td>21</td>
                                    <td>2011/12/12</td>
                                    <td>$106,450</td>
                                </tr>
                                <tr>
                                    <td>Doris Wilder</td>
                                    <td>Sales Assistant</td>
                                    <td>Sidney</td>
                                    <td>23</td>
                                    <td>2010/09/20</td>
                                    <td>$85,600</td>
                                </tr>
                                <tr>
                                    <td>Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>2009/10/09</td>
                                    <td>$1,200,000</td>
                                </tr>
                                <tr>
                                    <td>Gavin Joyce</td>
                                    <td>Developer</td>
                                    <td>Edinburgh</td>
                                    <td>42</td>
                                    <td>2010/12/22</td>
                                    <td>$92,575</td>
                                </tr>
                                <tr>
                                    <td>Jennifer Chang</td>
                                    <td>Regional Director</td>
                                    <td>Singapore</td>
                                    <td>28</td>
                                    <td>2010/11/14</td>
                                    <td>$357,650</td>
                                </tr>
                                <tr>
                                    <td>Brenden Wagner</td>
                                    <td>Software Engineer</td>
                                    <td>San Francisco</td>
                                    <td>28</td>
                                    <td>2011/06/07</td>
                                    <td>$206,850</td>
                                </tr>
                                <tr>
                                    <td>Fiona Green</td>
                                    <td>Chief Operating Officer (COO)</td>
                                    <td>San Francisco</td>
                                    <td>48</td>
                                    <td>2010/03/11</td>
                                    <td>$850,000</td>
                                </tr>
                                <tr>
                                    <td>Shou Itou</td>
                                    <td>Regional Marketing</td>
                                    <td>Tokyo</td>
                                    <td>20</td>
                                    <td>2011/08/14</td>
                                    <td>$163,000</td>
                                </tr>
                                <tr>
                                    <td>Michelle House</td>
                                    <td>Integration Specialist</td>
                                    <td>Sidney</td>
                                    <td>37</td>
                                    <td>2011/06/02</td>
                                    <td>$95,400</td>
                                </tr>
                                <tr>
                                    <td>Suki Burks</td>
                                    <td>Developer</td>
                                    <td>London</td>
                                    <td>53</td>
                                    <td>2009/10/22</td>
                                    <td>$114,500</td>
                                </tr>
                                <tr>
                                    <td>Prescott Bartlett</td>
                                    <td>Technical Author</td>
                                    <td>London</td>
                                    <td>27</td>
                                    <td>2011/05/07</td>
                                    <td>$145,000</td>
                                </tr>
                                <tr>
                                    <td>Gavin Cortez</td>
                                    <td>Team Leader</td>
                                    <td>San Francisco</td>
                                    <td>22</td>
                                    <td>2008/10/26</td>
                                    <td>$235,500</td>
                                </tr>
                                <tr>
                                    <td>Martena Mccray</td>
                                    <td>Post-Sales support</td>
                                    <td>Edinburgh</td>
                                    <td>46</td>
                                    <td>2011/03/09</td>
                                    <td>$324,050</td>
                                </tr>
                                <tr>
                                    <td>Unity Butler</td>
                                    <td>Marketing Designer</td>
                                    <td>San Francisco</td>
                                    <td>47</td>
                                    <td>2009/12/09</td>
                                    <td>$85,675</td>
                                </tr>
                                <tr>
                                    <td>Howard Hatfield</td>
                                    <td>Office Manager</td>
                                    <td>San Francisco</td>
                                    <td>51</td>
                                    <td>2008/12/16</td>
                                    <td>$164,500</td>
                                </tr>
                                <tr>
                                    <td>Hope Fuentes</td>
                                    <td>Secretary</td>
                                    <td>San Francisco</td>
                                    <td>41</td>
                                    <td>2010/02/12</td>
                                    <td>$109,850</td>
                                </tr>
                                <tr>
                                    <td>Vivian Harrell</td>
                                    <td>Financial Controller</td>
                                    <td>San Francisco</td>
                                    <td>62</td>
                                    <td>2009/02/14</td>
                                    <td>$452,500</td>
                                </tr>
                                <tr>
                                    <td>Timothy Mooney</td>
                                    <td>Office Manager</td>
                                    <td>London</td>
                                    <td>37</td>
                                    <td>2008/12/11</td>
                                    <td>$136,200</td>
                                </tr>
                                <tr>
                                    <td>Jackson Bradshaw</td>
                                    <td>Director</td>
                                    <td>New York</td>
                                    <td>65</td>
                                    <td>2008/09/26</td>
                                    <td>$645,750</td>
                                </tr>
                                <tr>
                                    <td>Olivia Liang</td>
                                    <td>Support Engineer</td>
                                    <td>Singapore</td>
                                    <td>64</td>
                                    <td>2011/02/03</td>
                                    <td>$234,500</td>
                                </tr>
                                <tr>
                                    <td>Bruno Nash</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>38</td>
                                    <td>2011/05/03</td>
                                    <td>$163,500</td>
                                </tr>
                                <tr>
                                    <td>Sakura Yamamoto</td>
                                    <td>Support Engineer</td>
                                    <td>Tokyo</td>
                                    <td>37</td>
                                    <td>2009/08/19</td>
                                    <td>$139,575</td>
                                </tr>
                                <tr>
                                    <td>Thor Walton</td>
                                    <td>Developer</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>2013/08/11</td>
                                    <td>$98,540</td>
                                </tr>
                                <tr>
                                    <td>Finn Camacho</td>
                                    <td>Support Engineer</td>
                                    <td>San Francisco</td>
                                    <td>47</td>
                                    <td>2009/07/07</td>
                                    <td>$87,500</td>
                                </tr>
                                <tr>
                                    <td>Serge Baldwin</td>
                                    <td>Data Coordinator</td>
                                    <td>Singapore</td>
                                    <td>64</td>
                                    <td>2012/04/09</td>
                                    <td>$138,575</td>
                                </tr>
                                <tr>
                                    <td>Zenaida Frank</td>
                                    <td>Software Engineer</td>
                                    <td>New York</td>
                                    <td>63</td>
                                    <td>2010/01/04</td>
                                    <td>$125,250</td>
                                </tr>
                                <tr>
                                    <td>Zorita Serrano</td>
                                    <td>Software Engineer</td>
                                    <td>San Francisco</td>
                                    <td>56</td>
                                    <td>2012/06/01</td>
                                    <td>$115,000</td>
                                </tr>
                                <tr>
                                    <td>Jennifer Acosta</td>
                                    <td>Junior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>43</td>
                                    <td>2013/02/01</td>
                                    <td>$75,650</td>
                                </tr>
                                <tr>
                                    <td>Cara Stevens</td>
                                    <td>Sales Assistant</td>
                                    <td>New York</td>
                                    <td>46</td>
                                    <td>2011/12/06</td>
                                    <td>$145,600</td>
                                </tr>
                                <tr>
                                    <td>Hermione Butler</td>
                                    <td>Regional Director</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>2011/03/21</td>
                                    <td>$356,250</td>
                                </tr>
                                <tr>
                                    <td>Lael Greer</td>
                                    <td>Systems Administrator</td>
                                    <td>London</td>
                                    <td>21</td>
                                    <td>2009/02/27</td>
                                    <td>$103,500</td>
                                </tr>
                                <tr>
                                    <td>Jonas Alexander</td>
                                    <td>Developer</td>
                                    <td>San Francisco</td>
                                    <td>30</td>
                                    <td>2010/07/14</td>
                                    <td>$86,500</td>
                                </tr>
                                <tr>
                                    <td>Shad Decker</td>
                                    <td>Regional Director</td>
                                    <td>Edinburgh</td>
                                    <td>51</td>
                                    <td>2008/11/13</td>
                                    <td>$183,000</td>
                                </tr>
                                <tr>
                                    <td>Michael Bruce</td>
                                    <td>Javascript Developer</td>
                                    <td>Singapore</td>
                                    <td>29</td>
                                    <td>2011/06/27</td>
                                    <td>$183,000</td>
                                </tr>
                                <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>New York</td>
                                    <td>27</td>
                                    <td>2011/01/25</td>
                                    <td>$112,000</td>
                                </tr>
                                </tbody>
                            </table>
                        </section>
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
            </div>

                </div>
            <div class="col-md-12">
                <ul class="tabs">
                    <li class="active">Javascript</li>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>Ajax</li>
                    <li>Server-side script</li>
                </ul>
                <div class="tabs">
                    <div class="js">
                        <p>The Javascript shown below is used to initialise the table shown in this example:</p>
                        <code class="multiline language-js">test</code>
                        <p>In addition to the above code, the following Javascript library files are loaded for use in this example:</p>
                        <ul>
                            <li>
                                <a href="//code.jquery.com/jquery-1.11.3.min.js">//code.jquery.com/jquery-1.11.3.min.js</a>
                            </li>

                        </ul>
                    </div>
                    <div class="table">
                        <p>The HTML shown below is the raw HTML table element, before it has been enhanced by DataTables:</p>
                    </div>
                    <div class="css">
                        <div>
                            <p>This example uses a little bit of additional CSS beyond what is loaded from the library files (below), in order to correctly display the table. The
                                additional CSS used is shown below:</p><code class="multiline language-css"></code>
                        </div>
                        <p>The following CSS library files are loaded for use in this example to provide the styling of the table:</p>

                    </div>
                    <div class="ajax">
                        <p>This table loads data by Ajax. The latest data that has been loaded is shown below. This data will update automatically as any additional data is
                            loaded.</p>
                    </div>
                    <div class="php">
                        <p>The script used to perform the server-side processing for this table is shown below. Please note that this is just an example script using PHP. Server-side
                            processing scripts can be written in any language, using <a href="//datatables.net/manual/server-side">the protocol described in the DataTables
                                documentation</a>.</p>
                    </div>
                </div>
            </div>
            </div>
    </div>

<!--
    <script>
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
    </script>
    -->
@stop
