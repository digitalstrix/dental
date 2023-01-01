@extends('frontend.master')
@section('content')
{{-- {{dd($doctor)}} --}}
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Clinics</h1>
            <a href="" class="h4 text-white">Home</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white">Clinics</a>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="section-title bg-light rounded h-100 p-5">
                    <h5 class="position-relative d-inline-block text-primary text-uppercase">Registered Clinic</h5>
                    <h1 class="display-6 mb-4">Registered Clinics</h1>
                    <a href="{{route('clinic_register')}}" class="btn btn-primary py-3 px-5">Register Your Clinic</a>
                </div>
            </div>
            @if (!empty($doctor))
                        @foreach ($doctor as $item)
                        @php
                        if(!empty($item['image'])){
                        $link = 'storage/'.trim($item['image'],"public");
                        }else{
                            $link = "https://image.similarpng.com/very-thumbnail/2020/05/Close-up-of-a-doctor-transparent-background-PNG.png";
                        }
                        @endphp
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="position-relative rounded-top" style="z-index: 1;">
                       
                        <a href="{{route('clinicPage',[$item['id'],str_replace(' ', '-',$item['name'])])}}" target="_blank" rel="noopener noreferrer">
                        <img style="height: 300px !important; width: 100px" class="img-fluid rounded-top w-100 " src="{{url($link)}}" alt="">
                    </a>
                        <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                            <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                            <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                        <h4 class="mb-2">{{$item['name']}}</h4>
                        <p class="text-primary mb-0">{{$item['user_type']}}</p>
                    </div>
                </div>
            </div>
            @endforeach
                    @endif
        </div>
    </div>
</div>
@endsection