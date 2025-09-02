@extends('master')
@section('body')
    <!-- carousel -->
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          @php
              $carousel_indicator = 0;
          @endphp
          @foreach ($carousel as $item)
              @php
                  $carousel_indicator++;
              @endphp
              <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{$carousel_indicator-1}}" @php
                  if($carousel_indicator==1) {
                    echo "class='active' aria-current='true'";
                  }
              @endphp
              aria-label="Slide {{$carousel_indicator}}"></button>
          @endforeach
        </div>
        <div class="carousel-inner">
            @php
                $carousel_count = 0;
            @endphp
            @foreach ($carousel as $item)
                @php
                    $carousel_count++;
                @endphp
                <div class="carousel-item @php if($carousel_count==1) { echo 'active';} @endphp">
                    <img src="image/carousel/{{$item->image}}" class="img-responsive">
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>{{$item->title}}</h1>
                            <p class="text-white">{{$item->describe}}</p>
                            <p><a class="btn btn-lg btn-primary" href="{{$item->link}}">Visit It</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end carousel -->

    <!-- Marketing messaging and featurettes
          ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row my-4">
            <div class="col-lg-4">
                <img src='img/first.jpeg' class="bd-placeholder-img img-responsive body-image-align">
                <h2 class="fw-normal">Heading</h2>
                <p>Some representative placeholder content for the three columns of text below the carousel. This is the
                    first column.</p>
                <p class="d-flex justify-content-center"><a class="btn btn-secondary" href="#">View details
                        &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src='img/first.jpeg' class="bd-placeholder-img img-responsive body-image-align">
                <h2 class="fw-normal">Heading</h2>
                <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second
                    column.</p>
                <p class="d-flex justify-content-center"><a class="btn btn-secondary" href="#">View details
                        &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src='img/first.jpeg' class="bd-placeholder-img img-responsive body-image-align">
                <h2 class="fw-normal">Heading</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p class="d-flex justify-content-center"><a class="btn btn-secondary" href="#">View details
                        &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src='img/first.jpeg' class="bd-placeholder-img img-responsive body-image-align">
                <h2 class="fw-normal">Heading</h2>
                <p>Some representative placeholder content for the three columns of text below the carousel. This is the
                    first column.</p>
                <p class="d-flex justify-content-center"><a class="btn btn-secondary" href="#">View details
                        &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src='img/first.jpeg' class="bd-placeholder-img img-responsive body-image-align">
                <h2 class="fw-normal">Heading</h2>
                <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second
                    column.</p>
                <p class="d-flex justify-content-center"><a class="btn btn-secondary" href="#">View details
                        &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src='img/first.jpeg' class="bd-placeholder-img img-responsive body-image-align">
                <h2 class="fw-normal">Heading</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p class="d-flex justify-content-center"><a class="btn btn-secondary" href="#">View details
                        &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                        class="text-body-secondary">It’ll blow your mind.</span></h2>
                <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose
                    here.</p>
            </div>
            <div class="col-md-5">
                <img src="img/first.jpeg"
                    class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span
                        class="text-body-secondary">See for yourself.</span></h2>
                <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how
                    this layout would work with some actual real-world content in place.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img src="img/first.jpeg"
                    class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span
                        class="text-body-secondary">Checkmate.</span></h2>
                <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really
                    intended to be actually read, simply here to give you a better view of what this would look like with
                    some actual content. Your content.</p>
            </div>
            <div class="col-md-5">
                <img src="img/first.jpeg"
                    class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                    height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->
    <!-- end body -->
@endsection
