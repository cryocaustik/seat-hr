@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::question.create.title'))
@section('page_header', trans('seat-hr::question.create.title'))

@section('full')
    <div class="card">
        <h5 class="card-header">{{ trans('seat-hr::question.create.sub-title') }}</h5>
        <form action="{{ route('seat-hr.config.question.create') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Question</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="type">Data Type</label>
                    <select name="type" id="type" class="form-control"  required>
                        <option value="boolean">Boolean</option>
                        <option value="date">Date</option>
                        <option value="datetime">Date Time</option>
                        <option value="string" selected>String</option>
                        <option value="text">Text</option>
                    </select>
                </div>

                <div class="custom-control custom-switch">
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
