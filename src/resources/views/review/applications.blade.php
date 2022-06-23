@extends('seat-hr::review.layouts.view', [ 'viewname' => 'applications' ])

@section('page_header', trans('seat-hr::review.title') . ': ' . trans('seat-hr::review.applications.title'))

@section('review_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::review.applications.sub-title') }}</h3>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>

    </div>
@stop

@push('javascript')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{ $dataTable->scripts() }}
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush

