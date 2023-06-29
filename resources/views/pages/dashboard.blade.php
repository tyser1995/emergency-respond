@extends('layouts.app', [
'class' => '',
'elementActive' => 'dashboard'
])

@section('content')
<style>
/**
       * @license
       * Copyright 2019 Google LLC. All Rights Reserved.
       * SPDX-License-Identifier: Apache-2.0
       */
/** 
       * Always set the map height explicitly to define the size of the div element
       * that contains the map. 
       */
#map {
    height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.custom-map-control-button {
    background-color: #fff;
    border: 0;
    border-radius: 2px;
    box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
    margin: 10px;
    padding: 0 0.5em;
    font: 400 18px Roboto, Arial, sans-serif;
    overflow: hidden;
    height: 40px;
    cursor: pointer;
}

.custom-map-control-button:hover {
    background: rgb(235, 235, 235);
}
</style>
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('Dashboard')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-none">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php 
                                            $count = \App\Models\User::all();
                                            echo count($count);
                                        ?></h3>

                    <p>Total User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('users') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\User::get()->last();
                            ?>
                    @if (!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>

                    <p>Total Incident</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\User::get()->last();
                            ?>
                    @if (!!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0</h3>

                    <p>Local Resident</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\User::get()->last();
                            ?>
                    @if (!!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0</h3>

                    <p>NGO Member</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\User::get()->last();
                            ?>
                    @if (!!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- Map card -->
    <div class="card bg-gradient-primary">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-map-marker-alt mr-1"></i>
                Visitors
            </h3>
            <!-- card tools -->
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <div class="card-body">
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
        <!-- /.card-body-->
        <div class="card-footer bg-transparent d-none">
            <div class="row">
                <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.card -->
    <!-- /.row -->
</div>
@endsection

@push('scripts')
<script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
var map, infoWindow;
const labels = "X";
//let markers = [];
let labelIndex = 0;

// setInterval(() => {
//     initMap();
// }, 5000);

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -34.397,
            lng: 150.644
        },
        zoom: 12
    });
    infoWindow = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                //infoWindow.setContent('Location found.');
                console.log(infoWindow.position);
                //infoWindow.open(map);

                var marker = new google.maps.Marker({
                    map: map,
                    position: pos,
                    flat: false,
                    //animation: google.maps.Animation.BOUNCE,
                    //label: labels[labelIndex++ % labels.length],
                });

                setInterval(() => {
                    marker.setMap(map);
                }, 1999);
                setInterval(() => {
                    marker.setMap(null);
                }, 2000);
                map.setCenter(pos);
                marker.setMap(map);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        }, 2000);
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}
window.initMap = initMap;

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    var marker = new google.maps.Marker({
        map: map,
        position: pos,
        //animation: google.maps.Animation.BOUNCE,
        //label: labels[labelIndex++ % labels.length],
    });

    setInterval(() => {
        marker.setMap(map);
    }, 1999);
    setInterval(() => {
        marker.setMap(null);
    }, 2000);


    // infoWindow.setContent(browserHasGeolocation ?
    //     'Error: The Geolocation service failed.' :
    //     'Error: Your browser doesn\'t support geolocation.');
    //infoWindow.open(map);
}
</script>
<!-- <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(10.720321, 122.5621),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
          //downloadUrl('http://localhost:8080/thesis/salon/map/markers.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script> -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClxpzuEYmbt5qmjpkB348ouv2V-pL4TII&callback&libraries=visualization&callback=initMap">
</script>
<script>
$(document).ready(function() {
    // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
    demo.initChartsPages();
});
</script>
@endpush