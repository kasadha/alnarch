@extends('welcome')
@section('content')
  @include('partials.nav')
  @include('partials.contactheader')
  <section class="ftco-section contact-section">
       <div class="container mt-5">
         @foreach ($contactheaders as $key => $contactheader)
           <div class="row d-flex mb-5 contact-info">
             <div class="col-md-12 mb-4">
               <h2 class="h4">Contact Information</h2>
             </div>
             <div class="w-100"></div>
             <div class="col-md-3">
               <p><span>Address:</span> {{$contactheader->address}}</p>
             </div>
             <div class="col-md-3">
               <p><span>Phone:</span> <a>{{$contactheader->phone}}</a></p>
             </div>
             <div class="col-md-3">
               <p><span>Email:</span> <a href="{{$contactheader->email}}">{{$contactheader->email}}</a></p>
             </div>

           </div>
         @endforeach
           @include('layouts.partials.msg')
         <div class="row block-9">
           <div class="col-md-6 pr-md-5">
             <form action="{{route('send')}}" method="post">
                @csrf
               <div class="form-group">
                 <input name="name" type="text" class="form-control" placeholder="Your Name">
               </div>
               <div class="form-group">
                 <input name="email" type="text" class="form-control" placeholder="Your Email">
               </div>
               <div class="form-group">
                 <input name="phone" type="text" class="form-control" placeholder="Your Phone Number">
               </div>
               <div class="form-group">
                 <input name="subject" type="text" class="form-control" placeholder="Subject">
               </div>
               <div class="form-group">
                 <textarea name="body" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
               </div>
               <div class="form-group">
                 <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
               </div>
             </form>

           </div>
          <!-- <div class="col-md-6" id="map"></div>-->
         </div>
       </div>
     </section>
@endsection
