@extends('admin.layouts.layout')

@section('content')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('admin.course.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Courses</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>All Courses</h4>
              <a href="{{ route('admin.course.create') }}" class="btn btn-success">
                Create New <i class="fas fa-plus"></i>
              </a>
            </div>

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>

          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
