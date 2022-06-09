@extends('seat-hr::user.layouts.view', [ 'viewname' => 'blacklist' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::user.blacklist.title'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::user.blacklist.title') }}</h3>
            <a href="{{ route('seat-hr.profile.blacklist.create', ['character' => $character]) }}" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-plus"></i>
                Add
            </a>
        </div>
        <div class="card-text">
            <table class="table">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Blacklisted By</td>
                        <td>Blacklisted At</td>
                        <td>Reason</td>
                        <td>Created By</td>
                        <td>Created At</td>
                        <td>Updated At</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seat_hr_user->blacklists as $blacklist)
                        <tr>
                            <td>{{ $blacklist->id }}</td>
                            <td>{{ $blacklist->blacklisted_by }}</td>
                            <td>{{ $blacklist->blacklisted_at }}</td>
                            <td style="white-space: pre-wrap;">{{ $blacklist->reason }}</td>
                            <td>{{ $blacklist->creator->name }}</td>
                            <td>{{ $blacklist->created_at }}</td>
                            <td>{{ $blacklist->updated_at }}</td>
                            <td>@include('seat-hr::user.blacklist.partials.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

