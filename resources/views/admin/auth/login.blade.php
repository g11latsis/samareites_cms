@extends('admin.layout.main')

@push('title')
Admin
@endpush

@section('main')

<!doctype html>
<html lang="en">

<head>
    <title>Login 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Διαχειριστής</h3>
                        <h5 class="text-center text-danger mb-4">
                            @if (session()->has('error'))
                                {{ session('error') }}
                            @endif
                        </h3>
                        <form action="{{ route('admin.log') }}" method="post" class="login-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" name="email" placeholder="ΗΛΕΚΤΡΟΝΙΚΗ ΔΙΕΥΘΥΝΣΗ" @if(session()->has('ad_log_email')) value="{{ session('ad_log_email') }}" @else value="{{ old('email') }}" @endif>
                            </div>
                            <span class="text-danger ad-login-err">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Κωδικός πρόσβασης" value="{{ old('password') }}">
                            </div>
                            <span class="text-danger ad-login-err">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-primary rounded submit px-3">Συνδεθείτε</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Θυμήσου με
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>

@endsection