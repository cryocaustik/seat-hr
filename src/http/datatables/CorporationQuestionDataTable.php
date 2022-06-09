<?php

namespace Cryocaustik\SeatHr\http\datatables;

use Cryocaustik\SeatHr\models\SeatHrCorporationQuestion;
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
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('active', function ($row) {
                $bool = $row->active;
                return view('seat-hr::configuration.corporation_questions.partials.bool', compact('bool'));
            })
            ->editColumn('used', function ($row) {
                $bool = !is_null($row->id);
                return view('seat-hr::configuration.corporation_questions.partials.bool', compact('bool'));
            })
            ->editColumn('question_type', function ($row) {
                return ucwords($row->question_type);
            })
            ->addColumn('action', function ($row) {
                return view('seat-hr::configuration.corporation_questions.partials.actions', compact('row'));
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
     * @param Cryocaustik\SeatHr\models\SeatHrCorporationQuestion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SeatHrCorporationQuestion $model)
    {
        return $model->newQuery()->questions($this->request->id);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('question_id')->title('ID')->searchable(false)->hidden(),
            Column::make('question_name')->title('Question')->name('seat_hr_questions.name'),
            Column::make('question_type')->title('Data Type')->searchable(false),
            Column::make('active')->title('Active?')->searchable(false),
            Column::make('used')->title('Used?')->searchable(false),
            Column::computed('action')
                ->searchable(false)
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
    protected function filename()
    {
        return 'CorporationQuestion_' . date('YmdHis');
    }
}
