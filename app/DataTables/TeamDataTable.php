<?php

namespace App\DataTables;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($team) {
                if ($team->image) {
                    return '<img style="width:70px; height:50px; object-fit:cover;" src="'.asset('storage/'.$team->image).'" alt="">';
                }
                return '-';
            })
            
            ->addColumn('name', function($team) {
                return \Illuminate\Support\Str::limit($team->name, 20);
            })
            ->addColumn('position', function($team) {
                return \Illuminate\Support\Str::limit($team->position, 30);
            })
            ->addColumn('created_at', function($team) {
                return $team->created_at ? $team->created_at->format('d-m-Y / H:i') : '-';
            })
            ->addColumn('action', function($team) {
                $editUrl = route('admin.team.edit', $team->id);
                $deleteUrl = route('admin.team.destroy', $team->id);
                return '
                    <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a>
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Are you sure?\')">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['image', 'video', 'pdf', 'action']);
    }

    public function query(TeamMember $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->width(50),
            Column::computed('image')->title('Image')->width(100)->addClass('text-center'),
            Column::make('name')->width(150),
            Column::make('position')->title('Position')->width(200),
            Column::make('created_at')->width(150),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Course_' . date('YmdHis');
    }
}
