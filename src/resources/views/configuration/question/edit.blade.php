@extends('web::layouts.grids.12')

@section('title', trans('seat-hr::question.edit.title'))
@section('page_header', trans('seat-hr::question.edit.title'))

@section('full')
    <div class="card">
        <h5 class="card-header">{{ trans('seat-hr::question.edit.sub-title') }}</h5>
        <div class="card-body">
            <form action="{{ route('seat-hr.config.question.edit', [ 'id' => $question->id ]) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Question</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ $question->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="type">Data Type</label>
                        <select name="type" id="type" class="form-control" required>
                            @php
                                $options = ['boolean', 'date', 'datetime', 'string', 'text'];
                            @endphp
                            @foreach($options as $opt)
                                <option
                                    value="{{ $opt }}"
                                    @if($question->type == $opt)
                                        selected
                                    @endif
                                >
                                    {{ ucfirst($opt) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="custom-control custom-switch">
                        <input type="hidden" class="custom-control-input" name="active" value="0">
                        <input type="checkbox" class="custom-control-input" name="active" id="active"
                               value="1" @if($question->active) checked @endif>
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
    </div>
@stop

@push('javascript')

@endpush
