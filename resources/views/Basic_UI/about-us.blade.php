@extends('layouts.master')


@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>About Us</title>
       
    </head>
    <body>

        <main id="main">
            <div class="header">
                <img src="{{ asset('images/Headers/header bg About us.png') }}"alt="image of our lobby" , id="header__image" width=100%  height=85%>
            </div>
            <!-- About us section -->
            <div class="About_us_container">
                <img src="{{ asset('images/Logos/title box.png') }}" alt="Box for the heading" id="heading__box">
                <div class="heading"> 
                    <h1 id="About_title">About Us</h1>
                </div>  
                <div class="content_container">
                <p class="About_content">Since 1998, our bistro and bar has been a haven for those who appreciate the finer things in life. With a dedication to providing the most luxurious and profound dining and drinking experiences, we have become a destination for those seeking excellence in cuisine and libations.</p><br>
                <p class="About_content">But our dedication to excellence goes beyond just the culinary and mixological aspects of our establishment. Our luxurious ambient is carefully crafted to create a sense of exclusivity and intimacy, allowing our guests to truly immerse themselves in the atmosphere and savor every moment.</p><br>
                <p class="About_content">Over the years, we have become known for our commitment to quality and our unwavering pursuit of perfection. Our establishment has become a gathering place for those who appreciate the artistry of culinary and mixology, and we are proud to have earned a reputation as one of the finest bistro and bar establishments in the region.</p><br>
                </div>  
            </div>
        </main>

    </body>
@endsection
