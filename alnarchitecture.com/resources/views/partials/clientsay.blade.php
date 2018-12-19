<section class="testimony-section">
  <div class="row">
      <div class="col-md-12 heading-section ftco-animate mb-3">
          <h2 class="mb-4" >Message from our clients</h2>
        </div>
      </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 first-order ftco-animate">
        <div class="carousel-testimony owl-carousel">
          @foreach ($clients as $key => $client)
            <div class="item">
              <div class="testimony-wrap text-center">
                <div class="user-img mb-5" style="background-image: url({{ asset('images/client/'.$client->image) }})">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text">
                  <p class="mb-5">{{$client->comment}}</p>
                  <p class="name">{{$client->name}}</p>
                  <span class="position">{{$client->occupation}}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
