<?php

namespace Cryocaustik\SeatHr\http\datatables;

use Cryocaustik\SeatHr\models\SeatHrCorporation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CorporationDataTable extends DataTable
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
            ->editColumn('corporation_id', function ($row) {
                return $row->corporation->name;
            })
            ->editColumn('has_restricted_questions', function ($row) {
                $bool = $row->has_restricted_questions;
                return view('seat-hr::configuration.corporation.partials.bool', compact('bool'));
            })
            ->editColumn('accepting_applications', function ($row) {
                $bool = $row->accepting_applications;
                return view('seat-hr::configuration.corporation.partials.bool', compact('bool'));
            })
            ->addColumn('action', function ($row) {
                return view('seat-hr::configuration.corporation.partials.actions', compact('row'))->render();
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Cryocaustik\SeatHr\http\datatables\CorporationDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SeatHrCorporation $model)
    {
        return $model->newQuery()->with('corporation');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('corporationdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                            ->action('window.location = "'. route('seat-hr.config.corp.create') .'"')
                            ->text('Add Corporation')
                    )
            ;
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('corporation_id')->title('Corporation'),
            Column::make('hr_head'),
            Column::make('has_restricted_questions'),
            Column::make('accepting_applications'),
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
    protected function filename()
    {
        return 'Corporation_' . date('YmdHis');
    }
}
