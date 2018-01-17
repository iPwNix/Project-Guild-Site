@extends('layouts.app')

@section('content')


<!-- wrapper -->
	<div id="wrapper">	

	<section class="profile-nav editNavi border-bottom-1 border-grey-300">
			<div class="tab-select editProfTab sticky">
				<div class="container editProfNav">
					<ul class="nav nav-tabs edit-profile-nav-tabs" role="tablist">
						<li><a href="/edit/profile/{{ $user->id }}">Edit Profile</a></li>
						<li><a href="/edit/profile/characters/{{ $user->id }}">
						Edit Characters</a></li>
						<li><a href="/edit/profile/avatar/{{ $user->id }}">
						Edit Avatar</a></li>
						<li class="active"><a href="/edit/profile/cover/{{ $user->id }}" 
						onclick="return false">Edit Cover</a></li>
					</ul>
				</div>
			</div>
		</section>

		<section class="padding-bottom-60">
			<div class="container">

				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Editing {{ $user->username }}'s Cover
					</h4>
				</div>
				
				<div class="panel panel-default edit-profile-panel edit-profile-cover-panel">
					<div class="panel-body panel-edit-profile-cover-body">
						<form class="form-label" enctype="multipart/form-data"
						 action="/edit/profile/cover/{{ $user->id }}" method="POST" autocomplete="off">
						 
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group row file-upload-row">
								<label for="cover" class="custom-file-upload custom-file-load-cover col-md-2">
							    <i class="fa fa-cloud-upload"></i> Upload New Cover (1920x300)
								</label>
								<div class="col-md-10">
									<input type="file" name="cover" id="cover" 
									class="avatarInput" accept=".jpeg, .jpg, .jpe, .png">
								</div>
							</div>

							<div class="form-group row">        
						      <div class="text-center">
						        <button type="submit" class="btn bn-upload btn-rounded btn-shadow btn-full">Edit Cover</button>
						      </div>
						    </div>

						</form>
					</div>
				</div>
				
			</div>
		</section>
	</div>
	<!-- /#wrapper -->


@endsection