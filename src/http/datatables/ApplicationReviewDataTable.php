<?php

namespace Cryocaustik\SeatHr\http\datatables;

use Cryocaustik\SeatHr\models\SeatHrApplication;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

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
            ->editColumn('can_reapply', function ($row) {
                return view('seat-hr::review.partials.reapply', compact('row'));
            })
            ->editColumn('currentStatus.status.name', function ($row) {
                $status = $row->currentStatus;
                return view('seat-hr::review.partials.status', compact('status'));
            })
            ->editColumn('currentStatus.assigner.name', function ($row) {
                return $row->currentStatus->assignerName;
//                return $row->currentStatus->assigner ? $row->currentStatus->assigner->name : '';
            })
            ->addColumn('action', function ($row) {
                return view('seat-hr::review.partials.application-actions', compact('row'))->render();
            });
    }

    public function query(SeatHrApplication $model)
    {
        return $model->with([
            'corporation',
            'corporation.corporation',
            'currentStatus',
            'currentStatus.status',
            'currentStatus.assigner',
            'profile',
            'profile.user',
        ])
            ->corporationView($this->id)
            ->select('seat_hr_applications.*');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('applications-review-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'title' => 'App ID'],
            ['data' => 'profile.user.name', 'title' => 'Profile'],
            ['data' => 'corporation.corporation.name', 'title' => 'Corporation', 'sortable' => false],
            ['data' => 'currentStatus.status.name', 'title' => 'Status', 'sortable' => false],
            ['data' => 'currentStatus.assigner.name', 'title' => 'Status By'],
            ['data' => 'can_reapply', 'title' => 'Can Reapply?'],
            ['data' => 'created_at', 'title' => 'Submitted At'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->sortable(false)
                ->searchable(false)
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
