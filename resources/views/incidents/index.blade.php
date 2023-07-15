@extends('layouts.app', [
'class' => '',
'elementActive' => 'incidents'
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
                                <h3 class="mb-0 h3_title">{{__('List of Incidents')}}</h3>
                            </div>
                            <!-- @can('deparment_type-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('department_type.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Department Type') }}</a>
                                </div>
                            @endcan -->
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDepartmentType" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Incident</th>
                                    <th>Description</th>
                                    <th>Location</th>
                                    <th>Date & Time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incident as $incidents)
                                    <tr>
                                        <td class="d-none">{{$incidents->id}}</td>
                                        <td>{{$incidents->incident_name}}</td>
                                        <td>{{$incidents->description}}</td>
                                        <td>{{$incidents->location}}</td>
                                        <td>{{$incidents->datetime_incident}}</td>
                                        <td class="text-center">
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
<script>
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