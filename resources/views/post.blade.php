@extends('template')
@section('site_title', $post->title)
@section('site_meta_desc', $post->meta_description)
@section('site_meta_key', $post->meta_keywords)

@section('content') 

<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs pt-200 pb-62" style="background-image:url({{ Voyager::image( $post->image ) }})">
  <div class="breadcrumbs-wrap mt-30">
    <div class="breadcrumbs-inner">
      <div class="container">
        <div class="breadcrumbs-text">
          <div class="breadcrumbs-bar">
            <h1 class="breadcrumbs-title mb-0">{{ $post->title }}</h1>
          </div>
          <div class="rs-blog-breadcrumbs-inner">
            <div class="blog-author-info">
              <div class="author-img"> <a href="#"><img src="{{ asset("storage") }}/{{ $post->author->avatar }}" alt=""></a> </div>
              <div class="author-details">
                <h5 class="name">{{ $post->author->name }}</h5>
                <span class="des">Autor</span>
              </div>
            </div>
            <div class="blog-author-info">
              <div class="author-details pl-42 sm-pl-18 xs-pl-0">
                <h5 class="name">Categoría</h5>
                <span class="des"><a href="{{route('category',$post->category->id)}}">{{ $post->category->name }}</a></span>
              </div>
            </div>
            <div class="blog-author-info">
              <div class="author-details pl-42 sm-pl-18 xs-pl-0">
                <h5 class="name">Publicado</h5>
                <span class="des">{{ date( "d M, Y", strtotime($post->created_at)) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="shade"></div>
</div>
<!-- Breadcrumbs End --> 

<!-- Blog Details Section Start -->
<div class="rs-blog blog-details pt-130 pb-130 md-pt-100 md-pb-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 pr-45 md-pr-15 md-mb-50">
        <div class="blog-content"> {!! $post->body !!} 
          <!-- <div class="tags mb-60"> <span>Tag:</span> <a href="#">Blog</a> <a href="#">Creative</a> <a href="#">Business</a> <a href="#">Theme</a> </div>--> 
          <a href="#" class="post-author">
          <div class="avatar"> <img src="{{ asset("storage") }}/{{ $post->author->avatar }}" alt=""> </div>
          <div class="info">
            <h4 class="name">{{ $post->author->name }}</h4>
            <span class="designation">Autor</span> </div>
          </a> 
         </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar">
          <div class="search-wrap common mb-50">
            <form method="POST" action="{{route('search')}}">
              @csrf
              <input type="search" placeholder="Buscar ..." name="search" class="search-input" required="">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="recent-post common mb-50">
            <h4 class="widget-title mb-20">Más Artículos</h4>
            @foreach($posts->slice(0, 8) as $post)
            <div class="recent-post-widget">
              <div class="post-img"> <img src="{{ Voyager::image( $post->image ) }}" alt=""> </div>
              <div class="post-desc"> <a href="/blog/{{ $post->slug }}">{{$truncated = Str::limit($post->title, 30, ' ...')}}</a> <span class="date">{{ date( "d M, Y", strtotime($post->created_at)) }}</span> </div>
            </div>
            @endforeach 
          </div>
          <div class="categories common">
            <h4 class="widget-title mb-20">Categorías</h4>
            @foreach($categories->slice(0, 8) as $category)
            <ul>
              <li><a href="{{route('category',$category->id)}}">{{ $category->name }}</a></li>
            </ul>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Blog Details Section End --> 

@endsection 