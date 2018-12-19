<section class="ftco-quote ftco-animate">
     @foreach ($requestqs as $key => $requestq)
          <div class="container">
            <div class="row d-flex justify-content-end">
              <div class="col-md-7 req-quote d-md-flex py-5 align-items-center img" style="background-image: url({{ asset('images/requestq/'.$requestq->image) }});">
                <h3 class=" ml-md-3">{{$requestq->title}}</h3>
                <p><a href="#" class="btn btn-white py-4 px-4" data-toggle="modal" data-target="#modalRequest">{{$requestq->btn_title}}</a></p>
              </div>
            </div>
          </div>
     @endforeach
     </section>
