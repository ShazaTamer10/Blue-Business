@extends('admin.layouts.layout')

@section('content')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{ route('admin.course.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Create Course</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Course</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Image --}}
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                    <div class="col-sm-12 col-md-7">
                      <div id="image-preview" class="image-preview" style="height: 150px; background-color: #f0f0f0; background-position: center; background-size: cover;">
                        <label for="image-upload" id="image-label" class="btn btn-secondary mt-2">Choose Image</label>
                        <input type="file" name="image" id="image-upload" class="form-control-file" style="display:none;" />
                      </div>
                    </div>
                </div>

                {{-- Video --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Video</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="file" name="video" class="form-control-file" accept="video/*" />
                  </div>
                </div>

                {{-- PDF --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">PDF</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="file" name="pdf" class="form-control-file" accept="application/pdf" />
                  </div>
                </div>

                {{-- Title --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                  </div>
                </div>

                {{-- Description --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea name="description" class="summernote">{{ old('description') }}</textarea>
                  </div>
                </div>

                {{-- Content Description --}}
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content Description</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea name="content_description" class="form-control" rows="4">{{ old('content_description') }}</textarea>
                  </div>
                </div>

                {{-- Submit Button --}}
                <div class="form-group row mb-4">
                  <div class="col-sm-12 col-md-7 offset-md-3">
                    <button type="submit" class="btn btn-primary">Create Course</button>
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
