@foreach ($aboutheaders as $key => $aboutheader)
<section class="hero-wrap" style="background-image: url({{ asset('images/about/'.$aboutheader->image) }}); margin:35px;">
  <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters text align-items-end justify-content-center" data-scrollax-parent="true">
        <div class="col-md-8 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
          <h1 class="mb-5 bread">About Us</h1>
        </div>
      </div>
    </div>
</section>
@endforeach
