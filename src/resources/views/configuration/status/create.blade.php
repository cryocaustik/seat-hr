@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::status.create.title'))
@section('page_header', trans('seat-hr::status.create.title'))

@section('full')
    <div class="card">
        <h5 class="card-header">{{ trans('seat-hr::status.create.sub-title') }}</h5>
        <form action="{{ route('seat-hr.config.status.create') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="type">Color</label>
                    <select name="type" id="type" class="form-control"  required>
                        <option value="primary" selected>Primary</option>
                        <option value="secondary">Secondary</option>
                        <option value="success">Success</option>
                        <option value="warning">Warning</option>
                        <option value="danger">Danger</option>
                    </select>
                </div>

                <div class="custom-control custom-switch">
                    <input type="hidden" class="custom-control-input" name="active" value="0">
                    <input type="checkbox" class="custom-control-input" name="active" id="active" value="1" checked>
                    <label for="active" class="custom-control-label">Enabled?</label>
                </div>
                <div class="form-group">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('seat-hr.config.question.view') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop

@push('javascript')

@endpush
