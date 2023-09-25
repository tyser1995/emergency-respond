@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'community_service'
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
                                    <h3 class="mb-0 h3_title">Community Service</h3>
                                </div>
                                <div class="col-4 text-right create-region-btn">
                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary" id="create-region-btn">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('notification.index')
                            <form method="post" action="{{ route('community_service.store') }}" autocomplete="off">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Fullname') }}</h5>
                                        <input type="text" name="fullname" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Fullname') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Contact Number') }}</h5>
                                        <input type="text" name="contact" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Contact Number') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Email') }}</h5>
                                        <input type="text" name="email" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Email') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Organization') }}</h5>
                                        <input type="text" name="organization" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Organization') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Message') }}</h5>
                                        <textarea class="form-control form-control-alternative" style="height: 150px" name="message"></textarea>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
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

@push('scripts')
    <script>

    </script>
@endpush
