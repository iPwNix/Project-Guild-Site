@extends('layouts.app')

@section('content')
	<!-- wrapper -->
	<div id="wrapper">	
        <section class="hero hero-parallax height-450 parallax" style="background-image: url('/uploads/articles/imgnewscovers/{{ $Newsarticle->newsCover }}');">
        </section>
		<section class="padding-top-50 padding-bottom-50">
			<div class="container news-article-container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 news-article-col">
						<div class="post post-single">
							<div class="post-header post-author news-post-header">
								<a href="/profile/{{ $Newsarticle->postedBy }}" class="author" data-toggle="tooltip" title="{{ $Newsarticle->getPostedBy() }}"><img src="/uploads/avatars/{{ $Newsarticle->getPostedByAvatar() }}" alt="" /></a>
								<div class="post-title">
									<h2 class="post-newsTitle">{{ $Newsarticle->title }}</h2>
									<ul class="post-meta post-info">
										<li><a href="/profile/{{ $Newsarticle->postedBy }}"><i class="fa fa-user"></i>
										{{ $Newsarticle->getPostedBy() }}</a></li>
										<li><i class="fa fa-calendar-o"></i>
										{{ $Newsarticle->created_at }}</li>
									</ul>
								</div>
							</div>
							
							<div class="newsPost">
								{!! $Newsarticle->content !!}
							</div>
								
						</div>
				@if(Auth::user()->siteRole == "5" ||
                    Auth::user()->siteRole == "6" ||
                    Auth::user()->siteRole == "7")
				 <a href="/edit/newsarticle/{{ $Newsarticle->id }}" class="btn btn-warning btn-full" data-toggle="tooltip" title="Edit News">
                 <i class="fa fa-cog circle-btn-fa-heading"></i>
                 </a>
                @endif
					</div>
				</div>

			</div>
		</section>
	</div>
	<!-- /#wrapper -->
@endsection