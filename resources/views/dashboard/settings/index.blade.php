@section('style')
    <!-- Editatable  Css-->
    <link rel="stylesheet" href="{{url('/design/admin/')}}/assets/plugins/magnific-popup/dist/magnific-popup.css" />
    <link rel="stylesheet" href="{{url('/design/admin/')}}/assets/plugins/jquery-datatables-editable/datatables.css" />
@endsection
@extends('dashboard.index')

@section('title')
    الإعدادات
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box card-tabs">
                <ul class="nav nav-pills pull-right">
                    <li class="active">
                        <a href="#site" data-toggle="tab" aria-expanded="true">إعدادات الموقع</a>
                    </li>
                    <li class="">
                        <a href="#social" data-toggle="tab" aria-expanded="true">مواقع التواصل</a>
                    </li>
                    <li class="">
                        <a href="#messages" data-toggle="tab" aria-expanded="true">الرسائل والايميل</a>
                    </li>
                    <li class="">
                        <a href="#notify" data-toggle="tab" aria-expanded="false">الاشعارات</a>
                    </li>
                </ul>
                <h4 class="header-title m-b-30">الاعدادات</h4>

                <div class="tab-content">
                    <div id="site" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">اعدادت عامة</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('sitesetting')}}">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">اسم الموقع</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="example-email" value="{{$setting->site_name}}" name="site_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">لوجو الموقع</label>
                                                <div class="col-md-10">
                                                    <input type="file" name="site_logo" data-default-file="{{asset('images/site') . '/' . $setting->site_logo}}" class="dropify photo" data-max-file-size="1M" />
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="social" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-custom panel-border">
                                            <div class="panel-heading">
                                                <h3 style="display: inline-block;" class="panel-title">مواقع التواصل</h3>
                                                <button type="button" class="btn btn-custom btn-rounded waves-effect waves-light w-md m-b-5 pull-right" id="openSocialForm">اضافة</button>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-striped m-0">
                                                                <thead>
                                                                <tr>
                                                                    <th>الشعار</th>
                                                                    <th>اسم الموقع</th>
                                                                    <th>الرابط</th>
                                                                    <th>التحكم</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr id="addSocial" class="hidden">
                                                                    <form action="{{route('add-social')}}" method="post">
                                                                        {{csrf_field()}}
                                                                        <td>
                                                                            <input required maxlength="190" minlength="2" type="text" name="icon" placeholder="facebook" class="form-control" style="width: 189px;">
                                                                        </td>
                                                                        <td>
                                                                            <input required maxlength="190" minlength="2" type="text" name="site_name" placeholder="Facebook" class="form-control" style="width: 189px;">
                                                                        </td>
                                                                        <td>
                                                                            <input required maxlength="190" minlength="2" type="text" name="url" placeholder="www.facebook.com" class="form-control" style="width: 189px;">
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <button type="submit" style="color: #3fb614;background-color: transparent;border: none;"><i class="fa fa-save"></i></button>
                                                                                <button type="button" id="cancel" style="color: #b62626;background-color: transparent;border: none;"><i class="fa fa-close"></i></button>
                                                                            </div>
                                                                        </td>
                                                                    </form>
                                                                </tr>
                                                                <tr id="editSocial" class="hidden">
                                                                    <form action="{{route('update-social')}}" method="post">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="">
                                                                        <td>
                                                                            <input required maxlength="190" value="" minlength="2" type="text" name="edit_icon" placeholder="facebook" class="form-control" style="width: 189px;">
                                                                        </td>
                                                                        <td>
                                                                            <input required maxlength="190" value="" minlength="2" type="text" name="edit_name" placeholder="Facebook" class="form-control" style="width: 189px;">
                                                                        </td>
                                                                        <td>
                                                                            <input required maxlength="190" value="" minlength="2" type="text" name="edit_url" placeholder="www.facebook.com" class="form-control" style="width: 189px;">
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <button type="submit" style="color: #3fb614;background-color: transparent;border: none;"><i class="fa fa-save"></i></button>
                                                                                <button type="button" id="cancelEdit" style="color: #b62626;background-color: transparent;border: none;"><i class="fa fa-close"></i></button>
                                                                            </div>
                                                                        </td>
                                                                    </form>
                                                                </tr>
                                                                @foreach($socials as $social)
                                                                    <tr>
                                                                        <th scope="row"><a href="{{$social->url}}" class="btn btn-{{$social->icon}} btn-rounded btn-small"><i class="fa fa-{{$social->icon}}"></i></a></th>
                                                                        <td>{{$social->site_name}}</td>
                                                                        <td>{{$social->url}}</td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <button type="button" class="editSocialForm" style="color: #3fb614;background-color: transparent;border: none;"
                                                                                        data-id     = "{{$social->id}}"
                                                                                        data-name   = "{{$social->site_name}}"
                                                                                        data-ics   = "{{$social->icon}}"
                                                                                        data-url    = "{{$social->url}}"
                                                                                ><i class="fa fa-edit"></i></button>
                                                                                <a href="{{route('delete-social', $social->id )}}" style="color: #b62626;background-color: transparent;border: none;"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="messages" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">S M T P</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="{{route('update-smtp')}}">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">النوع</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_type}}" id="example-email" name="smtp_type" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">اسم المستخدم</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_username}}" id="example-email" name="smtp_username" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">الرقم السري</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_password}}" id="example-email" name="smtp_password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">الاسم المرسل</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_sender_email}}" id="example-email" name="smtp_sender_email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">الايميل المرسل</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_sender_name}}" id="example-email" name="smtp_sender_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">البورت</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_port}}" id="example-email" name="smtp_port" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">الهوست</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_host}}" id="example-email" name="smtp_host" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">التشفير</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->smtp_encryption}}" id="example-email" name="smtp_encryption" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">S M S</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('update-sms')}}">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">رقم الهاتف</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->sms_number}}" id="example-email" name="sms_number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">الرقم السري</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->sms_password}}" id="example-email" name="sms_password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="example-email">اسم الراسل</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->sms_sender_name}}" id="example-email" name="sms_sender_name" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="notify" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">One Signal</h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <form class="form-horizontal" role="form" method="post" action="{{route('update-one-signal')}}">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="col-md-2" for="example-email">Application ID</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->oneSignal_application_id}}" name="oneSignal_application_id" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2" for="example-email">Authorization</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->oneSignal_authorization}}" name="oneSignal_authorization" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">FCM</h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <form class="form-horizontal" role="form" method="post" action="{{route('update-fcm')}}">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="col-md-2" for="example-email">FCM Server Key</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->fcm_server_key}}" name="fcm_server_key" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2" for="example-email">FCM Sender ID</label>
                                                <div class="col-md-10">
                                                    <input type="text" value="{{$setting->fcm_sender_id}}" name="fcm_sender_id" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit"  class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection

