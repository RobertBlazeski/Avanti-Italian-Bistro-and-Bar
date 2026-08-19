@extends('layouts.master')


@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content=" initial-scale=1.0">
        <title>Avanti Home Page</title>
      
    </head>
    <body>
      

       <main id="main">
            <div class="why-header">
                <img src="{{ asset('Images/Headers/lobby final.jpg') }}" alt="image of our lobby" , id="header__image" width=100%  height=85%>
            </div>


           <!--Why us section-->

            <div class="Why_us_container">
                <img src="{{asset('images/Logos/title box.png') }}" alt="Box for the heading", id="why_us_box">
                <div class="heading_why">
                    <h1 id="why_us_title">Why us</h1>
                </div>
                <div class="under_container">
                    <div class="under_item">
                      <div class="under_text">
                        <h3>Professionality</h3>
                        <p>Our team embodies the pinnacle of professionalism and politeness, ensuring an exceptional experience for our valued guests. With mastery in their craft, they skillfully create world-class culinary delights and craft exquisite drinks. Their dedication to delivering a luxurious dining experience is unmatched, as they blend artistry and passion into every dish and cocktail. Indulge in the unrivaled expertise and refined service of our staff, and savor the extraordinary flavors that define our establishment.</p>
                      </div>
                      <div class="under_image">
                        <img src="{{asset('images/Other img/avanti staff.PNG') }}" alt="picture of our staff" id="staff-img">
                      </div>
                    </div>
                    <div class="under_item">
                      <div class="under_image">
                        <img src="{{asset('images/Other img/avanti front.PNG.png') }}" alt="picture of our enterance" id="enter-img">
                      </div>
                      <div class="under_text1">
                        <h3>The way we treat our costumers</h3>
                        <p >At our dining and bar establishment, we seamlessly blend luxury with a warm, welcoming atmosphere. While we take pride in providing a sophisticated experience, our attentive and polite staff ensures that every guest feels right at home. From the moment you step through our doors, you'll be greeted with genuine hospitality, creating a sense of comfort and familiarity. Enjoy the finest culinary offerings and handcrafted drinks, all while being treated like part of our extended family.</p>
                      </div>
                    </div>
                  </div>
                </div>  

           

          
        </main>

   
    </body>
    @endsection