@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<section class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">About the Embassy</h1>

        <div class="bg-white rounded-lg shadow p-8 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Our Mission</h2>
            <p class="text-gray-600 mb-4">
                The Embassy of Bangladesh is dedicated to serving the Bangladeshi community abroad with utmost
                professionalism and care. We strive to provide efficient consular services, promote bilateral
                relations, and protect the rights and welfare of Bangladeshi nationals.
            </p>
            <p class="text-gray-600">
                Our digital management system is part of our commitment to modernization and transparency,
                ensuring that every citizen has access to timely and reliable embassy services.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Consular Section</h3>
                <ul class="text-gray-600 space-y-2 text-sm">
                    <li>Passport Services (New, Renewal, Replacement)</li>
                    <li>Document Attestation</li>
                    <li>Power of Attorney</li>
                    <li>Birth & Marriage Registration</li>
                    <li>NID Services</li>
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Other Services</h3>
                <ul class="text-gray-600 space-y-2 text-sm">
                    <li>Visa Information</li>
                    <li>Citizenship Services</li>
                    <li>Emergency Assistance</li>
                    <li>Community Outreach</li>
                    <li>Cultural Programs</li>
                </ul>
            </div>
        </div>

        <div class="bg-green-50 rounded-lg p-8 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Office Hours</h3>
            <p class="text-gray-600 mb-2">Sunday - Thursday: 9:00 AM - 5:00 PM</p>
            <p class="text-gray-600 mb-4">Friday - Saturday: Closed</p>
            <p class="text-gray-500 text-sm">Online services are available 24/7 through this portal.</p>
        </div>
    </div>
</section>
@endsection
