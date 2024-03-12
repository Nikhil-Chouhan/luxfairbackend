  

    <!-- ALL JS FILES -->
    <script src="{{ asset('frontend/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('frontend/js/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script> -->

    <!-- ALL PLUGINS -->
    <script src="{{ asset('frontend/js/jquery.superslides.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap-select.js')}}"></script>
    <script src="{{ asset('frontend/js/inewsticker.js')}}"></script>
    <script src="{{ asset('frontend/js/bootsnav.js.')}}"></script>
    <script src="{{ asset('frontend/js/images-loded.min.js')}}"></script>
    <script src="{{ asset('frontend/js/isotope.min.js')}}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/js/baguetteBox.min.js')}}"></script>
    <script src="{{ asset('frontend/js/form-validator.min.js')}}"></script>
    <script src="{{ asset('frontend/js/contact-form-script.js')}}"></script>
    <script src="{{asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
    <script src="{{ asset('frontend/js/custom.js')}}"></script>
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent1, tablinks;
            tabcontent1 = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent1.length; i++) {
                tabcontent1[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
