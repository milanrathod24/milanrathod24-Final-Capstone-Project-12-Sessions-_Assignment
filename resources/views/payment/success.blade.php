@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header bg-success text-white">{{ __('Payment Successful') }}</div>

                <div class="card-body text-center">
                    <h3 class="text-success mb-3">Thank you for your purchase!</h3>
                    <p>Your one-time payment was successful.</p>
                    
                    @if(isset($sessionId) && !empty($sessionId))
                        <div class="alert alert-light border mt-3 mb-4">
                            <strong>Session ID:</strong> <br>
                            <span class="text-muted" style="word-break: break-all;">{{ $sessionId }}</span>
                        </div>
                    @endif

                    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-2">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
