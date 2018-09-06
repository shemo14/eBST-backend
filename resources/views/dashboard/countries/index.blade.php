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
    البلاد
@endsection
@section('content')

    <div class="row">

        <div class="col-sm-12">
            <div class="card-box table-responsive boxes">
                <h4 class="header-title m-t-0 m-b-30" style="display: inline-block">البلاد</h4>

                <table id="datatable" class="table table-striped table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th>الاسم العربي</th>
                        <th>الاسم الانجليوي</th>
                        <th>الاسم الفرنسي</th>
                        <th>الكود</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($countries as $country)
                            <tr>
                                <td>{{$country->name_ar}}</td>
                                <td>{{$country->name_en}}</td>
                                <td>{{$country->name_fr}}</td>
                                <td>{{$country->code}}</td>
                            </tr>
                        @endforeach
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