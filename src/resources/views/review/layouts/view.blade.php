@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::review.title'))

@section('full')
    <div class="row">
        <div class="col-md-3">
            @include('seat-hr::review.includes.summary')
        </div>
        <div class="col-md-9">
            @include('seat-hr::review.includes.menu')

            @yield('review_content')
        </div>
    </div>
@stop

@push('javascript')

@endpush
