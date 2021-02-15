@extends('layouts.master')
@section('content')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Portolio</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Portolio</li>
                </ol>
            </div>

        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="row aos-init aos-animate" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container aos-init aos-animate" data-aos="fade-up" style="position: relative; height: 1080.36px;">
                @foreach($images as $img)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app" style="position: absolute; left: 0px; top: 0px;">
                    <img src="{{asset('storage/'.$img->image_path)}}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 1</h4>
                        <p>App</p>
                        <a href="{{asset('storage/'.$img->image_path)}}" data-gall="portfolioGallery" class="venobox preview-link vbox-item" title="App 1"><i class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>
@endsection
