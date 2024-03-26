
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
			<div class="col-md-5 offset-md-4 discovere">
				<div class="login">
				    <form action="{{ route('frontend.register.submit') }}" method="post">	
						<h1>Create an account and<br/> discover the benefits</h1>
                        @csrf
						<div class="form-control newlogin">
							<input type="text" placeholder="First Name" name="name" id="name" required>
                         </div> 
						 <div class="form-control newlogin">
							<input type="text" placeholder="Last Name" name="name" id="name" required>
                         </div> 
						 <div class="form-control newlogin">
							<input type="text" placeholder="Email" name="email" id="email" required>
                         </div> 
						<div class="form-control newlogin">
							<input type="password" placeholder="Enter Password" name="password" id="password" required>
                        </div>
                        <div class="form-control newlogin">
                            <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>
                        </div>
						<!-- <div class="row">
						    <div class="col-md-12 services">
						       <div class="new">
								  <form>
									<div class="form-group">
									  <input type="checkbox" id="html">
									  <label for="html">I agree to the Google Terms of Service and Privacy Policy</label>
									</div>
									
								  </form>
								</div> 
                            </div>
							 
						 </div>
						 -->
						 
                        <button type="submit" class="registerbtn">SIGN IN</button>
					
					   <div class=" signup">
						<p>Already a member? <a href="{{route('frontend.login')}}">Sign in</a></p>
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
			</div>
		</div>
    </div>
	
	
    @endsection