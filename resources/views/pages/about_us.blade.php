
@extends('welcome')
  @section('content')
		<div class="page">
					@include('partials.aboutheader')
			<!-- END slider -->
      @include('partials.clientsay')
		  @include('partials.quote')
			<section class="ftco-section">
				<div class="container">
					<div class="row justify-content-center mb-5 pb-5">
						<div class="col-md-7 text-center heading-section ftco-animate">
							<h2 class="mb-4">Our Team</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
						</div>
					</div>
					<div class="row" >
					@foreach ($teams as $key => $team)
						<div class="col-md-4 mb-5 ftco-animate" >
							<div class="block-10" >
								<div class="person-info mb-2" >
									<span class="name">{{$team->name}}</span>
									<span class="position">{{$team->occupation}}</span>
								</div>
								<img src="{{ asset('images/team/'.$team->image) }}" alt="" class="img-fluid mb-3" style="width:250px;height:250px;">
								<p>{{$team->comment}}</p>
							</div>
						</div>
					@endforeach
					</div>
				</div>
			</section>

  @endsection
