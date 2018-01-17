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
						<li class="active"><a href="/edit/profile/avatar/{{ $user->id }}" 
						onclick="return false">
						Edit Avatar</a></li>
						<li><a href="/edit/profile/cover/{{ $user->id }}">Edit Cover</a></li>
					</ul>
				</div>
			</div>
		</section>

		<section class="padding-bottom-60">
			<div class="container">
				
				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Editing {{ $user->username }}'s Avatar
					</h4>
				</div>

				<div class="panel panel-default edit-profile-panel edit-profile-cover-panel">
					<div class="panel-body panel-edit-profile-cover-body">
						<form class="form-label" enctype="multipart/form-data"
						 action="/edit/profile/avatar/{{ $user->id }}" method="POST" autocomplete="off">
						 
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group row file-upload-row">
								<label for="avatar" class="custom-file-upload custom-file-load-cover col-md-2">
							    <i class="fa fa-cloud-upload"></i> Upload New Avatar (300x300)
								</label>
								<div class="col-md-10">
									<input type="file" name="avatar" id="avatar" 
									class="avatarInput" accept=".jpeg, .jpg, .jpe, .png">
								</div>
							</div>

							<div class="form-group row">        
						      <div class="text-center">
						        <button type="submit" class="btn bn-upload btn-rounded btn-shadow btn-full">Edit Avatar</button>
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