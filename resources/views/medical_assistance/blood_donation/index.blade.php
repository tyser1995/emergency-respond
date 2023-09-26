@extends('layouts.app', [
'class' => '',
'elementActive' => 'medical_assistance'
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
                                <h3 class="mb-0 h3_title">{{__('List of Community Service')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDepartmentType" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Organization</th>
                                    <th>Message</th>
                                    <th>Blood Type</th>
                                    @if (Auth::user()->role == 1)
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blood_donation as $blood_donations)
                                    <tr>
                                        <td class="d-none">{{$blood_donations->id}}</td>
                                        <td>{{$blood_donations->fullname}}</td>
                                        <td>{{$blood_donations->contact}}</td>
                                        <td>{{$blood_donations->email}}</td>
                                        <td>{{$blood_donations->organization}}</td>
                                        <td>{{$blood_donations->message}}</td>
                                        <td>{{$blood_donations->blood_type}}</td>
                                        @if (Auth::user()->role == 1)
                                        <td>
                                            <button type="button" data-id="{{$blood_donations->id}}"
                                                value="{{$blood_donations->fullname}}"
                                                class="btnCanDestroy btn btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                        @endif

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


        $('#tblDepartmentType tbody').on('click','.btnCanDestroy',function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + '?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/blood_donations/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() + ' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblUser').DataTable().ajax.reload();
                    });
                }
            });
        });
    });
</script>
@endpush
