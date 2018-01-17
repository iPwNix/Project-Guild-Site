@extends('layouts.app')

@section('content')

	<!-- wrapper -->
	<div id="wrapper">			
		<section class="profile-nav editNavi border-bottom-1 border-grey-300">
			<div class="tab-select editProfTab sticky">
				<div class="container editProfNav">
					<ul class="nav nav-tabs edit-profile-nav-tabs" role="tablist">
						<li class="active"><a href="/edit/profile/{{ $user->id }}" onclick="return false">
						Edit Profile</a></li>
						<li><a href="/edit/profile/characters/{{ $user->id }}">
						Edit Characters</a></li>
						<li><a href="/edit/profile/avatar/{{ $user->id }}">Edit Avatar</a></li>
						<li><a href="/edit/profile/cover/{{ $user->id }}">Edit Cover</a></li>
					</ul>
				</div>
			</div>
		</section>

	<section class="padding-bottom-60">
		<div class="container">

				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Editing {{ $user->username }}'s About & Motto
					</h4>
				</div>

			<div class="panel panel-default edit-profile-panel">
				<div class="panel-body">
					<form class="form-label" 
						action="/edit/profile/{{ $user->id }}" method="POST">

						{{ csrf_field() }}
						{{ method_field('PATCH') }}
	
						@if($profileInfo != NULL && $profileInfo->motto != NULL)
							<div class="form-group row">
								<label for="motto" class="col-md-2 edit-profile-label-small">Motto</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="motto" 
									name="motto" value="{{ $profileInfo->motto }}" 
									placeholder="{{ $profileInfo->motto }}"
									maxlength="255">
								</div>
							</div>
						@else
							<div class="form-group row">
								<label for="motto" class="col-md-2 edit-profile-label-small">Motto</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="motto" 
									name="motto" placeholder="Fill in Your Motto" 
									maxlength="255">
								</div>
							</div>
						@endif

						@if($profileInfo != NULL && $profileInfo->about != NULL)
							<div class="form-group row">
								<label for="about" class="col-md-2 edit-profile-label-small">About You</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="about" 
									name="about" value="{{ $profileInfo->about }}" 
									placeholder="{{ $profileInfo->about }}" maxlength="255">
								</div>
							</div>
						@else
							<div class="form-group row">
								<label for="about" class="col-md-2 edit-profile-label-small">About You</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="about" 
									name="about" placeholder="Tell us something about yourself" maxlength="255">
								</div>
							</div>
						@endif



						    <div class="form-group">        
						      <div class="text-center">
						        <button type="submit" class="btn bn-upload btn-rounded btn-shadow btn-full">Edit Profile</button>
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