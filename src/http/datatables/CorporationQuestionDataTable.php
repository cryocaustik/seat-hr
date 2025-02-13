<?php

namespace Cryocaustik\SeatHr\http\datatables;

use Cryocaustik\SeatHr\models\SeatHrCorporationQuestion;
use Cryocaustik\SeatHr\models\SeatHrQuestion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CorporationQuestionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(mixed $query): \Yajra\DataTables\Contracts\DataTable
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('active', function ($row) {
                $bool = $row->active;
                return view('seat-hr::configuration.corporation_questions.partials.bool', ['bool' => $bool]);
            })
            ->editColumn('corporation_question_active', function ($row) {
                // $bool = !is_null($row->id);
                $bool = $row->corporation_question_active ?? false;
                return view('seat-hr::configuration.corporation_questions.partials.bool', ['bool' => $bool]);
            })
            ->editColumn('type', fn($row): string => ucwords((string) $row->type))
            ->addColumn('action', fn($row) => view('seat-hr::configuration.corporation_questions.partials.actions', ['row' => $row]))
            ->addColumn('debug', function ($row) use ($query) {
                return $query->toSql();
            });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('corporationquestiondatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0, 'asc')
            ->buttons(
                Button::make('reload')
                    ->text('<i class="fas fa-sync"></i>')
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SeatHrQuestion $model)
    {
        return $model->newQuery()->corporationQuestions($this->request->id);
        // return $model->newQuery()->questions($this->request->id);
        // return $model->newQuery()->where('corporation_id', $this->request->id)->with('question');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->searchable(false)->hidden(),
            Column::make('name')->title('Question')->name('seat_hr_questions.name'),
            Column::make('type')->title('Data Type')->searchable(false),
            Column::make('active')->title('Active?')->searchable(false),
            Column::make('corporation_question_active')->title('Used?')->searchable(false),
            Column::computed('action')
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('debug')->title('Debug')->searchable(false)->hidden(),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CorporationQuestion_' . date('YmdHis');
    }
}
