@extends('layouts.main')

@section('section')
<!-- ========== form-elements-wrapper start ========== -->
<div class="form-elements-wrapper">
    <form action="/category/{{ $category->slug }}" method="post">
    @csrf
    @method('put')
    <div class="row">
    <div class="col-lg-6">
        <!-- input style start -->
        <div class="card-style mb-30">
        <h6 class="mb-25">Category Form</h6>
        <div class="input-style-1">
            <label for="category">Category Name</label>
            <input type="text" class="@error('category') is-invalid @enderror text-capitalize" placeholder="Category Name" name="category" id="category" value="{{ old('category', $category->category) }}" required/>
            @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <h6 class="mb-25">Status</h6>
        <div class="form-check radio-style mb-20">
            <input class="form-check-input" type="radio" name="status" id="show" @if(old('status', $category->status) == 'show') checked @endif value="show">
            <label class="form-check-label" for="show">
              Show
            </label>
          </div>
          <div class="form-check radio-style mb-20">
            <input class="form-check-input" type="radio" name="status" id="archive" @if(old('status', $category->status) == 'archive') checked @endif value="archive">
            <label class="form-check-label" for="archive">
              Archive
            </label>
          </div>
          <div class="form-check radio-style mb-20">
            <input class="form-check-input" type="radio" name="status" id="delete" @if(old('status', $category->status) == 'delete') checked @endif value="delete">
            <label class="form-check-label" for="delete">
              Delete
            </label>
          </div>

          <button class="btn btn-primary" type="submit">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.11 3.9 21 5 21H12.81C12.45 20.38 12.2 19.7 12.08 19L12 19C10.34 19 9 17.66 9 16S10.34 13 12 13C12.68 13 13.34 13.23 13.87 13.65C15 12.59 16.46 12 18 12C19.05 12 20.09 12.28 21 12.81V7L17 3M15 9H5V5H15V9M17 14V17H14V19H17V22H19V19H22V17H19V14H17Z" />
            </svg>
             Save
          </button>
        </div>
    </div>
    </div>
    </form>
</div>
@endsection