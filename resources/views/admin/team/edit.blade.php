@extends('admin.layouts.layout')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.team.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Team Member</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Team Member</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.team.update', $team->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Image --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" class="form-control" value="{{ $team->name }}">
                                </div>
                            </div>

                            {{-- Position --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="position" class="form-control" value="{{ $team->position }}">
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Update</button>
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
        $('#image-preview').css({
            'background-image': 'url("{{ asset('storage/' . $team->image) }}")',
            'background-size': 'cover',
            'background-position': 'center center'
        });
    });
</script>
@endpush
