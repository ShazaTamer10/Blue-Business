@extends('admin.layouts.layout')

@section('content')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('admin.course.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Course</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Course</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Image --}}
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                    <div class="col-sm-12 col-md-7">
                      <div id="image-preview" class="image-preview" style="background-image: url('{{ asset('storage/'.$course->image) }}'); background-size: cover; background-position: center; height: 150px;">
                          <label for="image-upload" id="image-label" class="btn btn-secondary mt-2">Choose New Image</label>
                          <input type="file" name="image" id="image-upload" class="form-control-file" style="display:none;" />
                      </div>
                    </div>
                </div>

                {{-- Video --}}
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Video</label>
                    <div class="col-sm-12 col-md-7">
                      @if($course->video_path)
                        <video width="320" height="180" controls>
                            <source src="{{ asset('storage/'.$course->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <p>Upload a new video to replace the current one:</p>
                      @endif
                      <input type="file" name="video" class="form-control-file" accept="video/*" />
                    </div>
                </div>

                {{-- PDF --}}
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">PDF</label>
                    <div class="col-sm-12 col-md-7">
                      @if($course->pdf_path)
                        <p>Current PDF: <a href="{{ asset('storage/'.$course->pdf_path) }}" target="_blank" class="btn btn-sm btn-danger">View PDF</a></p>
                        <p>Upload a new PDF to replace the current one:</p>
                      @endif
                      <input type="file" name="pdf" class="form-control-file" accept="application/pdf" />
                    </div>
                </div>

                {{-- Title --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
                  </div>
                </div>

                {{-- Description --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea name="description" class="summernote">{!! old('description', $course->description) !!}</textarea>
                  </div>
                </div>

                {{-- Content Description --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content Description</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea name="content_description" class="form-control" rows="4">{{ old('content_description', $course->content_description) }}</textarea>
                  </div>
                </div>

                {{-- Submit Button --}}
                <div class="form-group row mb-4">
                  <div class="col-sm-12 col-md-7 offset-md-3">
                    <button type="submit" class="btn btn-primary">Update Course</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        // Show chosen image preview
        $('#image-upload').change(function(){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image-preview').css('background-image', 'url('+e.target.result +')');
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endpush
