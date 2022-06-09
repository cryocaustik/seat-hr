@extends('seat-hr::user.layouts.view', [ 'viewname' => 'intel' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::hr.intel'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::hr.intel') }}</h3>
        </div>
        <div class="card-body">
            Coming soon :TM:
{{--            TODO: add this --}}
        </div>

    </div>
@stop

