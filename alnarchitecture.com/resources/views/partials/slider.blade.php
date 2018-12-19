<section class="home-slider owl-carousel" style="margin-bottom:25px;margin-top:0px;">
  @foreach ($sliders as $key => $slider)
    <a href="{{route('category.detail',$slider->id)}}" class="slider-item" style="background-image: url({{ asset('images/slider/'.$slider->image) }});">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-end justify-content-center">
          <div class="col-md-12 ftco-animate p-4" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{$slider->categories->name}}</h1>
          </div>
        </div>
      </div>
    </a>
  @endforeach
</section>
