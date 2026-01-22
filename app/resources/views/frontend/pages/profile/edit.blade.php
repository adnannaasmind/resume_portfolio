@extends('frontend.layouts.master')
@section('content')
<div class="py-4">
    <div class="container">
        <h2 class="fw-semibold fs-4 mb-3">Profile</h2>
        <div class="row g-4">
            <div class="col-12">
                <div class="p-4 bg-white shadow rounded">
                    <div class="max-w-xl">
                        @include('frontend.pages.profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-4 bg-white shadow rounded">
                    <div class="max-w-xl">
                        @include('frontend.pages.profile.partials.update-password-form')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-4 bg-white shadow rounded">
                    <div class="max-w-xl">
                        @include('frontend.pages.profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
