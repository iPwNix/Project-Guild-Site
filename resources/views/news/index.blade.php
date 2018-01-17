@extends('layouts.app')

@section('content')
	<!-- wrapper -->
	<div id="wrapper">			
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
    @foreach ($newsarticles as $newsarticle)
       				   <div class="post post-lg news-post-lg">
							<div class="post-header post-author news-post-header">
								<a href="/profile/{{ $newsarticle->postedBy }}" class="author" data-toggle="tooltip" title="{{ $newsarticle->getPostedBy() }}"><img src="/uploads/avatars/{{ $newsarticle->getPostedByAvatar() }}" alt="" /></a>
								<div class="post-title">
									<h2 class="newsTitle"><a href="news/{{ $newsarticle->id }}">{{ $newsarticle->title }}</a></h2>
									<ul class="post-meta post-info">
										<li><a href="/profile/{{ $newsarticle->postedBy }}"><i class="fa fa-user"></i>
										{{ $newsarticle->getPostedBy() }}</a></li>
										<li><i class="fa fa-calendar-o"></i> 
										{{ $newsarticle->created_at }}</li>
									</ul>
								</div>
							</div>
							<div class="post-thumbnail">
								<a href="news/{{ $newsarticle->id }}"><img src="uploads/articles/imgnewsimages/{{ $newsarticle->newsImage }}" alt=""></a>
								<div class="post-caption post-catagory">{{$newsarticle->getCatagory()}}</div>
							</div>
							<!-- <p>{!! str_limit($newsarticle->content, 150) !!}</p> -->
						</div>
    @endforeach


	
	{!! with(new App\Pagination\HDPresenter($newsarticles))->render(); !!}


				  </div>
				</div>
			</div>
		</section>
	</div>
<!-- /#wrapper -->
	@endsection
