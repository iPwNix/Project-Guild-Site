@extends('layouts.app')

@section('content')


	<!-- wrapper -->
	<div id="wrapper">	

		<section class="profile-nav editNavi border-bottom-1 border-grey-300">
			<div class="tab-select editProfTab sticky">
				<div class="container editProfNav">
					<ul class="nav nav-tabs edit-profile-nav-tabs" role="tablist">
						<li><a href="/edit/profile/{{ $user->id }}">Edit Profile</a></li>
						<li class="active"><a href="/edit/profile/characters/{{ $user->id }}" onclick="return false">
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
					<h4 class="no-padding-top">Editing {{ $user->username }}'s Characters
					</h4>
				</div>

				<div class="panel panel-default margin-bottom-30 edit-profile-panel">
					<div class="panel-body">

						<h1 class="edit-profile-title">Main</h1>
						<!-- MAIN CHARACTER -->
					<div class="table-responsive">          
					  <table class="table table edit-profile-table">
					    <thead>
					      <tr class="edit-profile-tr">
					        <th class="edit-profile-th">Name</th>
					        <th class="edit-profile-th">Class</th>
					        <th class="edit-profile-th">Armory</th>
					        <th class="edit-profile-th">Edit</th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td style="color: {{ $mainCharacter->getClassColor() }}"
					        class="edit-profile-charname">{{ $mainCharacter->charactername }}</td>
					        <td style="color: {{ $mainCharacter->getClassColor() }}"
					        class="edit-profile-charclass">{{ $mainCharacter->getClass() }}</td>
					        <td class="edit-profile-td">
					        <a href="{{ $mainCharacter->armoryLink }}" class="btn btn-toArmory" role="button" target="_blank">To Armory</a>
					        </td>
							<td class="edit-profile-td"><a href="/edit/profile/{{ $user->id }}/maincharacter/{{ $mainCharacter->id }}" 
							class="btn btn-editChar" role="button">Edit</a>
							</td>
					      </tr>
					    </tbody>
					  </table>
					  </div>
						  <!-- MAIN CHARACTER -->

						<h2 class="edit-profile-title">Alts</h2>
						<a href="/add/altcharacter/{{ $user->id }}" 
							class="btn btn-full addAltButton" role="button">Add Alt</a>
						  <!-- ALTS -->
						<div class="table-responsive">          
						  <table class="table edit-profile-table">
						    <thead>
						      <tr class="edit-profile-tr">
						        <th class="edit-profile-th">Name</th>
						        <th class="edit-profile-th">Class</th>
						        <th class="edit-profile-th">Armory</th>
						        <th class="edit-profile-th">Edit</th>
						        <th class="edit-profile-th">Delete</th>
						      </tr>
						    </thead>
						    <tbody>
						@for ($i = 0; $i < count($altCharacters); $i++)
						      <tr>
						        <td style="color: {{ $altCharacters[$i]->getClassColor() }}" 
						        class="edit-profile-charname">
						        {{$altCharacters[$i]->charactername}}
						        </td>
						        <td style="color: {{ $altCharacters[$i]->getClassColor() }}"
						        class="edit-profile-charclass">
						        {{$altCharacters[$i]->getClass()}}
						        </td>
						        <td class="edit-profile-td">
						        <a href="{{ $altCharacters[$i]->armoryLink }}" class="btn btn-toArmory" role="button" target="_blank">To Armory</a>
						        </td>
						        <td class="edit-profile-td">
						        <a href="/edit/profile/{{ $user->id }}/altcharacter/{{ $altCharacters[$i]->id }}" 
						        class="btn btn-editChar" role="button">Edit Alt</a>
						        </td>
						        <td class="edit-profile-td">
			        <form action="/edit/profile/{{$user->id}}/deletecharacter/{{$altCharacters[$i]->id}}" method="POST">
			            {{ csrf_field() }}
			            {{ method_field('DELETE') }}

			            <button class="btn btnDeleteChar">Delete Alt</button>
			        </form>
						      </tr>
						@endfor
						    </tbody>
						  </table>
						  </div>
						  <!-- ALTS -->
					</div>
				</div>
				
			</div>
		</section>

	</div>
	<!-- /#wrapper -->


@endsection