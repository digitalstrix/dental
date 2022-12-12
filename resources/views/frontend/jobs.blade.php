@extends('frontend.master')
@section('content')
<div class="container-fluid bg-primary py-5 hero-header mb-5">
    <div class="row py-3">
        <div class="col-12 text-center">
            <h1 class="display-3 text-white animated zoomIn">Jobs</h1>
            <a href="" class="h4 text-white">Home</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h4 text-white">Listed Jobs</a>
        </div>
    </div>
</div>
<!-- Hero End -->

{{-- {{dd($details)}} --}}
<!-- Pricing Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        {{-- <div class="row g-5"> --}}
                <div class="owl-carousel price-carousel wow zoomIn" data-wow-delay="0.9s">
                    @foreach ($details as $job)
                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle" style="z-index: 2;">
                                <h2 class="text-primary m-0"></h2>
                            </div>
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-5 p-4">
                            <h4>{{$job['meeting']}}</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Clinic Name: {{$job['clinic_name']}}</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Location: {{$job['clinic_location']}}</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Start Time: {{$job['start']}}</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>End Time: {{$job['end']}}</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <a href="{{route('frontend_apply_job',[$job['job_id']])}}" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">Apply Now</a>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    {{-- </div> --}}
</div>
@endsection