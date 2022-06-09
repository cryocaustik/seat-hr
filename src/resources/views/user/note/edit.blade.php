@extends('seat-hr::user.layouts.view', [ 'viewname' => 'note' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::user.notes.title'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::user.notes.edit.sub-title') }}</h3>
        </div>
        <form action="{{ route('seat-hr.profile.note.edit', ['character' => $character, 'note' => $note]) }}" method="post">
            <div class="card-body">
                {{ csrf_field() }}

                <input type="text" name="id" id="id" value="{{ $note->id }}" class="hidden" disabled>

                <div class="form-group">
                    <label for="severity">Severity</label>
                    <select name="severity" id="severity" class="form-control" required>
                        @php
                            $options = ['info', 'warning', 'danger'];
                        @endphp
                        @foreach($options as $opt)
                            <option
                                value="{{ $opt }}"
                                @if($note->severity == $opt)
                                selected
                                @endif
                            >
                                {{ ucfirst($opt) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea name="note" id="note" rows="5" class="form-control">{{ $note->note }}</textarea>
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-block" type="submit">
                    <i class="fas fa-save"></i>
                    Update
                </button>
            </div>
        </form>

    </div>
@stop

