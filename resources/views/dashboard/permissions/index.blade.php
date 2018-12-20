@section('styles')

@endsection

@extends('dashboard.index')
@section('title')
    الصلاحيات
@endsection
@section('content')

    <div class="row">

        <div class="col-sm-12">
            <div class="card-box table-responsive boxes">
               <div class="pull-right" style="margin-left: 7px">
                   <a href="{{route('addpermissionspage')}}" class="btn btn-custom btn-rounded waves-effect waves-light w-md m-b-5">اضافة صلاحية</a>
               </div>

                <h4 class="header-title m-t-0 m-b-30" style="display: inline-block">قائمة الصلاحيات</h4>

                <table id="datatable" class="table table-striped table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>التاريخ</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->role}}</td>
                                <td>{{$role->created_at->diffForHumans()}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-center"></i> <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu" style="min-width: 5px; border-radius: 10px;">
                                            <li><a href="{{route('editpermissionpage', $role->id)}}" style="color: #c89e28; font-weight: bold;"> <i class="fa fa-cogs" style="margin-left: 3px;"></i> تـعـديـل </a></li>
                                            <li class="divider"></li>
                                            <li><a href="#delete" class="delete" style="color: #c83338; font-weight: bold;" data-animation="blur" data-plugin="custommodal"
                                                   data-overlaySpeed="100" data-overlayColor="#36404a" data-id="{{$role->id}}"> <i class="fa fa-trash" style="margin-left: 3px;"></i> حـذف </a></li>
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

    <div id="delete" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف صلاحية</h4>
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
                    <form method="post" action="{{route('deletepermission')}}">
                        {{csrf_field()}}
                        <input type="hidden" id="id-permission" name="id" value="">
                        <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">حـذف</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

@endsection

@section('script')

    <script type="text/javascript">

        $(".delete").click(function () {
            let  id = $(this).data("id");
            $('#id-permission').val(id);
        });

    </script>

@endsection