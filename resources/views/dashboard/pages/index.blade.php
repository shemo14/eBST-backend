@section('styles')

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
    الصفحات
@endsection
@section('content')

    <div class="row">

        <div class="col-sm-12">
            <div class="card-box table-responsive boxes">
                <div class="pull-right" style="margin-left: 7px">
                    <ul style="list-style-type: none;
                     margin: 0;
                       padding: 0;">
                        <li style="display: inline">
                            <a href="{{route('showCreatePage')}}" class="btn btn-primary btn-rounded waves-effect waves-light w-md m-b-5">اضافة صفحة  </a>
                        </li>
                        <li style="display: inline">
                            <a href="#deleteAll" class="btn btn-small btn-danger btn-rounded waves-effect waves-light w-md m-b-5 delete-all" data-animation="blur" data-plugin="custommodal"
                               data-overlaySpeed="100" data-overlayColor="#36404a">حذف المحدد  </a>
                        </li>
                    </ul>
                </div>

                <h4 class="header-title m-t-0 m-b-30" style="display: inline-block">الصفحات</h4>

                <table id="datatable" class="table table-striped table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th style="width: 50px;">
                            تحديد
                            <input type="checkbox" id="checkedAll" style="margin-right: 10px">
                        </th>
                        <th>العنوان</th>
                        <th>التاريخ</th>
                        <th>عرض</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($pages as $page)
                        <tr>
                            <td style="width: 50px;">
                                <input type="checkbox" class="form-check-label checkSingle" id="{{$page->id}}">
                            </td>
                            <td>{{$page->title}}</td>
                            <td>{{$page->created_at->diffForHumans()}}</td>
                            <td><button class="btn btn-info btn-rounded"><a href="{{route('showPage', $page->id)}}" style="color: whitesmoke" class="fa fa-eye"></a></button></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-center"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" style="min-width: 5px; border-radius: 10px;">
                                        <li>
                                            <a href="{{route('showUpdatePage', $page->id)}}" class="edit" style="color: #c89e28; font-weight: bold;">
                                                <i class="fa fa-cogs" style="margin-left: 3px;"></i>
                                                تـعـديـل
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#delete" class="delete" style="color: #c83338; font-weight: bold;" data-animation="blur" data-plugin="custommodal"
                                               data-overlaySpeed="100" data-overlayColor="#36404a"
                                               data-id = "{{$page->id}}"
                                            >
                                                <i class="fa fa-trash" style="margin-left: 3px;"></i>حـذف
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->

    </div>

    <div id="add" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف عضو</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button style="margin-top: 35px" type="button" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5 send-delete-all"  style="margin-top: 19px">حـذف</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

    <div id="delete" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف عضو</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{route('deletePage')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="delete_id" value="">
                        <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5 send-delete-all"  style="margin-top: 19px">حـذف</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

    <div id="deleteAll" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف المحدد</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5 send-delete-all" style="margin-top: 19px">حـذف</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

@endsection

@section('script')
    <script>
        $('.delete').on('click',function(){

            let id         = $(this).data('id');

            $("input[name='delete_id']").val(id);

        });

        $("#checkedAll").change(function(){
            if(this.checked){
                $(".checkSingle").each(function(){
                    this.checked=true;
                })
            }else{
                $(".checkSingle").each(function(){
                    this.checked=false;
                })
            }
        });

        $(".checkSingle").click(function () {
            if ($(this).is(":checked")){
                var isAllChecked = 0;
                $(".checkSingle").each(function(){
                    if(!this.checked)
                        isAllChecked = 1;
                })
                if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
            }else {
                $("#checkedAll").prop("checked", false);
            }
        });

        $('.send-delete-all').on('click', function (e) {

            var usersIds = [];
            $('.checkSingle:checked').each(function () {
                var id = $(this).attr('id');
                usersIds.push({
                    id: id,
                });
            });
            var requestData = JSON.stringify(usersIds);
            // console.log(requestData);
            if (usersIds.length > 0) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route('deleteAllPages')}}",
                    data: {data: requestData, _token: '{{csrf_token()}}'},
                    success: function( msg ) {
                        if (msg == 'success') {
                            location.reload()
                        }
                    }
                });
            }
        });
    </script>
@endsection