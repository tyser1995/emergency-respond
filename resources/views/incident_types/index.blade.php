@extends('layouts.app', [
'class' => '',
'elementActive' => 'incident_types'
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
                                <h3 class="mb-0 h3_title">{{__('Incident Types')}}</h3>
                            </div>
                            @can('deparment_type-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('incident_type.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Incident Type') }}</a>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDepartmentType" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Incident Type</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incident_type as $incident_types)
                                    <tr>
                                        <td class="d-none">{{$incident_types->id}}</td>
                                        <td>{{$incident_types->incident_name}}</td>
                                        <td>{{$incident_types->created_at}}</td>
                                        <td class="text-center">
                                        <a href="{{route('incident_type.edit', $incident_types->id)}}" class="{{Auth::user()->can('incident_type-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pen"></i></a>
                                        <button type="button" data-id="{{$incident_types->id}}" value="{{$incident_types->incident_name}}" class="btnCanDestroy {{Auth::user()->can('incident_type-delete') ? 'btn btn-danger btn-sm' : 'btn btn-danger btn-sm d-none'}} "><i class="fa fa-trash"></i></button>
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
                text: 'Do you want to remove ' + $(this).val() + ' Incident Types?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/incident_types/delete/" + $(this).data('id');
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