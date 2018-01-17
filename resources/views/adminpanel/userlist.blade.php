@extends('layouts.app')

@section('content')


	<!-- wrapper -->
	<div id="wrapper">	


		<section class="padding-bottom-60">
			<div class="container">
		
				<div class="headline edit-profile-headline">
					<h4 class="no-padding-top">All Users
					</h4>
				</div>

				<div class="panel panel-default margin-bottom-30 edit-profile-panel">
					<div class="panel-body">

					<div class="table-responsive">          
						  <table class="table edit-profile-table userList-table">
						    <tbody>
						@for ($i = 0; $i < count($allUsers); $i++)
						      <tr>
						        <td class="userList-imgtd hidden-xs"> 
						    <a href="/profile/{{ $allUsers[$i]->id }}">
						     <img src="/uploads/avatars/{{ $allUsers[$i]->useravatar}}" alt="" class="userList-img">
						    </a>
						        </td>
						        <td class="userList-username">
						        <span>{{ $allUsers[$i]->username }}</span>
						        </td>
						        <td>
						       <a href="/profile/{{ $allUsers[$i]->id }}" class="btn btn-toArmory btn-toProfile" role="button">Profile</a>
						        </td>
						        <td class="banbuttons">
							        <a href="/adminpanel/user/rank/{{ $allUsers[$i]->id }}" class="btn btn-rankchange btn-banUser">
							        	Change Rank
							        </a>
						        </td>
						        <td class="banbuttons">
							        <a href="/adminpanel/user/ban/{{ $allUsers[$i]->id }}" class="btn btnDeleteChar btn-banUser">
							        	Ban User
							        </a>
						        </td>

						        <td class="banbuttons">
							        <a href="/adminpanel/user/unban/{{ $allUsers[$i]->id }}" class="btn btn-editChar btn-banUser">
							        	Unban User
							        </a>
						        </td>
						      </tr>
						@endfor
						    </tbody>
						  </table>
						  </div>




	{!! with(new App\Pagination\HDPresenter($allUsers))->render(); !!}
					</div>
				</div>
				
			</div>
		</section>

	</div>
	<!-- /#wrapper -->


@endsection