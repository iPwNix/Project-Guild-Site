@extends('layouts.app')

@section('content')

	<!-- wrapper -->
	<div id="wrapper">	
		<section class="padding-bottom-60">
			<div class="container">

				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">
					Editing News
					</h4>
				</div>
				
				<div class="panel panel-default edit-profile-panel posting-news-panel">
					<div class="panel-body">
						<form class="form-label" enctype="multipart/form-data"
						 action="/edit/newsarticle/{{ $articleToUpdate->id }}" method="POST" autocomplete="off">
						 
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">
						  {{ method_field('PATCH') }}

							<div class="form-group row">
								<label for="title" class="col-md-2">Title</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="title" name="title" placeholder="Add a title" value="{{$articleToUpdate->title}}" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2" for="catagory">Catagory</label>
								<div class="col-md-10">
										<!-- Rounded switch -->
									<select name="catagory" id="catagory" required>
										@foreach($articleCatagories as $articleCatagory)
										<option value="{{ $articleCatagory->id }}">
											{{ $articleCatagory->name }}
										</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2" for="customImagesCheck">Custom Images?</label>
								<div class="col-md-10">
										<!-- Rounded switch -->
									<label class="switch">
									  <input type="checkbox" id="customImagesCheck">
									  <div class="slider round"></div>
									</label>
								</div>
							</div>

					<div class="custom-Images-Form" style="display: none;">

							<div class="form-group row file-upload-row">
								<label class="custom-file-upload col-md-2" for="newsSmallImage">
								Small (700x460)</label>
								<div class="col-md-10">
									<input type="file" name="newsSmallImage" id="newsSmallImage" accept=".jpeg, .jpg, .jpe, .png">
								</div>
							</div>


							<div class="form-group row file-upload-row">
								<label class="custom-file-upload" for="newsImage">
								Medium (850x450)</label>
								<div class="col-md-10">
									<input type="file" name="newsImage" id="newsImage" accept=".jpeg, .jpg, .jpe, .png">
								</div>
							</div>

							<div class="form-group row file-upload-row">
								<label class="custom-file-upload" for="newsCover">
								Large (1920x700)</label>
								<div class="col-md-10">
									<input type="file" name="newsCover" id="newsCover" accept=".jpeg, .jpg, .jpe, .png">
								</div>
							</div>
					</div>

							<div class="form-group row">
								<label class="col-md-2" for="content">Content</label>
								<div class="col-md-10">
									<div class="forum-post no-margin no-shadow" 
									id="content" name="content">
					<textarea name="content" id="content" class="text-editor" value="{{$articleToUpdate->content}}" required></textarea>
									</div>
								</div>
							</div>

							<div class="form-group row">        
						      <div class="text-center">
						        <button type="submit" class="btn btn-full btn-newsmore">Edit News</button>
						      </div>
						    </div>

						</form>
					</div>
				</div>
				
			</div>
		</section>
	</div>
	<script src="/plugins/summernote/summernote.min.js"></script>
	<script src="/plugins/jquery/jquery-3.1.0.min.js"></script>
<script>
$(function() {
	//$('.text-editor').summernote('editor.pasteHTML', '<b>hello world</b>');
	// $('.text-editor').summernote('editor.pasteHTML', '{{ $articleToUpdate->content }}');
	$('.text-editor').summernote('editor.pasteHTML', '{!! $articleToUpdate->content !!}');
});
</script>
	<!-- /#wrapper -->

@endsection