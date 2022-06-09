<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('seat-hr.profile.applications.view', [
            'character' => $row->profile->user->main_character_id,
            'application' => $row->id,
        ]) }}"
       class="btn btn-sm btn-info mr-2"
       data-toggle="tooltip" data-placement="bottom" title="View application"
    >
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{
        route('seat-hr.review.application.review', [
            'corporation' => $row->corporation_id,
            'application' => $row->id,
        ])
     }}" class="btn btn-sm btn-primary"
       data-toggle="tooltip" data-placement="bottom" title="Start Review"
    >
        <i class="fas fa-hourglass-start"></i>
    </a>
    <a href="{{ route('seat-hr.review.application.approve', [
        'corporation' => $row->corporation_id,
        'application' => $row->id,
    ]) }}" class="btn btn-sm btn-success"
       data-toggle="tooltip" data-placement="bottom" title="Approve Application"
    >
        <i class="fas fa-check"></i>
    </a>
    <a href="{{ route('seat-hr.review.application.reject', [
        'corporation' => $row->corporation_id,
        'application' => $row->id,
    ]) }}" class="btn btn-sm btn-danger"
       data-toggle="tooltip" data-placement="bottom" title="Reject Application"
    >
        <i class="fas fa-ban"></i>
    </a>

    <a href="{{ route('seat-hr.review.application.cancel', [
        'corporation' => $row->corporation_id,
        'application' => $row->id,
    ]) }}" class="btn btn-sm btn-outline-secondary ml-2"
       data-toggle="tooltip" data-placement="bottom" title="Cancel Application"
    >
        <i class="fas fa-window-close"></i>
    </a>
</div>
