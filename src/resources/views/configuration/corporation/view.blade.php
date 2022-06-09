@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::corp.title'))
@section('page_header', trans('seat-hr::corp.title'))

@section('full')
    <div class="card">
        <h5 class="card-header">{{ trans('seat-hr::corp.sub-title') }}</h5>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@stop

@push('javascript')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{ $dataTable->scripts() }}
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
