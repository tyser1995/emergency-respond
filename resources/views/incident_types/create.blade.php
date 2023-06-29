@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'incident_types'
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card  shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0 h3_title">{{__('Incident Types')}}</h3>
                                </div>
                                <div class="col-4 text-right create-region-btn">
                                    <a href="{{ route('incident_types') }}" class="btn btn-sm btn-primary" id="create-region-btn">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('notification.index')
                            <form method="post" action="{{ route('incident_type.store') }}" autocomplete="off">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Incident Type') }}</h5>
                                        <input type="text" name="incident_name" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Incident Type') }}" required autofocus>
                                    </div>
                                    @can('incident_type-store')
                                        <div class="">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    @endcan
                                </div>
                            </form>
                            <div id="app"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
