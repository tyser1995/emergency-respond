@extends('layouts.app', [
'class' => '',
'elementActive' => 'incident_archive'
])

@section('content')
<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h3_title">{{__('List of Archived Incidents')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div id="donutchart" style="width: 100%; height: 500px;" class="d-none"></div>

                    <div class="card-body">
                        <table id="tblDepartmentType" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Incident</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incident_archived as $incident_archiveds)
                                    <tr>
                                        <td>{{$incident_archiveds->incident_name}}</td>
                                        <td>{{$incident_archiveds->count}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @include('notification.index')
                        <table id="tblDepartmentType" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Incident</th>
                                    <th>Description</th>
                                    <th>Location</th>
                                    <th>Image</th>
                                    <th>Date & Time</th>
                                    <th class="d-none"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incident as $incidents)
                                    <tr>
                                        <td class="d-none">{{$incidents->id}}</td>
                                        <td>{{$incidents->incident_name}}</td>
                                        <td>{{$incidents->description}}</td>
                                        <td>{{$incidents->lat.', '.$incidents->lng}}</td>
                                        <td><img src="{{ asset('incidents_img/'.$incidents->incident_name.'/'.$incidents->image) }}" style="width:100px; height:100px; border-radius: 50%;" /></td>
                                        <td>{{$incidents->datetime_incident}}</td>
                                        <td class="text-center d-none">
                                        <!-- <a href="{{route('incident.edit', $incidents->id)}}" class="{{Auth::user()->can('incident-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pen"></i></a> -->
                                        <button type="button" data-id="{{$incidents->id}}" value="{{$incidents->incident_name}}" class="btnCanDestroy {{Auth::user()->can('incident-delete') ? 'btn btn-danger btn-sm' : 'btn btn-danger btn-sm d-none'}} "><i class="fa fa-trash"></i></button>
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
@endsection

@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                @foreach ($incident_archived as $incident_archiveds)
                    ['{{$incident_archiveds->incident_name}}','{{$incident_archiveds->count}}'],
                @endforeach
            ]);

            var options = {
                title: 'List of Incidents',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }

    $(document).ready(function () {

        $('#tblDepartmentType').DataTable({
            order:[[1,'asc']]
        });
        $('.btnCanDestroy').click(function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + ' incident?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/incidents/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() + ' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblDepartmentType').DataTable().ajax.reload();
                    });
                }
            });
        });
    });
</script>
@endpush
