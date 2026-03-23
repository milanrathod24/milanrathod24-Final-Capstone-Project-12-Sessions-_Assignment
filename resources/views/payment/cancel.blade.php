@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">{{ __('Payment Cancelled') }}</div>

                <div class="card-body text-center">
                    <h3 class="text-danger mb-3">Payment Cancelled</h3>
                    <p>You have cancelled the checkout process. You have not been charged.</p>

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
