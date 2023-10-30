<?php

namespace Cryocaustik\SeatHr\http\datatables;

use Cryocaustik\SeatHr\models\SeatHrQuestion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuestionDataTable extends DataTable
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
            ->editColumn('type', fn($row): string => ucwords((string) $row->type))
            ->editColumn('active', fn($row) => view('seat-hr::configuration.question.partials.active', ['row' => $row]))
            ->addColumn('action', fn($row) => view('seat-hr::configuration.question.partials.actions', ['row' => $row])->render());
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\QuestionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SeatHrQuestion $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('questiondatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                            ->action('window.location = "'. route('seat-hr.config.question.create') .'"')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('Question'),
            Column::make('type')->title('Data Type'),
            Column::make('active')->title('Enabled'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Question_' . date('YmdHis');
    }
}
