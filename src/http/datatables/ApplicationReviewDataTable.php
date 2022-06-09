<?php

namespace Cryocaustik\SeatHr\http\datatables;

use Cryocaustik\SeatHr\models\SeatHrApplication;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ApplicationReviewDataTable extends DataTable
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
                return $row->corporation->corporation->name;
            })
            ->editColumn('profile_id', function ($row) {
                return $row->profile->user->name;
            })
            ->editColumn('can_reapply', function ($row) {
                return view('seat-hr::review.partials.reapply', compact('row'));
            })
            ->editColumn('status', function ($row) {
                $status = $row->currentStatus;
                return view('seat-hr::review.partials.status', compact('status'));
            })
            ->editColumn('status_by', function ($row) {
                return $row->currentStatus->assignerName;
            })
            ->addColumn('action', function ($row) {
                return view('seat-hr::review.partials.application-actions', compact('row'))->render();
            })
            ;
    }

    public function query(SeatHrApplication $model)
    {
        return $model->with(['corporation', 'currentStatus', 'profile'])->where('corporation_id', $this->id);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('applications-review-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
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
            Column::make('id'),
            Column::make('profile_id')->title('Profile'),
            Column::make('corporation_id')->title('Corporation'),
            Column::make('status'),
            Column::make('status_by'),
            Column::make('can_reapply')->title('Cat Reapply?'),
            Column::make('created_at')->title('Submitted At'),
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
        return 'Application_' . date('YmdHis');
    }
}
