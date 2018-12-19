<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('images/cover.jpg')}}">
    <div class="logo">
      <a href="arch" class="simple-text logo-normal">
        ALN ARCHITECTURE
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="{{Request::is('arch') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('dashboard')}}">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="{{Request::is('arch/slider') ? 'active': ''}} ">
          <a class="nav-link" href="{{route('slider.index')}} ">
            <i class="material-icons">slideshow</i>
            <p>Slider</p>
          </a>
        </li>
        <li class="{{Request::is('arch/category') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('category.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Categories</p>
          </a>
        </li>
        <li class="{{Request::is('arch/explore') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('explore.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Album</p>
          </a>
        </li>
        <li class="{{Request::is('arch/service') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('service.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Service</p>
          </a>
        </li>
        <li class="{{Request::is('arch/client') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('client.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Clint Comments</p>
          </a>
        </li>
        <li class="{{Request::is('arch/price') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('price.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Price</p>
          </a>
        </li>
        <li class="{{Request::is('arch/team') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('team.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Team</p>
          </a>
        </li>
        <li class="{{Request::is('arch/portfolio') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('portfolio.index')}}">
            <i class="material-icons">slideshow</i>
            <p>Projects</p>
          </a>
        </li>
        <li class="{{Request::is('arch/message') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('message.index')}}">
            <i class="material-icons">message</i>
            <p>Messages</p>
          </a>
        </li>
        <li class="{{Request::is('arch/blog') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('blog.index')}}">
            <i class="material-icons">message</i>
            <p>Blog</p>
          </a>
        </li>
        <li class="{{Request::is('arch/quote') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('quote.index')}}">
            <i class="material-icons">message</i>
            <p>Quote Requests</p>
          </a>
        </li>
        <li class="{{Request::is('arch/homeportfolio') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('homeportfolio.index')}}">
            <i class="material-icons">message</i>
            <p>Home Portfolio</p>
          </a>
        </li>
        <li class="{{Request::is('arch/requestq') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('requestq.index')}}">
            <i class="material-icons">message</i>
            <p>Request </p>
          </a>
        </li>
        <li class="{{Request::is('arch/aboutheader') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('aboutheader.index')}}">
            <i class="material-icons">message</i>
            <p>About Header </p>
          </a>
        </li>
        <li class="{{Request::is('arch/blogheader') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('blogheader.index')}}">
            <i class="material-icons">message</i>
            <p>Blog Header </p>
          </a>
        </li>
        <li class="{{Request::is('arch/contactheader') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('contactheader.index')}}">
            <i class="material-icons">message</i>
            <p>Contact Header </p>
          </a>
        </li>
        <li class="{{Request::is('arch/portfolioheader') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('portfolioheader.index')}}">
            <i class="material-icons">message</i>
            <p>Project Header </p>
          </a>
        </li>
        <li class="{{Request::is('arch/nav') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('nav.index')}}">
            <i class="material-icons">message</i>
            <p>Navigation</p>
          </a>
        </li>
        <li class="{{Request::is('arch/logo') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('logo.index')}}">
            <i class="material-icons">message</i>
            <p>Logo</p>
          </a>
        </li>
        <li class="{{Request::is('arch/commercial') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('commercial.index')}}">
            <i class="material-icons">message</i>
            <p>Commercial building</p>
          </a>
        </li>
        <li class="{{Request::is('arch/education') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('education.index')}}">
            <i class="material-icons">message</i>
            <p>Education building</p>
          </a>
        </li>
        <li class="{{Request::is('arch/civic') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('civic.index')}}">
            <i class="material-icons">message</i>
            <p>Civic building</p>
          </a>
        </li>
        <li class="{{Request::is('arch/medical') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('medical.index')}}">
            <i class="material-icons">message</i>
            <p>Medical building</p>
          </a>
        </li>
        <li class="{{Request::is('arch/agric') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('agric.index')}}">
            <i class="material-icons">message</i>
            <p>Agriculture building</p>
          </a>
        </li>
        <li class="{{Request::is('arch/relig') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('relig.index')}}">
            <i class="material-icons">message</i>
            <p>Religious building</p>
          </a>
        </li>
        <li class="{{Request::is('arch/industrial') ? 'active': ''}} ">
          <a class="nav-link" href="{{ route('industrial.index')}}">
            <i class="material-icons">message</i>
            <p>Industrial building</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
