@extends('seat-hr::user.layouts.view', [ 'viewname' => 'applications' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::hr.applications'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('seat-hr::hr.applications') }}</h3>
            <a href="{{ route('seat-hr.profile.applications.apply', [ 'character' => $character->character_id ]) }}" class="btn btn-success btn-sm float-right">
                <i class="fas fa-plus"></i>
                Apply
            </a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Corporation</th>
                    <th>Status</th>
                    <th>Can Re-apply</th>
                    <th>Submitted At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($seat_hr_user->applications as $app)
                    <tr>
                        <td>{{ $app->id }}</td>
                        <td>{{ $app->corporation->corporation->name }}</td>
                        <td>
                            <div class="badge bade-{{ $app->currentStatus->status->color }}">
                                {{ $app->currentStatus->status->name }}
                            </div>
                        </td>
                        <td>
                            @if($app->can_reapply)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>{{ $app->created_at }}</td>
                        <td>
                            <a href="{{ route('seat-hr.profile.applications.view', [ 'character' => $character, 'application' => $app ]) }}"
                               class="btn bn btn-primary btn-sm float-right">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@stop
