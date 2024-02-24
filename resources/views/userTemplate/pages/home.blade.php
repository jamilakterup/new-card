@extends('userTemplate.masters')

@section('content')

<main>
    {{-- banner section --}}
    <section class="container-fluid row px-4">
        <div class="col mt-auto">
            <h1 class="text-uppercase text-success display-4 fw-bold">Generate your <br><span class="text-danger">ID
                    card</span>
            </h1>
            <small>ID card generator is a tool to create personalized identification cards, commonly used for
                employee
                badges, student IDs, and membership cards with customizable details and templates for various purposes.
            </small>
            <br>
            <div class="d-flex gap-3">
                <button class="btn btn-success my-5 p-3 w-50">Create Id card</button>
                <button class="btn btn-outline-success my-5 p-3 w-50">Create Account</button>
            </div>
        </div>
        <div class="col d-flex justify-content-end">
            <dotlottie-player src="https://lottie.host/92580f9e-8ac8-45ad-a810-392ef1defce3/I5HZF6g0su.json"
                background="transparent" speed=".4" style="width: 700px; height: 400px;" loop autoplay>
            </dotlottie-player>
        </div>
    </section>

    {{-- sub content section --}}
    {{-- <h1 class="text-center text-success" style="margin: 100px 0 20px"><ins>ABOUT CARD</ins></h1>
    <section class="container-fluid row my-5">
        <div class="col d-flex justify-content-center">
            <img src="{{asset('assets/template/card.jpg')}}" width="400px" height="500px" alt="card image">
        </div>
        <div class="col">
            <h2>Introducing the ID Cards Maker </h2>
            <p class="my-4">Introducing Wepik's Online ID Card Maker - An easy-to-use tool that makes it smooth to
                create
                professional ID cards for your company. With templates designed to make the process simple and clean,
                get your ID cards in no time! </p>

            <ul>
                <li>

                    Explore a range of customizable templates designed to simplify the ID card creation process.
                </li>
                <li>
                    Personalize your ID cards with pictures, logos, shapes, texts and extra information to make them
                    professional and unique.
                </li>
                <li>
                    Enjoy the convenience of instantly downloading your final product, in PDF, JPEG or PNG
                </li>
            </ul>
        </div>
    </section> --}}

    {{-- sub content section --}}
    <h1 class="text-center text-success" style="margin: 100px 0 20px"><ins>ABOUT CARD</ins></h1>
    <section class="container-fluid d-flex justify-content-center align-items-center my-5 px-5">
        <div class="d-flex justify-content-center">
            <img src="{{asset('assets/template/card.jpg')}}" width="400px" height="500px" alt="card image">
        </div>
        <div class="mx-5">
            <h2>Introducing the ID Cards Maker </h2>
            <p class="my-4">Introducing Wepik's Online ID Card Maker - An easy-to-use tool that makes it smooth to
                <em><strong>create
                        professional ID cards for your company.</strong></em> With templates designed to make the
                process simple and clean,
                get your ID cards in no time!
            </p>

            <ul>
                <li>

                    Explore a range of <em><strong>customizable templates</strong></em> designed to simplify the ID card
                    creation process.
                </li>
                <li>
                    <em><strong>Personalize your ID cards</strong></em> with pictures, logos, shapes, texts and extra
                    information to make them
                    professional and unique.
                </li>
                <li>
                    Enjoy the convenience of <em><strong>instantly downloading or print your final
                            product,</strong></em> in PDF, JPEG or PNG
                </li>
            </ul>
        </div>
    </section>

    {{-- sub content section --}}
    <h1 class="text-center text-success" style="margin: 100px 0 20px"><ins>WHY THIS</ins></h1>
    <section class="container-fluid d-flex justify-content-center align-items-center px-5 pb-5">
        <div class="me-5 pe-5">
            <h2>A great solution for your company </h2>
            <p class="my-4">
                Create attractive and professional ID cards with Wepik's user-friendly online ID card maker for your
                company. Our templates aim to highlight your business's own character while providing a unified,
                polished look.
                Thanks to our intuitive interface and wide range of customization options, you can
                <em><strong>personalize your ID
                        cards to reflect your brand's style.</strong></em> Whether you have a small team or a huge
                enterprise, our platform
                will satisfy whatever you need.
            </p>
        </div>
        <div class="d-flex justify-content-center">
            <dotlottie-player src="https://lottie.host/6cfb1fab-c215-49fb-b20f-0fc910eca7db/MD5ma7Bq9f.json"
                background="transparent" speed="1" style="width: 500px; height: 400px;" loop autoplay>
            </dotlottie-player>
        </div>
    </section>

</main>

@endsection