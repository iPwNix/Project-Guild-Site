@extends('layouts.app')

@section('content')

    <div id="wrapper">  
        <section class="padding-bottom-60">
            <div class="container">
                <div class="panel panel-default margin-bottom-30 edit-profile-panel">
                    <div class="panel-body">
                    <div class="row inpanel-heading-row">
                    <div class="col-xs-12 inpanel-heading-col">
                            <p>Applications</p>
                    </div>
                    </div>



                    <div class="table-responsive">          
                      <table class="table edit-profile-table userList-table">
                        <thead>
                          <tr>
                            <th class="edit-profile-th">Name</th>
                            <th class="edit-profile-th">Class</th>
                            <th class="edit-profile-th">Spec</th>
                            <th class="edit-profile-th">Date</th>
                            <th class="edit-profile-th">Status</th>
                            <th class="edit-profile-th">Show</th>
                          </tr>
                        </thead>
                        <tbody>
                        @for ($i = 0; $i < count($allApplications); $i++)
                          <tr>
                            <td class="edit-profile-charname">
                                <span style="color: {{$allApplications[$i]->getClassColor()}}">{{$allApplications[$i]->questionFive}}
                                </span>
                            </td>
                            <td class="edit-profile-charclass">
                                <span style="color: {{$allApplications[$i]->getClassColor()}}">
                                {{$allApplications[$i]->getClass()}}
                                </span>
                            </td>
                            <td class="edit-profile-charclass">
                                <span style="color: {{$allApplications[$i]->getClassColor()}}">
                                    {{$allApplications[$i]->getSpec()}}
                                </span>
                            </td>
                            <td class="applylist-created">
                                <span>
                                    {{$allApplications[$i]->created_at}}
                                </span>
                            </td>
                            <td class="applylist-status">
                                <span style="color: {{$allApplications[$i]->getStatusColor()}}">
                                {{$allApplications[$i]->getStatus()}}
                                </span>
                            </td>
                            <td>
                                <a href="application/{{$allApplications[$i]->id}}" 
                                class="btn btn-toArmory btn-toProfile" role="button" role="button" target="_blank">Show</a>
                            </td>
                          </tr>
                        @endfor
                        </tbody>
                      </table>
                      </div>
{!! with(new App\Pagination\HDPresenter($allApplications))->render(); !!}
                </div>
                
            </div>
        </div>
        </section>
    </div>
    
@endsection
