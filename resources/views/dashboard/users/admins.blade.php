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
    المشرفين
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
                            <a href="#add" class="btn btn-primary btn-rounded waves-effect waves-light w-md m-b-5" data-animation="fadein" data-plugin="custommodal"
                               data-overlaySpeed="100" data-overlayColor="#36404a">اضافة مشرف  </a>
                        </li>
                        <li style="display: inline">
                            <a href="#deleteAll" class="btn btn-small btn-danger btn-rounded waves-effect waves-light w-md m-b-5 delete-all" data-animation="blur" data-plugin="custommodal"
                               data-overlaySpeed="100" data-overlayColor="#36404a">حذف المحدد  </a>
                        </li>
                    </ul>
                </div>

                <h4 class="header-title m-t-0 m-b-30" style="display: inline-block">المشرفين</h4>

                <table id="datatable" class="table table-striped table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th>
                            تحديد
                            <input type="checkbox" id="checkedAll" style="margin-right: 10px">
                        </th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>رقم الهاتف</th>
                        <th>الصلاحية</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->id == 1)
                                    <input type="checkbox" class="form-check-label" disabled>
                                @else
                                    <input type="checkbox" class="form-check-label checkSingle" id="{{$user->id}}">
                                @endif
                            </td>
                            <td><img src="{{url('/images/admins/') . '/' . $user->avatar}}" alt="user-img" width="60px" title="Mat Helme" class="img-circle img-thumbnail img-responsive"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->Role->role}}</td>
                            <td>
                                @if($user->active == 0)
                                    <span class="label label-danger">غير نشط</span>
                                @else
                                    <span class="label label-success">نشط</span>
                                @endif
                            </td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-center"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" style="min-width: 5px; border-radius: 10px;">
                                        <li>
                                            <a href="#edit" class="edit" data-animation="fadein" data-plugin="custommodal"
                                               data-overlaySpeed="100" data-overlayColor="#36404a" style="color: #c89e28; font-weight: bold;"
                                               data-id = "{{$user->id}}"
                                               data-phone = "{{$user->phone}}"
                                               data-name = "{{$user->name}}"
                                               data-email = "{{$user->email}}"
                                               data-photo = "{{$user->avatar}}"
                                               data-role = "{{$user->role}}"
                                            >
                                                <i class="fa fa-cogs" style="margin-left: 3px;"></i>
                                                تـعـديـل
                                            </a>
                                        </li>
                                        <li><a href="#contact" style="color: #79c842; font-weight: bold;" data-animation="fadein" data-plugin="custommodal"
                                               data-overlaySpeed="100" data-overlayColor="#36404a"> <i class="fa fa-comment" style="margin-left: 3px;"></i> مراسلة </a></li>
                                        @if($user->id != 1)
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#delete" class="delete" style="color: #c83338; font-weight: bold;" data-animation="blur" data-plugin="custommodal"
                                                   data-overlaySpeed="100" data-overlayColor="#36404a"
                                                   data-id = "{{$user->id}}"
                                                >
                                                    <i class="fa fa-trash" style="margin-left: 3px;"></i>حـذف
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </form>
                </table>
            </div>
        </div><!-- end col -->

    </div>

    <!-- add user modal -->
    <div id="add" class="modal-demo" >
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">
            مشرف جديد
        </h4>
        <form action="{{route('addadmin')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">الاسم</label>
                            <input type="text" autocomplete="nope" name="name" required class="form-control" placeholder="اوامر الشبكة">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">رقم الهاتف</label>
                            <input type="text" autocomplete="nope" name="phone" required class="form-control phone" id="phone" placeholder="05011000000">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">البريد الالكتروني</label>
                            <input type="email" autocomplete="nope" name="email" required class="form-control" placeholder="email@exmaple.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">كلمة السر</label>
                            <input type="password" autocomplete="nope" name="password" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">الصلاحية</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">الصورة الشخصية</label>
                            <div class="col-sm-8">
                                <input type="file" name="avatar" class="dropify" data-max-file-size="1M">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
            </div>
        </form>
    </div>

    <!-- edit user modal -->
    <div id="edit" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">
            تعديل <span id="username"></span>
        </h4>
        <form action="{{route('updateadmin')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">الاسم</label>
                            <input type="text" autocomplete="nope" name="edit_name" value="" required class="form-control" placeholder="اوامر الشبكة">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">رقم الهاتف</label>
                            <input type="text" autocomplete="nope" name="edit_phone" value="" required class="phone form-control" id="phone" placeholder="05011000000">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">البريد الالكتروني</label>
                            <input type="email" autocomplete="nope" name="edit_email" value="" required class="form-control" placeholder="email@exmaple.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">كلمة السر</label>
                            <input type="password" autocomplete="nope" name="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">الصلاحية</label>
                            <div class="col-sm-10">
                                <select class="form-control role" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">الصورة الشخصية</label>
                            <div class="col-sm-8">
                                <input type="file" name="avatar" data-default-file="" class="dropify photo" data-max-file-size="1M">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
            </div>
        </form>
    </div>

    <!-- contact user modal -->
    <div id="contact" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">التواصل مع العضو</h4>
        <div class="modal-content p-0">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="active">
                    <a href="#email" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">بريد</span>
                    </a>
                </li>
                <li class="">
                    <a href="#sms" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">رسالة SMS</span>
                    </a>
                </li>
                <li class="">
                    <a href="#notify" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                        <span class="hidden-xs">اشعار</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="email">
                    <div>
                        <form action="">
                            <textarea id="textarea" class="form-control" rows="15" placeholder="نص رسالة البريد الإلكتروني"></textarea>
                            <button type="button" class="btn btn-success btn-block btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">ارسال</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="sms">
                    <div>
                        <form action="">
                            <textarea id="textarea" class="form-control" rows="15" placeholder="نص رسالة الـ SMS"></textarea>
                            <button type="button" class="btn btn-success btn-block btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">ارسال</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="notify">
                    <div>
                        <form action="">
                            <textarea id="textarea" class="form-control" rows="15" placeholder="نص الاشعار"></textarea>
                            <button type="button" class="btn btn-success btn-block btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">ارسال</button>
                        </form>
                    </div>
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
                    <form action="{{route('deleteadmin')}}" method="post">
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
        $('.edit').on('click',function(){
            //get valus
            let id         = $(this).data('id');
            let name       = $(this).data('name');
            //let photo      = $(this).data('photo');
            let phone      = $(this).data('phone');
            let email      = $(this).data('email');
            // let role      = $(this).data('role');

            $("input[name='id']").val(id);
            $("input[name='edit_name']").val(name);
            $("input[name='edit_phone']").val(phone);
            $("input[name='edit_email']").val(email);
            $("#username").html(name);
        });

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
                    url: "{{route('deleteadmins')}}",
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Xz9rMq52xAtXTjm6v_cMeppcxWnm0-M&callback=initMap"></script>

@endsection