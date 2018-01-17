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

	<section class="padding-bottom-60">

		<div class="container">
			<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Adding Character for {{ $user->username }}
					</h4>
				</div>

			<div class="panel panel-default edit-profile-panel">
				<div class="panel-body">
					<form class="form-label" 
						enctype="multipart/form-data"
						 action="/add/altcharacter/{{ $user->id }}" method="POST" autocomplete="off">

						{{ csrf_field() }}
	

							<div class="form-group row">
								<label for="charactername" class="col-md-2 edit-profile-label">Character Name</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="charactername" 
									name="charactername" value="" 
									placeholder="Character Name (Silvermoon EU Only)"
									maxlength="255">
								@if ($errors->has('charactername'))
                                    <span class="help-block">
                                        <p class="alert alert-danger"><strong>A Character Name is Required</strong></p>
                                    </span>
                                @endif
								</div>
							</div>

							<div class="form-group row">
								<label for="class" class="col-md-2 edit-profile-label">Class</label>
								<div class="col-md-10">
									<select class="form-control" id="class" name="class">
								      @foreach($allClasses as $Class)
									    <option value="{{$Class->id}}">{{$Class->className}}</option>
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="spec" class="col-md-2 edit-profile-label">Spec</label>
								<div class="col-md-10">
									<select class="form-control" id="spec" name="spec">
								     @foreach($allSpecs as $Spec)
										<option value="{{$Spec->id}}">{{$Spec->spec}}</option>
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="role" class="col-md-2 edit-profile-label">Role</label>
								<div class="col-md-10">
									<select class="form-control" id="role" name="role">
								      @foreach($allRoles as $Role)
								      <option value="{{$Role->id}}">{{$Role->classRole}}</option>
								      @endforeach
							         </select>
								</div>
							</div>

							<div class="form-group row">
								<label for="armoryLink" class="col-md-2 edit-profile-label">Armory Link</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="armoryLink" 
									name="armoryLink" value="" 
									placeholder="Full Link to the Armory"
									maxlength="255">
								</div>
							</div>

						    <div class="form-group">        
						      <div class="text-center">
						        <button type="submit" class="btn btn-full btn-newsmore">Add Character</button>
						      </div>
						    </div>

				
						</form>
					</div>
				</div>
			</div>
		</section>

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
        $("select#class").val(1).trigger('change');
    });
	</script>

@endsection