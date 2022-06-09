<div class="btn-group btn-group-sm float-right">
    <a href="{{ route('seat-hr.profile.note.edit', ['character' => $character, 'note' => $note]) }}" class="btn btn-sm btn-warning"
       data-toggle="tooltip" data-placement="bottom" title="Edit note"
    >
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="{{ route('seat-hr.profile.note.delete', ['character' => $character, 'note' => $note]) }}" class="btn btn-sm btn-danger"
       data-toggle="tooltip" data-placement="bottom" title="Delete user note"
    >
        <i class="fas fa-trash"></i>
    </a>
</div>
