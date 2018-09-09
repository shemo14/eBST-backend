@section('styles')
    <!-- DataTables -->
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/design/admin')}}/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <style>

        @media (max-width: 475.98px) {
            .boxes .col-sm-6 div#datatable_filter {
                float: none;
                text-align: center;
            }

            .boxes .col-sm-6 {
                float:  none;
                text-align: center;
                display:  inline-block;
                width:  10px;
            }
        }

        @media (min-width: 476px) and (max-width: 767.98px) {
            .boxes .col-sm-6 div#datatable_filter {
                float: right;
            }

            .boxes .col-sm-6 {
                float:  right;
                display:  inline-block;
                width:  50%;
            }
        }

    </style>
@endsection

@extends('dashboard.index')
@section('title')
    الرسائل
@endsection
@section('content')

    <div class="row">

        <div class="col-sm-12">
            <div class="card-box table-responsive boxes">
                <h4 class="header-title m-t-0 m-b-30" style="display: inline-block">قائمة الرسائل</h4>

                <table id="datatable" class="table table-striped table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>الهاتف</th>
                        <th>الرسالة</th>
                        <th>التاريخ</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>محمد</td>
                            <td>mohamed@yahoo.com</td>
                            <td>12345432</td>
                            <td>السلام عليكم</td>
                            <td>23 hours ago</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-center"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" style="min-width: 5px; border-radius: 10px;">
                                        <li><a href="" style="color: #c89e28; font-weight: bold;"> <i class="fa fa-cogs" style="margin-left: 3px;"></i> تـعـديـل </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" style="color: #c81e27; font-weight: bold;"> <i class="fa fa-trash" style="margin-left: 5px;"></i> حــذف </a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>محمد</td>
                            <td>mohamed@yahoo.com</td>
                            <td>12345432</td>
                            <td>السلام عليكم</td>
                            <td>23 hours ago</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-center"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" style="min-width: 5px; border-radius: 10px;">
                                        <li><a href="" style="color: #c89e28; font-weight: bold;"> <i class="fa fa-cogs" style="margin-left: 3px;"></i> تـعـديـل </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" style="color: #c81e27; font-weight: bold;"> <i class="fa fa-trash" style="margin-left: 5px;"></i> حــذف </a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>محمد</td>
                            <td>mohamed@yahoo.com</td>
                            <td>12345432</td>
                            <td>السلام عليكم</td>
                            <td>23 hours ago</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-center"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" style="min-width: 5px; border-radius: 10px;">
                                        <li><a href="" style="color: #c89e28; font-weight: bold;"> <i class="fa fa-cogs" style="margin-left: 3px;"></i> تـعـديـل </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" style="color: #c81e27; font-weight: bold;"> <i class="fa fa-trash" style="margin-left: 5px;"></i> حــذف </a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->

    </div>

@endsection

@section('script')

    <!-- Datatables-->
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/jszip.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.scroller.min.js"></script>

    <!-- Datatable init js -->
    <script src="{{url('/design/admin')}}/assets/pages/datatables.init.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('#datatable-keytable').DataTable( { keys: true } );
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
            var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
        } );
        TableManageButtons.init();

    </script>
@endsection