@section('styles')

@endsection

@extends('dashboard.index')
@section('title')
    تعديل
@endsection
@section('content')

    <div class="panel panel-custom panel-border">
        <div class="panel-heading">
            <div class="user-profile">
                <div class="profile-img">
                    <img src="{{asset('images/admins/'.auth()->user()->avatar)}}" alt="user-img" title="Mat Helme" class="img-responsive">
                </div>
            </div>
            <h3 class="panel-title">عرض العضو : Mohamed Masoud</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('updateuser')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                {{csrf_field()}}
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
                            <input type="text" autocomplete="nope" name="phone" required class="form-control phone" placeholder="05011000000">
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
                <div class="row" style="margin-top: 15px;width: 65%;margin: auto;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label">الصورة الشخصية</label>
                                <input style="border-radius: 50%" type="file" name="avatar" data-default-file="{{asset('images/admins/'.auth()->user()->avatar)}}" class="dropify" data-max-file-size="1M">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px">
                    <div>
                        <span class="col-sm-4 control-label" style="margin-bottom: 10px">تحديد الموقع</span>
                        <div class="col-sm-12">
                            <div class="col-md-12">
                                <div class="map" style="height: 400px; margin-top: 20px" id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')

    <script>
        var map;
        var markers = [];
        function initMap() {
            var haightAshbury = {lat: 31.043956282336183, lng: 31.38311851319736};

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: haightAshbury,
                mapTypeId: 'terrain'
            });

            // This event listener will call addMarker() when the map is clicked.
            map.addListener('click', function(event) {
                deleteMarkers();
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();
                $("input[name='lat']").val(lat);
                $("input[name='long']").val(lng);
                addMarker(event.latLng);
            });

        }

        function addMarker(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

    </script>

@endsection