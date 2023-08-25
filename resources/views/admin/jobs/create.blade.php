@extends('layouts.app')
@section('breadcrumb')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Jobs</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/jobs') }}">Jobs</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>

</div>
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h5>Jobs</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('jobs.store', []) }}" method="POST" class="m-0 p-0">
                <div class="card-body row">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{@old('title')}}" />
                        @if($errors->has('title'))
                        <div class='error small text-danger'>{{$errors->first('title')}}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="ckeditor"></textarea>
                        @if($errors->has('description'))
                        <div class='error small text-danger'>{{$errors->first('description')}}</div>
                        @endif
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="visible_from" class="form-label">Visible From:</label>
                        <input type="date" name="visible_from" id="visible_from" class="form-control" value="{{@old('visible_from')}}" />
                        @if($errors->has('visible_from'))
                        <div class='error small text-danger'>{{$errors->first('visible_from')}}</div>
                        @endif
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="visible_to" class="form-label">Visible To:</label>
                        <input type="date" name="visible_to" id="visible_to" class="form-control" value="{{@old('visible_to')}}" />
                        @if($errors->has('visible_to'))
                        <div class='error small text-danger'>{{$errors->first('visible_to')}}</div>
                        @endif
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label for="deadline" class="form-label">Deadline:</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" value="{{@old('deadline')}}" />
                        @if($errors->has('deadline'))
                        <div class='error small text-danger'>{{$errors->first('deadline')}}</div>
                        @endif
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex flex-row align-items-center justify-content-between">
                        <a href="{{ route('jobs.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-primary">@lang('Create new Job')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
