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


body {
    height: 100vh !important;
    background: #fafbff;
}

.floatingButtonWrap {
    display: block;
    position: fixed;
    bottom: 45px;
    right: 45px;
    z-index: 999999999;
}

.floatingButtonInner {
    position: relative;
}

.floatingButton {
    display: block;
    width: 60px;
    height: 60px;
    text-align: center;
    background: -webkit-linear-gradient(45deg, #8769a9, #507cb3);
    background: -o-linear-gradient(45deg, #8769a9, #507cb3);
    background: linear-gradient(45deg, #8769a9, #507cb3);
    color: #fff;
    line-height: 50px;
    position: absolute;
    border-radius: 50% 50%;
    bottom: 0px;
    right: 0px;
    border: 5px solid #b2bedc;
    /* opacity: 0.3; */
    opacity: 1;
    transition: all 0.4s;
}

.floatingButton .fa {
    font-size: 15px !important;
}

.floatingButton.open,
.floatingButton:hover,
.floatingButton:focus,
.floatingButton:active {
    opacity: 1;
    color: #fff;
}


.floatingButton .fa {
    transform: rotate(0deg);
    transition: all 0.4s;
}

.floatingButton.open .fa {
    transform: rotate(270deg);
}

.floatingMenu {
    position: absolute;
    bottom: 60px;
    right: 0px;
    /* width: 200px; */
    display: none;
}

.floatingMenu li {
    width: 100%;
    float: right;
    list-style: none;
    text-align: right;
    margin-bottom: 5px;
}

.floatingMenu li a {
    padding: 8px 15px;
    display: inline-block;
    background: #ccd7f5;
    color: #6077b0;
    border-radius: 5px;
    overflow: hidden;
    white-space: nowrap;
    transition: all 0.4s;
    /* -webkit-box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22);
    box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22); */
    -webkit-box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
    box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
}

.floatingMenu li a:hover {
    margin-right: 10px;
    text-decoration: none;
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
                <i class="fas fa-users"></i>
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
                <h3><?php 
                                            $count = \App\Models\User::where('role','=',9)
                                            ->get();
                                            echo count($count);
                                        ?></h3>

                    <p>Total GBI</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\User::where('role','=',9)
                                ->get()
                                ->last();
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
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                    <?php 
                                            $count = \App\Models\User::where('role','=',10)
                                            ->get();
                                            echo count($count);
                                        ?></h3>
                    </h3>

                    <p>Total Local Resident</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\User::where('role','=',10)
                                ->get()
                                ->last();
                            ?>
                    @if (!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{ $count->created_at->diffForHumans() }}
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
                    <h3>
                    <?php 
                                            $count = \App\Models\User::where('role','=',8)
                                            ->get();
                                            echo count($count);
                                        ?>
                    </h3>

                    <p>Total NGO Member</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-nurse"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                <?php 
                                $count = \App\Models\User::where('role','=',8)
                                ->get()
                                ->last();
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
    </div>
   <?php
    $user_role = \App\Models\User::findOrFail(Auth::user()->id);
   ?>
    <div class="row <?= $user_role->role == 10 ? 'd-none' : '' ?>">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php 
                                            $count = \App\Models\Incident::where('status','Active')
                                            ->get();
                                            echo count($count);
                                        ?></h3>

                    <p>Active Incidents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bed"></i>
                </div>
                <a href="{{ route('incident.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\Incident::where('status','Active')
                                ->get()
                                ->last();
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
                <h3><?php 
                                            $count = \App\Models\Incident::where('status','Resolved')
                                            ->get();
                                            echo count($count);
                                        ?></h3>

                    <p>Resolved Incidents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <a href="{{ route('incident.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\Incident::where('status','Resolved')
                                ->get()
                                ->last();
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
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                    <?php 
                                            $count = \App\Models\Incident::all();
                                            echo count($count);
                                        ?></h3>
                    </h3>

                    <p>Total Incidents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-procedures"></i>
                </div>
                <a href="{{ route('incident.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php 
                                $count = \App\Models\Incident::get()
                                ->last();
                            ?>
                    @if (!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{ $count->created_at->diffForHumans() }}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
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

    <div class="modal fade" id="modal_incident" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <form id="frmIncident" method="post" action="{{ route('incident.store') }}" enctype="multipart/form-data" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Incident Report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Incident Type</label>
                            <select name="drpIncidentType" class="form-control select2" style="width: 100%;" required>
                                <option selected disabled>Choose Incident Type</option>
                                @foreach ($incident_type as $incident_types)
                                    <option value="{{$incident_types->id}}">{{$incident_types->incident_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtDesc">Description</label>
                            <input type="text" class="form-control" id="txtDesc" name="txtDesc" placeholder="Describe the incident" required>
                        </div>
                        <div class="form-group">
                            <label for="txtLocation">Location</label>
                            <input type="text" class="form-control" id="txtLocation" name="txtLocation" placeholder="Enter incident area">
                        </div>
                        <div class="form-group d-none">
                            <label for="txtLongitude">Longitude</label>
                            <input type="text" class="form-control" id="txtLongitude" name="txtLongitude" placeholder="Enter email" readonly>
                        </div>
                        <div class="form-group d-none">
                            <label for="txtLatitude">Latitude</label>
                            <input type="text" class="form-control" id="txtLatitude" name="txtLatitude" placeholder="Enter email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="txtDateTime">Date & Time:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" name="txtDateTime" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <img class="single-upload-img-show" id="img_incident" style="object-fit:contain"
                            src="{{asset('/gallery/img/no-image1.jpg')}}" alt="Browse image" width="100%"
                            height="250px" />
                        <div class="input-group control-group increment">
                            <input type="file" class="file-upload d-none" name="image" accept="image/*" capture
                                onchange="readURL(this);" id="choose_image">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-start">
                        <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
                        <button id="btnSpin" type="button" class="btn btn-primary d-none">
                        <i class="fas fa-sync fa-spin"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- <form method="POST" action="">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </form> -->
    <!-- d-block d-md-none d-lg-none d-xl-none mobile only-->
    <div class="floatingButtonWrap d-block d-md-none d-lg-none d-xl-none">
        <div class="floatingButtonInner">
            <a href="#" class="floatingButton">
                <i class="fa fa-plus icon-default"></i>
            </a>
            <ul class="floatingMenu d-none">
                <li>
                    <a href="#">Add Supplier</a>
                </li>
                <li>
                    <a href="#">Add Table</a>
                </li>
                <li>
                    <a href="#">Add Food</a>
                </li>
                <li>
                    <a href="#">Add Menu Type</a>
                </li>
                <li>
                    <a href="#">Add Menu</a>
                </li>
                <li>
                    <a href="https://google.com" target="_blank">Go To Google</a>
                </li>
                <li>
                    <a href="#">Add Inventory</a>
                </li>
                <li>
                    <a href="#">Add Staff</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection

@push('scripts')
<script>
// Webcam.set({
//     width: 490,
//     height: 350,
//     image_format: 'jpeg',
//     jpeg_quality: 90
// });

// Webcam.attach( '#my_camera' );

// function take_snapshot() {
//     Webcam.snap( function(data_uri) {
//         $(".image-tag").val(data_uri);
//         document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
//     } );
// }

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
    var bounds = new google.maps.LatLngBounds();
    map = new google.maps.Map(document.getElementById('map'), {
        // center: {
        //     lat: -34.397,
        //     lng: 150.644
        // },
        //zoom: 12
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
                $('#txtLatitude').val(position.coords.latitude);
                $('#txtLongitude').val(position.coords.longitude);
                bounds.extend(new google.maps.LatLng(position.coords.latitude,position.coords.longitude));

                infoWindow.setPosition(pos);
                //infoWindow.setContent('Location found.');
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

        google.maps.event.addListener(map, "bounds_changed", function() {
            // send the new bounds back to your server
                //console.log("map bounds{"+map.getBounds());
                //this.setZoom(map.getZoom()-1);

                // if (this.getZoom() > 15) {
                //     this.setZoom(15);
                // }
            });

        //center the map to the geometric center of all markers
        //map.setCenter(bounds.getCenter());
        //map.fitBounds(bounds);
        //remove one zoom level to ensure no marker is on the edge.
        map.setZoom(12); 
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

<script async defer
    src="{{asset('js')}}/gmap.js">
</script>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var getData = e.target.result.split(':')[0];
            var getType = e.target.result.split(':')[1];
            var typeResult = getType.split('/')[0];
            if (typeResult === 'image') {
                $('#img_incident').attr('src', e.target.result);
            } else {}


        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $('#frmIncident').submit(function (e) { 
        $('#btnSubmit').css('pointer-events: none');
        $('#btnSubmit').addClass('d-none');
        $('#btnSpin').removeClass('d-none');
        $('#btnCancel').class('d-none');
    });
    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    $('#img_incident').click(function(e) {
        $('#choose_image').trigger('click');
    });
    $('.floatingButton').click(function() {
        $('#modal_incident').modal('show');
    });
    // $('.floatingButton').on('click',
    //     function(e) {
    //         e.preventDefault();

    //         $(this).toggleClass('open');
    //         if ($(this).children('.fa').hasClass('fa-plus')) {
    //             $(this).children('.fa').removeClass('fa-plus');
    //             $(this).children('.fa').addClass('fa-close');
    //         } else if ($(this).children('.fa').hasClass('fa-close')) {
    //             $(this).children('.fa').removeClass('fa-close');
    //             $(this).children('.fa').addClass('fa-plus');
    //         }
    //         $('.floatingMenu').stop().slideToggle();
    //     }
    // );
    // $(this).on('click', function(e) {

    //     var container = $(".floatingButton");
    //     // if the target of the click isn't the container nor a descendant of the container
    //     if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) {
    //         if (container.hasClass('open')) {
    //             container.removeClass('open');
    //         }
    //         if (container.children('.fa').hasClass('fa-close')) {
    //             container.children('.fa').removeClass('fa-close');
    //             container.children('.fa').addClass('fa-plus');
    //         }
    //         $('.floatingMenu').hide();
    //     }

    //     // if the target of the click isn't the container and a descendant of the menu
    //     if (!container.is(e.target) && ($('.floatingMenu').has(e.target).length > 0)) {
    //         $('.floatingButton').removeClass('open');
    //         $('.floatingMenu').stop().slideToggle();
    //     }
    // });
    // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
    // demo.initChartsPages();
});
</script>
@endpush