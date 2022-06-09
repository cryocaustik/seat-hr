<div class="btn-group btn-group-sm float-right">
    <a href="{{ route('seat-hr.profile.kickhistory.edit', ['character' => $character, 'kickhistory' => $kick]) }}" class="btn btn-sm btn-warning"
       data-toggle="tooltip" data-placement="bottom" title="Edit blaclist record"
    >
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="{{ route('seat-hr.profile.kickhistory.delete', ['character' => $character, 'kickhistory' => $kick]) }}" class="btn btn-sm btn-danger"
       data-toggle="tooltip" data-placement="bottom" title="Delete kickhistory record"
    >
        <i class="fas fa-trash"></i>
    </a>
</div>
