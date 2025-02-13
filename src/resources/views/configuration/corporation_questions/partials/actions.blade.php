<div class="btn-group btn-group-sm float-right">
    @if($row->corporation_question_active)
        <form
            action="{{ route('seat-hr.config.corporation-question.toggle') }}"
            method="post"
        >
            @csrf
            <input type="hidden" name="id" value="{{ $row->corporation_question_id }}">
            <button class="btn btn-sm btn-warning" type="submit"
                data-toggle="tooltip" title="{{ trans('seat-hr::corporation_questions.toggle.tooltip') }}"
            >
                <i class="fas fa-ban"></i>
            </button>
        </form>

        <form
            action="{{ route('seat-hr.config.corporation-question.delete') }}"
            method="post"
            onsubmit="return confirm('DANGER: Deleting a question will delete all historical answers for the question! ' +
              '\r\nYou should use the deactivate option instead to keep answers but prevent future submissions.' +
              '\r\n\r\nAre you sure you want to proceed?');"
        >
            @csrf
            <input type="hidden" name="id" value="{{ $row->corporation_question_id }}">
            <button class="btn btn-sm btn-danger" type="submit"
                    data-toggle="tooltip" title="{{ trans('seat-hr::corporation_questions.delete.tooltip') }}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @elseif(!$row->active)
        <button class="btn btn-sm btn-accent" type="" disabled
            data-toggle="tooltip" title="{{ trans('seat-hr::corporation_questions.toggle.tooltip_inactive') }}"
        >
            <i class="fas fa-times-circle"></i>
        </button>
    @else
        <form
            action="{{ route('seat-hr.config.corporation-question.add') }}"
            method="post"
        >
            @csrf
            <input type="hidden" name="corporation_id" value="{{ request()->id }}">
            <input type="hidden" name="question_id" value="{{ $row->question_id }}">
            <button class="btn btn-sm btn-primary" type="submit"
                data-toggle="toggle" title="{{ trans('seat-hr::corporation_questions.add.tooltip') }}"
            >
                <i class="fas fa-plus"></i>
            </button>
        </form>
    @endif
</div>
