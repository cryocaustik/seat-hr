@extends('seat-hr::user.layouts.view', [ 'viewname' => 'kickhistory' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::user.kick_history.title'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::user.kick_history.edit.sub-title') }}</h3>
        </div>
        <form action="{{ route('seat-hr.profile.kickhistory.edit', ['character' => $character, 'kickhistory' => $kickhistory]) }}" method="post">
            <div class="card-body">
                {{ csrf_field() }}

                <input type="hidden" name="id" id="id" value="{{ $kickhistory->id }}" class="hidden" disabled>

                <div class="form-group">
                    <label for="kicked_by">Kicked By</label>
                    <input type="text" name="kicked_by" id="kicked_by" value="{{ $kickhistory->kicked_by }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="kicked_at">Kicked At</label>
                    <input type="date" name="kicked_at" id="kicked_at" value="{{ $kickhistory->kicked_at }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="reason">Reason</label>
                    <textarea name="reason" id="reason" rows="5" class="form-control">{{ $kickhistory->reason }}</textarea>
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