@section('script')

    <!-- Editable js -->
    <script src="{{url('/design/admin/')}}/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="{{url('/design/admin/')}}/assets/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
    <script src="{{url('/design/admin/')}}/assets/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="{{url('/design/admin/')}}/assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
    <script src="{{url('/design/admin/')}}/assets/plugins/tiny-editable/numeric-input-example.js"></script>

    <!-- init -->
    <script src="{{url('/design/admin/')}}/assets/pages/datatables.editable.init.js"></script>

    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'اسحب وافلت الصورة او قم بالضغط',
                'replace': 'اسحب وافلت الصورة او قم بالضغط لتغير الصورة',
                'remove': 'حذف',
                'error': 'Ooops, هناك خطأ'
            },
            error: {
                'fileSize': 'حجم الصورة كير جدا'
            }
        });

        $("#openSocialForm").on('click', function () {
            $(this).attr('disabled', 'disabled');
            $("#addSocial").removeClass('hidden');
        });

        $("#cancel").on('click', function () {
            $('#openSocialForm').removeAttr('disabled');
            $("#addSocial").addClass('hidden');
        });

        $(".editSocialForm").on('click', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let icon = $(this).data('ics');
            let url = $(this).data('url');

            $("input[name='id']").val(id);
            $("input[name='edit_name']").val(name);
            $("input[name='edit_icon']").val(icon);
            $("input[name='edit_url']").val(url);

            $("#editSocial").removeClass('hidden');
        });

        $("#cancelEdit").on('click', function () {
            $("#editSocial").addClass('hidden');
        });
    </script>
@endsection