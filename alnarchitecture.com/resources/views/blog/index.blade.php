@extends('welcome')
@section('content')
  @include('partials.blogheader')
  <section class="ftco-section " >
       <div class="container">
         <div class="row d-flex">
           @foreach ($blogs as $key => $blog)
             <div class="col-md-6 ftco-animate">
               <div class="blog-entry align-self-stretch d-flex">
                 <a href="{{route('show',$blog->id)}}" class="block-20 order-md-last d-flex justify-content-center align-items-center" style="background-image: url({{ asset('images/blog/'.$blog->image) }});">
                   <div class="icon d-flex justify-content-center align-items-center">
                     <span class="icon-search"></span>
                   </div>
                 </a>
                 <div class="text p-4 d-block">
                   <div class="meta mb-3">
                     <div><a href="#">{{ $blog->created_at }}</a></div>
                     <div><a href="#">Admin</a></div>
                     <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                   </div>
                   <h3 class="heading mt-3"><a href="{{route('show',$blog->id)}}">{{$blog->title}}</a></h3>
                   <p>{{$blog->description}}</p>
                   <p><a href="{{route('show',$blog->id)}}" class="btn btn-outline-primary">Read more</a></p>
                 </div>
               </div>
             </div>
           @endforeach
         </div>
         <div class="row mt-5">
           <div class="col text-center">
             <div class="block-27">
               <ul>
                 <li><a href="#">&lt;</a></li>
                 <li class="active"><span>1</span></li>
                 <li><a href="#">2</a></li>
                 <li><a href="#">3</a></li>
                 <li><a href="#">4</a></li>
                 <li><a href="#">5</a></li>
                 <li><a href="#">&gt;</a></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>

@endsection
