@extends('layout.front.app')
@section('title', __('front.iraqmeter'))

@section('content')

    <style>
        .faqQuetions h3 {
            font-weight: bold;
            color: var(--new-color);
        }

        .faqQuetions ul {
            list-style-type: square;
        }
    </style>

    <section class="container py-5">
        <div class="faqQuetions py-5">
            <h3 class="fa-3x pb-3">{{ __("front.common_quesiton") }}</h3>
            <ul>
                @foreach($faqs as $faq)
                <li class="fa-2x">{!! $faq->translation->question !!}</li>
                <p class="py-2">{!! $faq->translation->answer !!}</p>
                @endforeach
            </ul>
        </div>
    </section>

@endsection
