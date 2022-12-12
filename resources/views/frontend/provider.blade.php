@extends('frontend.submaster')
@section('address')
{{$doctor['address']}}
@endsection
@section('name')
{{$doctor['name']}}
@endsection
@section('content')
 
<main class="main-content">
    <!--== Start Hero Area Wrapper ==-->
    <section class="home-slider-area">
      <div class="swiper-container home-slider-container default-slider-container">
        <div class="swiper-wrapper home-slider-wrapper slider-default">
          <div class="swiper-slide">
            <div class="slider-content-area parallax" data-speed="1.2" data-bg-img="{{asset('doc/assets/img/slider/bg-slider-01.jpg')}}">
              <div class="slider-container">
                <div class="slider-content">
                  <div class="content">
                    <div class="sub-title-box">
                      <h4 class="sub-title">{{$doctor['name']}}</h4>
                    </div>
                    <div class="title-box">
                      <h2 class="title">Always Smile like twinkle</h2>
                    </div>
                    <div class="desc-box">
                      <p class="desc">Dental care is the maintenance of healthy teeth and the practice of keeping the mouth and teeth clean.</p>
                    </div>
                    <div class="btn-slider-box">
                      <a class="btn-slider" href="contact.html">Contact</a>
                    </div>
                  </div>
                </div>
                <div class="slider-thumb">
                  <div class="thumb">
                    <div class="shape1"><img src="{{asset('doc/assets/img/slider/slider-01.png')}}" alt="Image-HasTech"></div>
                    <div class="shape2" data-bg-img="{{asset('doc/assets/img/icons/1.png')}}"></div>
                   
                    <div class="shape3" data-bg-img="{{asset('doc/assets/img/shape/3.png')}}"></div>
                    <div class="shape4"><img src="{{{asset('doc/assets/img/shape/4.png')}}}" alt="Image-HasTech"></div>
                    <div class="offer-info">
                      <div class="offer-info-content">
                        <h4 class="title">Best</h4>
                        <h3 class="offer-number">Care</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Hero Area Wrapper ==-->

    <!--== Start Service List Area Wrapper ==-->
    <section class="service-list-area service-list-default-area">
      <div class="container pb--0">
        <div class="row">
          <div class="col-12">
            <div class="service-list-content-wrap">
              <div class="grid-item">
                <!--== Start Service List Item ==-->
                <div class="service-list-item" data-aos="fade-up">
                  <div class="icon-box">
                    <img src="{{asset('doc/assets/img/icons/fun1.png')}}" alt="Image-HasTech">
                  </div>
                  <div class="content">
                    <h2 class="price-number"><span></span><span class="counter" data-counterup-delay="30">{{$cm}}</span></h2>
                    <h6 class="title">Appointments</h6>
                  </div>
                </div>
                <!--== End Service List Item ==-->
              </div>
              <div class="grid-item">
                <!--== Start Service List Item ==-->
                <div class="service-list-item" data-aos="fade-up">
                  <div class="icon-box">
                    <img src="{{asset('doc/assets/img/icons/fun2.png')}}" alt="Image-HasTech">
                  </div>
                  <div class="content">
                    <h2 class="price-number"><span></span><span class="counter" data-counterup-delay="30">{{$tr}}</span></h2>
                    <h6 class="title">Total Reviews</h6>
                  </div>
                </div>
                <!--== End Service List Item ==-->
              </div>
              <div class="grid-item">
                <!--== Start Service List Item ==-->
                <div class="service-list-item" data-aos="fade-up">
                  <div class="icon-box">
                    <img src="{{asset('doc/assets/img/icons/fun3.png')}}" alt="Image-HasTech">
                  </div>
                  <div class="content">
                    <h2 class="price-number"><span></span><span class="counter" data-counterup-delay="30">{{$ar}}</span></h2>
                    <h6 class="title">Avarage Rating</h6>
                  </div>
                </div>
                <!--== End Service List Item ==-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End Service List Area Wrapper ==-->

    <!--== Start About Area Wrapper ==-->
    <section class="about-area about-default-area">
      <div class="container pb--0">
        <div class="about-content-wrap">
          <div class="row">
            <div class="col-md-6">
              <div class="about-thumb">
                @php
                        if(!empty($doctor['image'])){
                        $link = 'storage/'.trim($doctor['image'],"public");
                        }else{
                            $link = "https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png";
                        }
                        @endphp
                <img  data-aos="fade-right" src="{{url($link)}}" alt="Image-HasTech">
                <div class="shape-one layer-style mousemove-layer" data-speed="2.2"><img src="{{asset('doc/assets/img/shape/1.png')}}" alt="Image-HasTech"></div>
                <div class="shape-two layer-style mousemove-layer" data-speed="1.2"><img src="{{asset('doc/assets/img/shape/2.png')}}" alt="Image-HasTech"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="about-content" data-aos="fade-up">
                <div class="section-title mb--0">
                  <h5 class="sub-title">DentaVibe</h5>
                  <h2 class="title">Keep your <span>Teeth Clean</span> & Shine</h2>
                  <div class="desc">
                    <p>{{$doctor['about']}}</p>
                  </div>
                </div>
                <h4 class="note-info">You need to brush your teeth everyday for healty teeth and simle</h4>
                <div class="about-content-bottom-info">
                  <a class="about-btn-link" href="{{$doctor['website']}}">Visit Now</a>
                  <div class="video-content-wrap">
                    <a class="ht-popup-video video-popup" href="#">
                      <img class="icon-img" src="{{asset('doc/assets/img/icons/play1.png')}}" alt="Image-HasTech">
                      <span>Video tour</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End About Area Wrapper ==-->

    <!--== Start Divider Area Wrapper ==-->
    <div class="divider-area position-relative z-index-1">
      <div class="container pt--0 pb--0">
        <div class="row divider-style-wrap">
          <div class="col-md-5">
            <div class="divider-content">
              <div class="section-title mb--0">
                <h5 class="sub-title">OUR SERVICES</h5>
                <h2 class="title mb--0">Better <span>Services for</span> your Teeth</h2>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="divider-content justify-content-end">
              <div class="emergency-call-info">
                <div class="content">
                  <h4 class="title">Connect On Call</h4>
                  <h3 class="number">{{$doctor['mobile']}}</h3>
                </div>
                <div class="icon-box">
                  <img class="icon-img" src="{{asset('doc/assets/img/icons/booking1.png')}}" alt="Image-HasTech">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-layer-style parallax" data-speed=".8" data-bg-img="{{asset('doc/assets/img/photos/bg1.jpg')}}"></div>
    </div>
    <!--== End Divider Area Wrapper ==-->

    <!--== Start Services Area Wrapper ==-->
        <!--== End Services Area Wrapper ==-->

    <!--== Start Divider Area Wrapper ==-->
    
    <!--== End Divider Area Wrapper ==-->

    <!--== Star Appointment Area Wrapper ==-->
    <!--== End Appointment Area Wrapper ==-->

    <!--== Start Testimonial Area Wrapper ==-->
    <section class="testimonial-area testimonial-default-area">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-md-6">
            <div class="testi-slider-content">
              <div class="section-title">
                <h5 class="sub-title">TESTIMONIALS</h5>
                <h2 class="title">Happy <span>Patients</span> with <span>Satisfaction</span> words</h2>
              </div>
              <div class="swiper-container testimonial-top">
                <div class="swiper-wrapper">
 <!--== Start Testimonial Item ==-->
