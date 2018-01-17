@extends('layouts.app')

@section('content')
		

	<!-- wrapper -->
	<div id="wrapper">	


		<section class="padding-bottom-60">
			<div class="container">
		
				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Changing Rank
					</h4>
				</div>

	<div class="panel panel-default edit-profile-panel">
					<div class="panel-body">

						<div class="row inpanel-heading-row">
						<div class="col-xs-12 inpanel-heading-col">
							<p>
							Assigning Rank to 
							<strong>{{$userToChange->username}}</strong>
							</p>
						</div>
						</div>

						<form class="form-label" enctype="multipart/form-data"
						 action="/adminpanel/user/rank/{{ $userToChange->id }}" method="POST" autocomplete="off">
						 
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">
						  {{ method_field('PATCH') }}


							<div class="form-group row">
								<label class="col-md-2 edit-profile-label edit-rank-label" for="rank">Rank</label>
								<div class="col-md-10">
										<!-- Rounded switch -->
									<select name="rank" id="rank" class="ranksDropdown" required>
										@foreach($allRanks as $ranks)
											@if($ranks->id === 1 || 
											   $ranks->id === 8 || 
											   $ranks->id === 9)
											@else
										<option value="{{ $ranks->id }}">
											{{ $ranks->role }}
										</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group row">        
						      <div class="text-center">
						        <button type="submit" class="btn btn-full btn-newsmore">Change Rank</button>
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