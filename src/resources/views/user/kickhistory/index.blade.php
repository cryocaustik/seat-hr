@extends('seat-hr::user.layouts.view', [ 'viewname' => 'kickhistory' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::user.kick_history.title'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::user.kick_history.title') }}</h3>
            <a href="{{ route('seat-hr.profile.kickhistory.create', ['character' => $character]) }}" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-plus"></i>
                Add
            </a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Kicked By</td>
                        <td>Kicked At</td>
                        <td>Reason</td>
                        <td>Created By</td>
                        <td>Created At</td>
                        <td>Updated At</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seat_hr_user->kickhistory as $kick)
                        <tr>
                            <td>{{ $kick->id }}</td>
                            <td>{{ $kick->kicked_by }}</td>
                            <td>{{ $kick->kicked_at }}</td>
                            <td style="white-space: pre-wrap;">{{ $kick->reason }}</td>
                            <td>{{ $kick->creator->name }}</td>
                            <td>{{ $kick->created_at }}</td>
                            <td>{{ $kick->updated_at }}</td>
                            <td>@include('seat-hr::user.kickhistory.partials.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

