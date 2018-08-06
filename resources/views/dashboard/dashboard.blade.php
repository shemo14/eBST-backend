@extends('dashboard.index')
@section('title')
الرئيسية
@endsection
@section('content')

    <div class="row">

        @foreach(Home() as $h)
            <div class="col-lg-4 col-sm-6" style=" color: whitesmoke; font-family: Cairo !important;">
                <div class="card-box" style="background-color: {{$h['color']}}; font-family: Cairo !important;">
                    <h4 class="header-title m-t-0 m-b-30" style=" color: whitesmoke; font-family: Cairo !important;">{{$h['name']}}</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1">
                            {!! $h['icon'] !!}
                        </div>

                        <div class="widget-detail-1">
                            <h2 class="p-t-10 m-b-0" style=" color: whitesmoke; font-family: Cairo !important;">
                                {{$h['count']}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection