@extends('template')
@section('site_title', '')
@section('site_meta_desc', '')
@section('site_meta_key', '')

@section('content')

<!-- Blog Section Start -->
<div id="qx-blog" class="rs-blog relative pt-130 pb-130 md-pt-92 md-pb-92">
  <div class="container">
    <div class="sec-title text-center mb-60 md-mb-30">
      <h2 class="title">Blog</h2>
      <p class="margin-0">@if(isset($home)) {{$home}} @endif</p>
    </div>
<div class="row">
      @foreach($posts as $post)
      <div class="col-md-4">
      <div class="item">
        <div class="single-blog-slide">
          <div class="blog-image"> <a href="/blog/{{ $post->slug }}"><img src="{{ Voyager::image( $post->image ) }}" alt=""></a> </div>
          <div class="blog-informations"> <span class="category"><a href="{{route('category',$post->category->id)}}">{{ $post->category->name }}</a></span>
            <h4 class="bl-title"><a href="/blog/{{ $post->slug }}">{{$truncated = Str::limit($post->title, 30, ' ...')}}</a></h4>
          </div>
        </div>
      </div>
      </div>
      @endforeach 
      </div>
      {{$posts->links()}}
  </div>
    <img class="pattern1 rotate1" src="{{ asset('img/blog/pattern1.png') }}" alt="">
    <img class="pattern2 scale2" src="{{ asset('img/blog/pattern2.png') }}" alt="">
    <img class="ball rotate1" src="{{ asset('img/blog/ball.png') }}" alt="">
</div>
<!-- Blog Section End -->


 @endsection