@extends('seat-hr::review.layouts.view', [ 'viewname' => 'summary' ])

@section('page_header', trans('seat-hr::review.title') . ': ' . trans('seat-hr::hr.summary'))

@section('review_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::review.summary') }}</h3>
        </div>
        <div class="card-body">
            Coming soon :TM:
            Still wondering what I would be most useful here...
            {{--            TODO: add this --}}
        </div>

    </div>
@stop

