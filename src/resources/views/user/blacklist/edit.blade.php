@extends('seat-hr::user.layouts.view', [ 'viewname' => 'blacklist' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::user.blacklist.title'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::user.blacklist.edit.sub-title') }}</h3>
        </div>
        <form action="{{ route('seat-hr.profile.blacklist.edit', ['character' => $character, 'blacklist' => $blacklist]) }}" method="post">
            <div class="card-body">
                {{ csrf_field() }}

                <input type="hidden" name="id" id="id" value="{{ $blacklist->id }}" class="hidden" disabled>

                <div class="form-group">
                    <label for="blacklisted_by">Blacklisted By</label>
                    <input type="text" name="blacklisted_by" id="blacklisted_by" value="{{ $blacklist->blacklisted_by }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="blacklisted_at">Blacklisted At</label>
                    <input type="date" name="blacklisted_at" id="blacklisted_at" value="{{ $blacklist->blacklisted_at }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="reason">Reason</label>
                    <textarea name="reason" id="reason" rows="5" class="form-control">{{ $blacklist->reason }}</textarea>
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

