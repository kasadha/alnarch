@extends('welcome')
@section('content')

    @include('partials.slider')
      @include('layouts.partials.msg')

  <section class="ftco-services">
    <div class="row">
        <div class="col-md-12 heading-section ftco-animate mb-3">
            <h2 class="mb-4" >Services</h2>
          </div>
        </div>
   <div class="row">
   @foreach ($services as $key => $service)
     <div class="col-md-4">
       <a href="portfolio" class="portfolio ftco-animate">
         <div class="d-flex icon justify-content-center align-items-center">
           <span class="ion-md-search"></span>
         </div>
         <div class="d-flex heading align-items-end">
           <h3>
             <span>{{$service->service}}</span><br>

           </h3>
         </div>
         <img src="{{ asset('images/service/'.$service->image) }}" class="img-fluid" alt="Colorlib Template" style="width:100%;height:390px;">
       </a>
     </div>
   @endforeach
   </div>
    </section>

  @include('partials.quote')
  <section class="ftco-section">
    <div class="container">
      <div class="row">
          <div class="col-md-12 heading-section ftco-animate mb-3">
              <h2 class="mb-4" style="color:white;">Projects</h2>
            </div>
          </div>
      <div class="row">
      @foreach ($homeportfolios as $key => $homeportfolio)
        <div class="col-md-4">
          <a href="portfolio" class="portfolio ftco-animate">
            <div class="d-flex icon justify-content-center align-items-center">
              <span class="ion-md-search"></span>
            </div>
            <div class="d-flex heading align-items-end">
              <h3>
                <span>{{$homeportfolio->services->service}}</span><br>

              </h3>
            </div>
            <img src="{{ asset('images/homeportfolio/'.$homeportfolio->image) }}" class="img-fluid" alt="Colorlib Template" style="width:100%;height:390px;">
          </a>
        </div>
      @endforeach
      </div>
    </div>
  </section>
  @include('partials.clientsay')
@endsection
