<div class="btn-group btn-group-sm float-right">
    <a href="{{ route('seat-hr.config.question.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a onclick="return confirmQuestionDelete(this)" 
        href="{{ route('seat-hr.config.question.delete', ['id' => $row->id]) }}" 
        class="btn btn-sm btn-danger"
    >
        <i class="fas fa-trash"></i>
    </a>
</div>
<script>
    function confirmQuestionDelete(node) {
        return confirm(
            'DANGER: Deleting a question will delete all historical answers for the question!' +
            '\nThis will also lead to existing applications having this question/answer deleted, potentially leading to blank applications. ' +
            '\nYou should use the deactivate option instead to keep answers but prevent future submissions.' +
            '\n\nAre you sure you want to proceed?'
        );
    }
</script>