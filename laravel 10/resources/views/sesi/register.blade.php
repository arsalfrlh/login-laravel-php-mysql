<!doctype html>
<html lang="en">
  <head>
  	<title>Login 05</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('/css/style.css') }}">


	</head>
	<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Register</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url(images/bg-1.jpg);"></div>
                    <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-4">Register</h3>
                    </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        @if ($errors->any()) <!-- Berhubungan dengan pesan required -->
                        <div class="pt-3">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <form action="/register/proses" method="post" class="signin-form">
                            @csrf
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="nama">
                        <label class="form-control-placeholder" for="username">nama</label>
                    </div>
                    <div class="form-group mt-3">
                        <input type="email" class="form-control" name="email">
                        <label class="form-control-placeholder" for="username">Email</label>
                    </div>
                    <div class="form-group">
                        <input id="password-field" type="password" name="password" class="form-control">
                        <label class="form-control-placeholder" for="password">Password</label>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Register</button>
                    </div>
                </form>
                <p class="text-center">Sudah Punya Akun? <a data-toggle="tab" href="/login">Login</a></p>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>

	<script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/popper.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
	</body>
</html>

