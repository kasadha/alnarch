<nav id="colorlib-main-nav" class="border " role="navigation">
  <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle active"><i></i></a>
  <div class="js-fullheight colorlib-table">
    @foreach ($navs as $key => $nav)
      <div class="img" style="background-image: url({{ asset('images/nav/'.$nav->image) }});"></div>
    @endforeach
    <div class="colorlib-table-cell js-fullheight  ">
      <div class="row no-gutters ">
        <div class="col-md-12 ">
          @foreach ($logos as $key => $logo)
            <h1 class="mb-4"><a href="/" >
              <img class="img-responsive " src="{{ asset('images/logo/'.$logo->image) }}" style="height: 100px; width: 100px" alt="">
            </a></h1>
          @endforeach
          <ul>
            <li><a href="/"><span><small>01</small>Home</span></a></li>
            <li><a href="/about"><span><small>02</small>About</span></a></li>
            <li><a href="/service"><span><small>03</small>Services</span></a></li>
            <li><a href="/prices"><span><small>04</small>Pricing</span></a></li>
            <li><a href="/portfolio"><span><small>05</small>Projects</span></a></li>
            <li><a href="/blog"><span><small>06</small>Blog</span></a></li>
            <li><a href="/contact"><span><small>07</small>Contact</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<div id="colorlib-page">
@foreach ($logos as $key => $logo)
  <header class="sticky-top" style="background-color:rgba(255,255,255,0.5)">
    <div class="colorlib-navbar-brand text-center">
      <a  href="/">
        <img class="img-responsive sticky-top" src="{{ asset('images/logo/'.$logo->image) }}" style="height: 100px; width: 100px" alt="">
</a>
    </div>
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
  </header>
  <hr class="style-four">
@endforeach
