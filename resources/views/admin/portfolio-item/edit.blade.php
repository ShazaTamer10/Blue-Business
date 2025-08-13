@extends('admin.layouts.layout')

@section('content')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Portfolio Item Section</h1>

    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Portofolio Item</h4>
            </div>

            <div class="card-body">
              <form action="{{route('admin.portfolio-item.update',$portfolioItem->id)}}" method="post" enctype= "multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                    <div class="col-sm-12 col-md-7">
                      <div id="image-preview" class="image-preview">
                        <label name="file" for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload" />
                      </div>
                    </div>
                  </div>

                <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" name="title" class="form-control" value="{{$portfolioItem->title}}">
                </div>

                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                    <div class="col-sm-12 col-md-7">
                      <select class="form-control selectric" name="category_id">

                        <option>Select</option>
                        @foreach ($categories as $category)
                        <option {{$category->id == $portfolioItem->category_id ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                    <div class="col-sm-12 col-md-7">
                    <textarea name= "description" class="summernote">{!! $portfolioItem->description!!}</textarea>
                    </div>
                </div>


                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Client</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" name="client" class="form-control" value="{{$portfolioItem->client}}">
                    </div>

                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Website</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" name="website" class="form-control" value="{{$portfolioItem->website}}">
                        </div>

                        </div>

                        <div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Additional Images</label>
    <div class="col-sm-12 col-md-7">

        <div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Additional Images</label>
    <div class="col-sm-12 col-md-7">

        {{-- Show Existing Additional Images --}}
        @if(isset($additionalImages) && $additionalImages->count() > 0)
            <div class="mb-3">
                @foreach($additionalImages as $img)
                    <div style="display:inline-block; position:relative; margin:5px;">
                        <img src="{{ asset('storage/' . $img->image) }}" width="100" height="100" style="object-fit:cover; border:1px solid #ddd; border-radius:4px;">
                        <label style="position:absolute; top:-5px; right:-5px; background:red; color:white; font-size:12px; cursor:pointer; padding:2px 5px; border-radius:50%;">
                            <input type="checkbox" name="remove_images[]" value="{{ $img->id }}" style="display:none;">
                            ✕
                        </label>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Upload New Additional Images --}}
        <input type="file" name="additional_images[]" multiple class="form-control">
        <small class="text-muted">You can select multiple images.</small>
    </div>
</div>



                   <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary">Update</button>
                      </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#image-preview').css({
            'background-image': 'url("{{asset($portfolioItem->image)}}")',
            'background-size':'cover',
            'background-position':'center center'
        })
    })
</script>

@endpush

