@extends('layouts.backend.app')
@section('title','Post')
@push('css')
@endpush
@section('content')
	<div class="container-fluid">            
	    <!-- Vertical Layout | With Floating Label -->
	    <div class="row clearfix">
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header">
	                    <h2>
	                        EDIT POST
	                    </h2>
	                </div>
	                <div class="body">
	                    <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	@method('PUT')
	                        <div class="form-group form-float">
	                            <div class="form-line">
	                                <input type="text" id="name" value="{{ $post->name }}" name="name" class="form-control">
	                                <label class="form-label">Post Name</label>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <input type="file" id="image" name="image" class="form-control">
	                        </div>
	                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.index') }}">BACK</a>
	                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- Vertical Layout | With Floating Label -->               
	</div>
@endsection
@push('js')
@endpush