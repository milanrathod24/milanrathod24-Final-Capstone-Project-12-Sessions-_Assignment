@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        <p>{{ __('You are logged in!') }}</p>
                    @endauth

                    <hr class="my-4">

                    <h5>Stripe Integration Test</h5>
                    <p>Click the button below to test the Stripe payment integration.</p>
                    
                    @guest
                        <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to test the payment.</p>
                    @else
                        <a href="{{ route('payment.checkout') }}" class="btn btn-primary mt-2">
                            Test Stripe Payment
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
