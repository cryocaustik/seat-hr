@extends('seat-hr::user.layouts.view', [ 'viewname' => 'sheet' ])

@section('page_header', trans('seat-hr::user.title') . ': ' . trans('seat-hr::hr.sheet'))

@section('profile_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seat_hr_user->roles()->get() as $role)
                        <tr>
                            <td>
                                @if($role->logo)
                                    <img src="{{ $role->logo }}" class="img-sm img-fluid">
                                @endif
                                <span class="pl-2">{{ $role->title }}</span>
                            </td>
                            <td>{{ $role->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop

