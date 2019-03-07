@extends('layouts.backend.app')
@section('title','Post')
@push('css')
@endpush
@section('content')
<form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
	                    	@csrf
	<div class="container-fluid">            
	    <!-- Vertical Layout | With Floating Label -->
	    <div class="row clearfix">
	        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header">
	                    <h2>
	                        ADD NEW POST
	                    </h2>
	                </div>
	                <div class="body">                   
	                    	
	                        <div class="form-group form-float">
	                            <div class="form-line">
	                                <input type="text" id="title" name="title" class="form-control">
	                                <label class="form-label">Post Title</label>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="image">Feature Image</label>
	                            <input type="file" id="image" name="image" class="form-control">
	                        </div>
	                        <div class="form-group">
	                            <input type="checkbox" id="publish" name="status" class="filled-in" value="1">
	                            <label class="publish">Publish</label>

	                        </div>		                       
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header">
	                    <h2>
	                        ADD NEW POST
	                    </h2>
	                </div>
	                <div class="body">                   
	                    	
	                        <div class="form-group form-float">
	                            <div class="form-line">
	                                <input type="text" id="name" name="name" class="form-control">
	                                <label class="form-label">Post Name</label>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <input type="file" id="image" name="image" class="form-control">
	                        </div>
	                        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.index') }}">BACK</a>
	                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
	                </div>
	            </div>
	        </div>

	    </div>
	    <!-- Vertical Layout | With Floating Label -->               
	</div>
	<div class="container-fluid">            
	    <!-- Vertical Layout | With Floating Label -->
	    <div class="row clearfix">
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header">
	                    <h2>
	                        ADD NEW POST
	                    </h2>
	                </div>
	                <div class="body">	                   
	                    	
	                        <div class="form-group form-float">
	                            <div class="form-line">
	                                <input type="text" id="name" name="name" class="form-control">
	                                <label class="form-label">Post Name</label>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <input type="file" id="image" name="image" class="form-control">
	                        </div>	                        
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- Vertical Layout | With Floating Label -->               
	</div>
</form>	
@endsection
@push('js')
@endpush