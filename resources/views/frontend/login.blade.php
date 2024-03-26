
@extends('frontend.include.main')
@section('title', 'Home')

@section('content')

<!-- Start Top Search -->
<div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                 
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="container">
		<div class="row">
			<div class="col-md-5 offset-md-4">
				<div class="login">
                <form action="{{ route('frontend.login.submit') }}" method="post">	
						<h1>Log in</h1>
                        @csrf
						<div class="form-control newlogin">
							<input type="text" placeholder="E-mail" name="email" id="email" required>
                         </div> 
						<div class="form-control newlogin logintype">
							<input id="password-field" type="password" name="password" placeholder="Password" required>
							<!-- <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span> -->
                        </div>
						<!-- <div class="row">
						    <div class="col-md-6 logto">
									<div class="form-group">
									  <input type="checkbox" id="html">
									  <label for="html">Keep me signed in</label>
									</div>
                            </div>
							 <div class="col-md-6 logto">
								<div class="forgot">
								    <p><a href="forgot.html">Forgot password?</a></p>
								</div>
							 </div>
						 </div> -->
					<button type="submit" class="registerbtn">SIGN IN</button>
					  <div class=" signup">
						<p>Not a member yet? <a href="{{route('frontend.register')}}">Sign up</a></p>
					</div>
					</form> 
            <div class="block mt-4">
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ url('login/google') }}">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                    </a>
                </div>
            </div>
				</div>
                <div class=" signup">
						<p>Are you a vendor? <a href="{{route('login')}}">Login here</a></p>
					</div>
			</div>
		</div>
    </div>
	
    @endsection