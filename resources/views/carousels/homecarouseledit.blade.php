@extends('layouts.app')

@section('content')

		<section class="bg-grey-50 padding-bottom-60">
			<div class="container">
				<div class="headline">
					<h4 class="no-padding-top">Editing Slide #{{ $currentCarousel->id }} 
					<small>Slide #{{ $currentCarousel->id }} for the homepage</small></h4>
				</div>
				
				<div class="panel panel-default margin-bottom-30">
					<div class="panel-body">
						<form class="form-label" 
						enctype="multipart/form-data" 
						action="/edit/homecarousel/{{ $currentCarousel->id }}" method="POST">

						{{ csrf_field() }}
						{{ method_field('PATCH') }}
	
							<div class="form-group row">
								<label for="title" class="col-md-2">Title</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="title" name="title" 
									value="{{ $currentCarousel->title }}" placeholder="Title (Required)">
								</div>
							</div>

							<div class="form-group row">
								<label for="description" class="col-md-2">Description</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="description" 
									name="description" 
									value="{{ $currentCarousel->description }}" 
									placeholder="Description (Leave empty if no Description)">
								</div>
							</div>

							<div class="form-group row">
								<label for="link" class="col-md-2">Link</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="link" 
									name="link" value="{{ $currentCarousel->link }}" 
									placeholder="Link (Leave empty if no link)">
								</div>
							</div>

							<div class="form-group row">
								<label for="linkName" class="col-md-2">Link Name</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="linkName" 
									name="linkName" value="{{ $currentCarousel->linkName }}" placeholder="Link Name (Leave empty if no Link)">
								</div>
							</div>

						<div class="form-group row file-upload-row">
								<label for="slideimage" class="custom-file-upload col-md-2">
							    <i class="fa fa-cloud-upload"></i> Upload New Slide (1920x1080)
								</label>
								<div class="col-md-10">
									<input type="file" name="slideimage" id="slideimage" 
									class="avatarInput" accept=".jpeg, .jpg, .jpe, .png">
								</div>
							</div>


						    <div class="form-group">        
						      <div class="text-center">
						        <button type="submit" class="btn btn-primary btn-lg btn-rounded btn-shadow btn-full">Edit Slide</button>
						      </div>
						    </div>

						</form>
					</div>
				</div>
			</div>
		</section>


@endsection