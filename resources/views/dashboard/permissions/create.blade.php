@section('styles')

@endsection

@extends('dashboard.index')
@section('title')
    الصلاحيات
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="pull-right">
                    <label for="checkAll" id="check">تحديد الكل</label>
                    <input type="checkbox" id="checkAll" class="pull-right" data-plugin="switchery" data-color="rgb(12, 105, 140)" data-size="small"/>
                </div>

                <h4 class="header-title m-t-0 m-b-30 text-purple">قائمة الصلاحيات</h4>
                <hr>
                <div class="card-footer">
                    <form action="{{route('addpermission')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-md-2" for="example-email">الصلاحية</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" required name="role">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                       {{Permissions()}}
                        <button type="submit" class="btn btn-block btn-success btn-rounded waves-effect waves-light w-md m-b-5"><span style="font-weight: bolder;font-size: 15px">حــفــظ</span></button>
                    </form>
                </div>

            </div>
        </div><!-- end col -->
    </div>


@endsection
@section('script')
    <script>

        $(document).ready(function() {
            $("#checkAll").on('change', function () {
                if ($(this).prop('checked') == true) {
                    $("#check").html('الفاء تحديد الكل');
                } else {
                    $("#check").html('تحديد الكل');
                }
                 $('.check-permission').trigger('click');
            });
        });

    </script>
@endsection

