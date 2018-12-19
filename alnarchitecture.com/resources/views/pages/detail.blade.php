@extends('welcome')
@section('content')
<section class="ftco-section ftco-degree-bg">
	      <div class="container">
	        <div class="row" style="margin-top:300px;">
	          <div class="col-md-8 ftco-animate">
	            <h2 class="mb-3">{{$slider->categories->name}}</h2>
	            <p>
	              <img src="{{ asset('images/slider/'.$slider->image) }}" alt="" class="img-fluid">
	            </p>
	            <p>{{$slider->description}}</p>
	            <h2 class="mb-3 mt-5">{{$slider->categories->name}}</h2>

				 <div class="row">
					 @foreach ($civics as $key => $civic)
						 <div class="col-md-4" >
							<a href="" class="portfolio ftco-animate">
								<img src="{{ asset('images/civic/'.$civic->image) }}" class="img-fluid" alt="Colorlib Template" style="width:100%;height:390px;">
							</a>
						</div>
					 @endforeach
				 </div>
	          </div> <!-- .col-md-8 -->
	        </div>
	      </div>
	    </section>
@endsection
