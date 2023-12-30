<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
	<title>@yield('title','') | luxfair </title>
	<!-- initiate head with meta tags, css and script -->
	@include('frontend.include.head')

</head>



<body>
	<!-- initiate footer section-->
	@include('frontend.include.header')



	@yield('content')	


	<!-- initiate footer section-->
	@include('frontend.include.footer')

	<!-- initiate scripts-->
	@include('frontend.include.script')	

	@include('frontend.include.searchmodel')

	@stack('scripts')
</body>

</html>