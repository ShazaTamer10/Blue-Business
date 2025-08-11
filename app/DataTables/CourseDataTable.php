<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($course) {
                if ($course->image) {
                    return '<img style="width:70px; height:50px; object-fit:cover;" src="'.asset('storage/'.$course->image).'" alt="Course Image">';
                }
                return '-';
            })
            ->addColumn('video', function($course) {
                if ($course->video_path) {
                    return '<a href="'.asset('storage/'.$course->video_path).'" target="_blank" class="btn btn-sm btn-info">View Video</a>';
                }
                return '-';
            })
            ->addColumn('pdf', function($course) {
                if ($course->pdf_path) {
                    return '<a href="'.asset('storage/'.$course->pdf_path).'" target="_blank" class="btn btn-sm btn-danger">View PDF</a>';
                }
                return '-';
            })
            ->addColumn('content_description', function($course) {
                return \Illuminate\Support\Str::limit($course->content_description, 50);
            })
            ->addColumn('created_at', function($course) {
                return $course->created_at ? $course->created_at->format('d-m-Y / H:i') : '-';
            })
            ->addColumn('action', function($course) {
                $editUrl = route('admin.course.edit', $course->id);
                $deleteUrl = route('admin.course.destroy', $course->id);
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

    public function query(Course $model): QueryBuilder
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
            Column::computed('video')->title('Video')->width(100)->addClass('text-center'),
            Column::computed('pdf')->title('PDF')->width(100)->addClass('text-center'),
            Column::make('title')->width(150),
            Column::make('content_description')->title('Content Desc')->width(200),
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
