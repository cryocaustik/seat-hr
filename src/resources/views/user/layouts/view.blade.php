@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::user.title'))

@section('full')
    <div class="row">
        <div class="col-md-3">
            @include('seat-hr::user.includes.summary')
        </div>
        <div class="col-md-9">
            @include('seat-hr::user.includes.menu')

            @yield('profile_content')
        </div>
    </div>
@stop

@push('javascript')

@endpush
