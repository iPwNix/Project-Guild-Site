@extends('layouts.app')

@section('content')


	<!-- wrapper -->
	<div id="wrapper">	


		<section class="padding-bottom-60">
			<div class="container">
		
				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">Accepting
					</h4>
				</div>

				<div class="panel panel-default margin-bottom-30 edit-profile-panel">
					<div class="panel-body">
						<div class="row inpanel-heading-row">
						<div class="col-xs-12 inpanel-heading-col">
							<p>
							Are you sure you want to decline 
							<strong>
								{{$usersName[0]->username}}'s
							</strong> application? 
							</p>
						</div>
						</div>
						<div class="row inpanel-button-row">
							<div class="col-xs-12 inpanel-button-col">
								<form action="/application/{{$applytoDecline[0]->id}}/decline" method="POST">
								{{ csrf_field() }}
								{{ method_field('PATCH') }}
								<button class="btn btnDeleteChar btn-banUser btn-banUserPanel">Decline</button>
								</form>
							</div>
						</div>
					
					</div>
				</div>
				
			</div>
		</section>

	</div>
	<!-- /#wrapper -->


@endsection