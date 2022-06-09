@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::corp.edit.title'))
@section('page_header', trans('seat-hr::corp.edit.title'))

@section('full')
    <div class="card">
        <h5 class="card-header">{{ trans('seat-hr::corp.edit.sub-title') }}</h5>
        <div class="card-body">
            <form action="{{ route('seat-hr.config.corp.edit', [ 'id' => $corporation->id ]) }}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="hr_head">Corporation</label>
                        <input type="text" class="form-control" disabled value="{{ $corporation->corporation->name }}">
                    </div>

                    <div class="form-group">
                        <label for="hr_head">HR Head</label>
                        <input type="text" class="form-control" name="hr_head" value="{{ $corporation->hr_head }}" required>
                    </div>

                    <div class="custom-control custom-switch">
                        <input type="hidden" class="custom-control-input" name="has_restricted_questions" value="0">
                        <input type="checkbox" class="custom-control-input" name="has_restricted_questions"
                               id="has_restricted_questions" value="1"
                               @if($corporation->has_restricted_questions) checked @endif
                        >
                        <label for="has_restricted_questions" class="custom-control-label">Has Restricted Questions?</label>
                    </div>

                    <div class="custom-control custom-switch">
                        <input type="hidden" class="custom-control-input" name="accepting_applications" value="0">
                        <input type="checkbox" class="custom-control-input" name="accepting_applications"
                               id="accepting_applications" value="1"
                               @if($corporation->accepting_applications) checked @endif
                        >
                        <label for="accepting_applications" class="custom-control-label">Accepting Applications?</label>
                    </div>

                    <div class="form-group">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a href="{{ route('seat-hr.config.corp.view') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop

@push('javascript')

@endpush
