@extends('layouts.backend.app')
@section('title','Post')
@push('css')   
@endpush
@section('content')
	<div class="container-fluid">
	 <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.post.index') }}">BACK</a>  
	 @if($post->is_approved == false)
	   <button type="button" class="btn btn-success pull-right" onclick="deletePost({{ $post->id }})">
	   	  <i class="material-icons">done</i>
	   	  <span>Approve</span>
	   </button>
	   <form action="{{ route('admin.post.approve', $post->id)}}" method="POST" id="approval-form-{{ $post->id }}" style="display: none;">
	   	@csrf
	   	@method('PUT')
	   	
	   </form>
	 @else
	    <button type="button" class="btn btn-success pull-right" disabled="disabled">
	   	  <i class="material-icons">done</i>
	   	  <span>Approved</span>
	   </button>
	 @endif  
	 <br>   
	 <br>      
	    <!-- Vertical Layout | With Floating Label -->
	    <div class="row clearfix">
	        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header">
	                    <h2>
	                        {{ $post->title }}
	                        <small>PostedBy <strong><a href="#">{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }} </small>
	                    </h2>
	                </div>
	                <div class="body">                   
	                    {!! $post->body !!}                 
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	            <div class="card">
	                <div class="header bg-cyan">
	                    <h2>
	                    	Categories
	                    </h2>
	                </div>
	                <div class="body">                   
	                  @foreach($post->Categories as $category)
	                  <span class="label bg-cyan">{{ $category->name }}</span>
	                  @endforeach
	                </div>
	            </div>
	             <div class="card">
	                <div class="header bg-green">
	                    <h2>
	                    	Tags
	                    </h2>
	                </div>
	                <div class="body">                   
	                  @foreach($post->tags as $tag)
	                  <span class="label bg-green">{{ $tag->name }}</span>
	                  @endforeach
	                </div>
	            </div>
	             <div class="card">
	                <div class="header bg-amber">
	                    <h2>
	                    	Featured Image
	                    </h2>
	                </div>
	                <div class="body">                   
	                   <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
	                </div>
	            </div>
	        </div>

	    </div>
	    <!-- Vertical Layout | With Floating Label -->               
	</div>	
@endsection
@push('js')
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script type="text/javascript">
    	$(function () {
		    //TinyMCE
		    tinymce.init({
		        selector: "textarea#tinymce",
		        theme: "modern",
		        height: 300,
		        plugins: [
		            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		            'searchreplace wordcount visualblocks visualchars code fullscreen',
		            'insertdatetime media nonbreaking save table contextmenu directionality',
		            'emoticons template paste textcolor colorpicker textpattern imagetools'
		        ],
		        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		        toolbar2: 'print preview media | forecolor backcolor emoticons',
		        image_advtab: true
		    });
		    tinymce.suffix = ".min";
		    tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';

		});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	function deletePost(id) {
		const swalWithBootstrapButtons = Swal.mixin({
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false,
			})

			swalWithBootstrapButtons.fire({
			  title: 'Are you sure?',
			  text: "You want to approve this post!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonText: 'Yes, approve it!',
			  cancelButtonText: 'No, cancel!',
			  reverseButtons: true
			}).then((result) => {
			  if (result.value) {
			    /*swalWithBootstrapButtons.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'
			    )*/
			     event.preventDefault();
			    document.getElementById('approval-form-'+id).submit();
			    
			  } else if (
			    // Read more about handling dismissals
			    result.dismiss === Swal.DismissReason.cancel
			  ) {
			    swalWithBootstrapButtons.fire(
			      'Cancelled',
			      'The Post Remain Pending:)',
			      'error'
			    )
			  }
			})
	}
</script>

@endpush