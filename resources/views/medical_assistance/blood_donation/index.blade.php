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
    });
</script>
@endpush
