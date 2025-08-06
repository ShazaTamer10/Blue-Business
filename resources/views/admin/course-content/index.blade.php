@extends('admin.layouts.layout')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{ route('admin.course.index') }}" class="btn btn-icon">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
    <h1>Content for: {{ $course->title }}</h1>
    <div class="section-header-button ml-auto">
      <a href="{{ route('admin.course.content.create', $course->id) }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Content
      </a>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header"><h4>All Course Content</h4></div>
      <div class="card-body">
        {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
