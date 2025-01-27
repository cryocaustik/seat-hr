@extends('seat-hr::user.layouts.view', [ 'viewname' => 'note' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::user.notes.title'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::user.notes.title') }}</h3>
            <a href="{{ route('seat-hr.profile.note.create', ['character' => $character]) }}" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-plus"></i>
                Add
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Severity</td>
                        <td>Note</td>
                        <td>Created By</td>
                        <td>Created At</td>
                        <td>Updated At</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seat_hr_user->notes as $note)
                        <tr class="table-{{ $note->severity }}">
                            <td>{{ $note->id }}</td>
                            <td>{{ $note->severity }}</td>
                            <td style="white-space: pre-wrap;">{{ $note->note }}</td>
                            <td>{{ $note->creator->name }}</td>
                            <td>{{ $note->created_at }}</td>
                            <td>{{ $note->updated_at }}</td>
                            <td>@include('seat-hr::user.note.partials.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

