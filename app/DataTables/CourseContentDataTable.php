<?php

namespace App\DataTables;

use App\Models\CourseContent;
use Yajra\DataTables\Services\DataTable;

class CourseContentDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row) {
                return '<a href="'.route('admin.coursecontent.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>
                        <form action="'.route('admin.coursecontent.destroy', $row->id).'" method="POST" style="display:inline;">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>';
            });
    }

    public function query()
    {
        return CourseContent::query();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('coursecontent-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons([
                        'export',
                        'print',
                        'reset',
                        'reload',
                    ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'title',
            'type',
            'created_at',
            'updated_at',
            'action' => ['orderable' => false, 'searchable' => false],
        ];
    }

    protected function filename(): string
{
    return 'CourseContents_' . date('YmdHis');
}

}
