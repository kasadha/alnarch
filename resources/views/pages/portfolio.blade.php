@extends('welcome')
@section('content')
  @include('partials.portfolioheader')
  <section class="ftco-section">
	    	<div class="container">
          <div class="row">
		    	@foreach ($portfolios as $key => $portfolio)
						<div class="col-md-4">
							<a href="{{route('portfolio.detail',$portfolio->id)}}" class="portfolio ftco-animate">
								<div class="d-flex icon justify-content-center align-items-center">
									<span class="ion-md-search"></span>
								</div>
								<div class="d-flex heading align-items-end">
									<h3>
										<span>{{$portfolio->services->service}}</span><br>

									</h3>
								</div>
								<img style="width:100%;height:350px" src="{{ asset('images/portfolio/'.$portfolio->image) }}" class="img-fluid" alt="Colorlib Template">
							</a>
						</div>
		    	@endforeach
		    	</div>
		    	<div class="row mt-5">
	          <div class="col text-center">
	            <div class="block-27">
	              <ul>

	              </ul>
	            </div>
	          </div>
	        </div>
	    	</div>
	    </section>
@endsection
