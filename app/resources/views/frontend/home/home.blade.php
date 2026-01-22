@extends('frontend.layouts.master')

@section('content')

        <!-- PORTFOLIO GRID -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4" id="portfolioGrid">

                <!-- CARD -->
                <div class="col-lg-4 col-md-6 portfolio-item" data-name="john developer">
                    <div class="card portfolio-card h-100">
                        <img src="https://i.pravatar.cc/400?img=1" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="fw-bold">John Doe</h5>
                            <p class="text-muted mb-1">Full Stack Developer</p>
                            <span class="badge bg-primary">Laravel</span>
                            <span class="badge bg-secondary">React</span>
                            <span class="badge bg-success">MySQL</span>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#" class="btn btn-outline-primary w-100">
                                View Portfolio
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item" data-name="sara designer">
                    <div class="card portfolio-card h-100">
                        <img src="https://i.pravatar.cc/400?img=5" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="fw-bold">Sara Khan</h5>
                            <p class="text-muted mb-1">UI/UX Designer</p>
                            <span class="badge bg-warning text-dark">Figma</span>
                            <span class="badge bg-info">Adobe XD</span>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#" class="btn btn-outline-primary w-100">
                                View Portfolio
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item" data-name="ahmed freelancer">
                    <div class="card portfolio-card h-100">
                        <img src="https://i.pravatar.cc/400?img=8" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="fw-bold">Ahmed Rahman</h5>
                            <p class="text-muted mb-1">Digital Marketer</p>
                            <span class="badge bg-danger">SEO</span>
                            <span class="badge bg-success">Ads</span>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#" class="btn btn-outline-primary w-100">
                                View Portfolio
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
