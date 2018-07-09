@extends('dashboard.index')
@section('title')
    التقارير
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <h4 class="header-title m-t-0 m-b-30">التقارير</h4>

                <div class="row">
                    <div class="col-sm-12">

                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation" class="active">
                                <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"aria-expanded="true">تقارير المشرفين</a>
                            </li>
                            <li role="presentation">
                                <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">تقارير الاعضاء</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <table class="table table-striped table-bordered table-responsives" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>العضو</th>
                                        <th>الحدث</th>
                                        <th>ال IP</th>
                                        <th>البلد</th>
                                        <th>المنطقة</th>
                                        <th>المدينة</th>
                                        <th>التاريخ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($supervisorReports as $r)
                                        <tr>
                                            <th scope="row">
                                                <img src="{{asset('images/admins/'.$r->User->avatar)}}" class="img-circle img-responsive img-rounded" width="30px" height="30px">
                                            </th>
                                            <td>{{$r->event}}</td>
                                            <td>{{$r->ip}}</td>
                                            <td>{{$r->country}}</td>
                                            <td>{{$r->area}}</td>
                                            <td>{{$r->city}}</td>
                                            <td>{{$r->created_at->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                <table class="table table-striped table-bordered table-responsives" id="datatable2">
                                    <thead>
                                    <tr>
                                        <th>العضو</th>
                                        <th>الحدث</th>
                                        <th>ال IP</th>
                                        <th>البلد</th>
                                        <th>المنطقة</th>
                                        <th>المدينة</th>
                                        <th>التاريخ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($usersReports as $r)
                                        <tr>
                                            <th scope="row">
                                                <img src="{{asset('images/admins/'.$r->User->avatar)}}" class="img-circle img-responsive img-rounded" width="30px" height="30px">
                                            </th>
                                            <td>{{$r->event}}</td>
                                            <td>{{$r->ip}}</td>
                                            <td>{{$r->country}}</td>
                                            <td>{{$r->area}}</td>
                                            <td>{{$r->city}}</td>
                                            <td>{{$r->created_at->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{route('deletereports')}}" class="btn btn-danger"><i class="fa fa-trash"></i> حذف الكل</a>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->


@endsection