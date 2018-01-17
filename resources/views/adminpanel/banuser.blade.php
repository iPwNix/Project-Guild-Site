@extends('layouts.app')

@section('content')


	<!-- wrapper -->
	<div id="wrapper">	


		<section class="padding-bottom-60">
			<div class="container">
		
				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Banning
					</h4>
				</div>

				<div class="panel panel-default margin-bottom-30 edit-profile-panel">
					<div class="panel-body">
						<div class="row inpanel-heading-row">
						<div class="col-xs-12 inpanel-heading-col">
							<p>
							Are you sure you want to Ban 
							<strong>{{$userToBan->username}}</strong>
							?
							</p>
						</div>
						</div>
						<div class="row inpanel-button-row">
						<div class="row inpanel-button-row">
							<div class="col-xs-12 inpanel-button-col">
								<form action="/adminpanel/user/ban/{{ $userToBan->id }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PATCH') }}
								<button class="btn btnDeleteChar btn-banUser btn-banUserPanel">Ban {{$userToBan->username}}</button>
								</form>
							</div>
						</div>
						</div>
					
					</div>
				</div>
				
			</div>
		</section>

	</div>
	<!-- /#wrapper -->


@endsection