@foreach ($review as $text)
    

                  <div class="swiper-slide">
                    <div class="testimonial-item">
                      <div class="testi-inner-content">
                        <div class="testi-content">
                          <p>“{{$text['review']}}”</p>
                        </div>
                        <div class="testi-author">
                          <div class="testi-info">
                            <span class="name">{{$text['name']}}</span>
                            <span class="designation"> ({{$text['rating']}}/5)</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End Testimonial Item ==-->
                  @endforeach
                </div>

                <!--== Add Swiper Arrows ==-->
                <div class="swiper-btn-wrap">
                  <div class="swiper-btn-prev"><i class="fa fa-long-arrow-left"></i><span>prev</span></div>
                  <div class="swiper-btn-next"><span>next</span><i class="fa fa-long-arrow-right"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="testi-slider-thumb">
              <div class="swiper-container testimonial-thumbs">
                <div class="swiper-wrapper">
                    <!--== Start Testimonial Item ==-->
                    @foreach ($review as $r )
                        @php
                        if(!empty($r['image'])){
                            $link = 'storage/'.trim($r['image'],"public");
                            }else{
                                $link = "https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png";
                            }
                            @endphp
                  <div class="swiper-slide">
                    <div class="testimonial-item">
                      <div class="testi-inner-thumb">
                        <div class="testi-thumb">
                          <img src="{{url($link)}}" alt="Image-HasTech">
                          <div class="quote-icon">
                            <img src="{{asset('doc/assets/img/icons/quote.png')}}" alt="Image-HasTech">
                          </div>
                          <div class="shape"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                   <!--== End Testimonial Item ==-->
                </div>
              </div>
              <div class="testi-thumb-shape" ><img src="{{asset('doc/assets/img/testimonial/s1.png')}}" alt="Image-HasTech"></div>
              <div class="testi-thumb-shape2"><img src="{{asset('doc/assets/img/testimonial/s2.png')}}" alt="Image-HasTech"></div>
              <div class="testi-thumb-shape3"></div>
              <div class="testi-thumb-shape4"></div>
              <div class="testi-thumb-shape5"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  @endsection
  @section('footer')
  <ul>
    <li>{{$doctor['address']}}</li>
    <li><a href="tel:{{$doctor['mobile']}}">{{$doctor['mobile']}}</a></li>
    <li><a href="mailto:{{$doctor['email']}}">{{$doctor['email']}}</a><br><a href="mailto:{{$doctor['website']}}">{{$doctor['website']}}</a></li>
  </ul>
  @endsection
  @section('services')
  <div class="widget-item widget-menu">
    <h4 class="widget-title">Quink Link</h4>
    <div class="widget-menu-wrap">
      <ul class="nav-menu">
        <li><a href="{{route('user_login')}}">User Login</a></li>
        <li><a href="{{route('provider_login')}}">Provider Login</a></li>
        <li><a href="{{route('clinic_login')}}">Clinic Login</a></li>
      </ul>
    </div>
  </div>
  @endsection