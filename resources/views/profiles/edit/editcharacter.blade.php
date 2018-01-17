@extends('layouts.app')

@section('content')

	<!-- wrapper -->
	<div id="wrapper">			
		<section class="profile-nav editNavi border-bottom-1 border-grey-300">
			<div class="tab-select editProfTab sticky">
				<div class="container editProfNav">
					<ul class="nav nav-tabs edit-profile-nav-tabs" role="tablist">
						<li><a href="/edit/profile/{{ $user->id }}">
						Edit Profile</a></li>
						<li class="active"><a href="/edit/profile/characters/{{ $user->id }}">
						Edit Characters</a></li>
						<li><a href="/edit/profile/avatar/{{ $user->id }}">Edit Avatar</a></li>
						<li><a href="/edit/profile/cover/{{ $user->id }}">Edit Cover</a></li>
					</ul>
				</div>
			</div>
		</section>

@if($editingMain !== NULL)
	<section class="padding-bottom-60">
		<div class="container">

			<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Editing {{ $user->username }}'s Main
					</h4>
			</div>

			<div class="panel panel-default edit-profile-panel">
				<div class="panel-body">
					<form class="form-label" 
						action="/edit/profile/{{$user->id}}/maincharacter/{{$mainCharacter->id}}" method="POST">

						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<input type="hidden" name="mainCharacterID" value="{{$mainCharacter->id}}">

							<div class="form-group row">
								<label for="charactername" class="col-md-2 edit-profile-label">Character Name</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="charactername" 
									name="charactername" value="{{$mainCharacter->charactername}}" 
									placeholder="{{$mainCharacter->charactername}}"
									maxlength="255">
								@if ($errors->has('charactername'))
                                    <span class="help-block">
                                        <p class="alert alert-danger"><strong>A Character Name is Required</strong></p>
                                    </span>
                                @endif
								</div>
							</div>

							<div class="form-group row">
								<label for="class" class="col-md-2 edit-profile-label-small">Class</label>
								<div class="col-md-10">
									<select class="form-control" id="class" name="class">
								      @foreach($allClasses as $Class)
									    @if($Class->id == $mainCharacter->classID)
										<option value="{{$Class->id}}" selected>{{$Class->className}}</option>
									    @else
									    <option value="{{$Class->id}}">{{$Class->className}}</option>
									    @endif
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="spec" class="col-md-2 edit-profile-label-small">Spec</label>
								<div class="col-md-10">
									<select class="form-control" id="spec" name="spec">
								     @foreach($allSpecs as $Spec)
								      @if($Spec->classID == $mainCharacter->classID)
								      	@if($Spec->id == $mainCharacter->classSpecID)
										<option value="{{$Spec->id}}" selected>{{$Spec->spec}}</option>
										@else
										<option value="{{$Spec->id}}">{{$Spec->spec}}</option>
								      	@endif
								      	@endif
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="role" class="col-md-2 edit-profile-label-small">Role</label>
								<div class="col-md-10">
									<select class="form-control" id="role" name="role">
								      @foreach($allRoles as $Role)
								      	@if($Role->id == $mainCharacter->classRoleID)
										<option value="{{$Role->id}}" selected>{{$Role->classRole}}</option>
									    @else
								      <option value="{{$Role->id}}">{{$Role->classRole}}</option>
								        @endif
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="armoryLink" class="col-md-2 edit-profile-label">Armory Link</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="armoryLink" 
									name="armoryLink" value="{{$mainCharacter->armoryLink}}" 
									placeholder="{{$mainCharacter->armoryLink}}"
									maxlength="255">
								</div>
							</div>

						    <div class="form-group">        
						      <div class="text-center">
						        <button type="submit" class="btn btn-full btn-newsmore">Edit Character</button>
						      </div>
						    </div>

				
						</form>
					</div>
				</div>
			</div>
		</section>
		@else
		
		
	<section class="padding-bottom-60">
		<div class="container">

			<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Editing {{ $user->username }}'s Alt
					</h4>
			</div>

			<div class="panel panel-default edit-profile-panel">
				<div class="panel-body">
					<form class="form-label" 
						action="/edit/profile/{{$user->id}}/altcharacter/{{$altCharacter->id}}" method="POST">

						{{ csrf_field() }}
						{{ method_field('PATCH') }}
	
						<input type="hidden" name="altCharacterID" value="{{$altCharacter->id}}">

							<div class="form-group row">
								<label for="charactername" class="col-md-2 edit-profile-label">Character Name</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="charactername" 
									name="charactername" value="{{$altCharacter->charactername}}" 
									placeholder="{{$altCharacter->charactername}}"
									maxlength="255">
								@if ($errors->has('charactername'))
                                    <span class="help-block">
                                        <p class="alert alert-danger"><strong>A Character Name is Required</strong></p>
                                    </span>
                                @endif
								</div>
							</div>

							<div class="form-group row">
								<label for="class" class="col-md-2 edit-profile-label-small">Class</label>
								<div class="col-md-10">
									<select class="form-control" id="class" name="class">
								      @foreach($allClasses as $Class)
									    @if($Class->id == $altCharacter->classID)
										<option value="{{$Class->id}}" selected>
										{{$Class->className}}</option>
									    @else
									    <option value="{{$Class->id}}">{{$Class->className}}</option>
									    @endif
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="spec" class="col-md-2 edit-profile-label-small">Spec</label>
								<div class="col-md-10">
									<select class="form-control" id="spec" name="spec">
								      @foreach($allSpecs as $Spec)
								      @if($Spec->classID == $altCharacter->classID)
								      	@if($Spec->id == $altCharacter->classSpecID)
										<option value="{{$Spec->id}}" selected>{{$Spec->spec}}</option>
										@else
										<option value="{{$Spec->id}}">{{$Spec->spec}}</option>
								      	@endif
								      	@endif
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="role" class="col-md-2 edit-profile-label-small">Role</label>
								<div class="col-md-10">
									<select class="form-control" id="role" name="role">
								      @foreach($allRoles as $Role)
								      	@if($Role->id == $altCharacter->classRoleID)
										<option value="{{$Role->id}}" selected>{{$Role->classRole}}</option>
									    @else
								      <option value="{{$Role->id}}">{{$Role->classRole}}</option>
								        @endif
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="armoryLink" class="col-md-2 edit-profile-label">Armory Link</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="armoryLink" 
									name="armoryLink" value="{{$altCharacter->armoryLink}}" 
									placeholder="{{$altCharacter->armoryLink}}"
									maxlength="255">
								</div>
							</div>

						    <div class="form-group">        
						      <div class="text-center">
						        <button type="submit" class="btn btn-full btn-newsmore">Edit Character</button>
						      </div>
						    </div>

				
						</form>
					</div>
				</div>
			</div>
		</section>


		@endif
	</div>
	<!-- /#wrapper -->
	<script>
	$(function() {
        $('#class').change(function(){
        	var changedClass = this.value;
        	var specArray = <?php echo json_encode($allSpecs); ?>;
        	//console.log(specArray);
        	//console.log(specArray.length);
        	//console.log(specArray[0]);
             var specbox = $('#spec');
             specbox.empty();
             var list = '';
             for (var j = 0; j < specArray.length; j++){
               if (specArray[j].classID == changedClass) {
               	console.log(specArray[j].spec);
               	list += "<option value='" +specArray[j].id+ "'>" +specArray[j].spec+ "</option>";
               }
             }
             specbox.html(list);
        });
    });
	</script>

@endsection