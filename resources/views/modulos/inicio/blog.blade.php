<!-- Blog Section Start -->
<div id="qx-blog" class="rs-blog relative pt-130 pb-130 md-pt-92 md-pb-92">
  <div class="container">
    <div class="sec-title text-center mb-60 md-mb-30">
      <h2 class="title">Últimas noticias</h2>
      <p class="margin-0">Mantente al tanto de nuestro <br>
        Blog</p>
    </div>
    
    <!-- Blog Details Section Start -->
    <div class="rs-blog blog-details md-pt-100 md-pb-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 pr-45 md-pr-15 md-mb-50">
            <div class="blog-content">
              <div class="sidebar"> @foreach($posts as $post)
                <div class="search-wrap common mb-50">
                  <div class="single-blog-slide">
                    <div class="blog-image"> <a href="/blog/{{ $post->slug }}"><img src="{{ Voyager::image( $post->image ) }}" alt=""></a> </div>
                    <div class="blog-informations"> <span class="category"><a href="{{route('category',$post->category->id)}}">{{ $post->category->name }}</a></span>
                      <ul class="post-metadatas list-inline">
                        <li><i class="fa fa-clock-o"></i> {{ date( "d M, Y", strtotime($post->created_at)) }}</li>
                        <li><i class="fa fa-comments-o"></i> <a href="/blog/{{ $post->slug }}">{{ $post->author->name }}</a></li>
                      </ul>
                      <h4 class="bl-title"><a href="/blog/{{ $post->slug }}">{{$truncated = Str::limit($post->title, 30, ' ...')}}</a></h4>
                      <p class="bl-title"><a href="/blog/{{ $post->slug }}">{{$truncated = Str::limit($post->excerpt, 70, ' ...')}}</a></p>
                    </div>
                  </div>
                </div>
                @endforeach </div>
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
                @endforeach </div>
              <div class="categories common">
                <h4 class="widget-title mb-20">Categorías</h4>
                @foreach($categories->slice(0, 8) as $category)
                <ul>
                  <li><a href="{{route('category',$category->id)}}">{{ $category->name }}</a></li>
                </ul>
                @endforeach </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Blog Details Section End --> 
    
  </div>
  <img class="pattern1 rotate1" src="{{ asset('img/blog/pattern1.png') }}" alt=""> <img class="pattern2 scale2" src="{{ asset('img/blog/pattern2.png') }}" alt=""> <img class="ball rotate1" src="{{ asset('img/blog/ball.png') }}" alt=""> </div>
<!-- Blog Section End -->