<!DOCTYPE html>
<html lang="en">

<head>
   @include('layouts.head')
</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <a href="index" class="navbar-brand">
                <h1 class="m-0 text-uppercase text-primary"><img src="{{ asset('assets/admin/plugins/images/Icondental.png') }}" style="height: 40px; padding-bottom: 10px; padding-right: 10px" alt="homepage" />E-Dental</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    @guest
                    <a href="index" class="nav-item nav-link">Home</a>
                    <a href="makeappointment" class="nav-item nav-link">Appointment</a>
                    <a href="service.html" class="nav-item nav-link">Document</a>
                    <a href="price.html" class="nav-item nav-link">Notification</a>
                    @if (Route::has('login'))
                    <a href="login" class="nav-item nav-link">Login</a>
                    @endif
                    @if (Route::has('login'))
                    <a href="register" class="nav-item nav-link">Register</a>
                    @endif
                    @else
                    <a href="/index" class="nav-item nav-link">Home</a>
                    @if (Auth::user()->role == 0)
                    <div class="nav-item dropdown">
                        <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Appointment</a>
                        <div class="dropdown-menu m-0">
                            <a href="/viewappointment" class="dropdown-item">View Appointment</a>
                            <a href="/makeappointment" class="dropdown-item">Make Appointment</a>
                        </div>
                    </div>
                    @else
                    <div class="nav-item dropdown">
                        <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Appointment</a>
                        <div class="dropdown-menu m-0">
                            <a href="/viewappointment" class="dropdown-item">View Appointment</a>
                            <a href="/approveappointment" class="dropdown-item">Approve Appointment</a>
                        </div>
                    </div>
                    @endif
                    @if (Auth::user()->role == 0)
                    <div class="nav-item dropdown">
                        <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Document</a>
                        <div class="dropdown-menu m-0">
                            <a href="/DigitalDocument" class="dropdown-item">View Document</a>
                            <a href="/UploadDigitalDocument" class="dropdown-item">Upload Digital Document</a>
                        </div>
                    </div>
                    @else
                    <div class="nav-item dropdown">
                        <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Document</a>
                        <div class="dropdown-menu m-0">
                            <a href="/dentistdocument" class="dropdown-item">View Document</a>
                            <a href="/UploadDigitalDocument" class="dropdown-item">Upload Digital Document</a>
                        </div>
                    </div>
                    @endif
                    <a href="/viewnotification" class="nav-item nav-link">Notification</a>
                    {{-- <a href="login" class="nav-item nav-link">{{ Auth::user()->name }}</a> --}}
                    <div class="nav-item dropdown">
                        <a href="/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu m-0">
                            <a href="/profile" class="dropdown-item">Manage Profile</a>
                            <a href="{{ route('logout') }}" class="dropdown-item"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<section>
  @yield('content')
</section>
    

<!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                    <p class="mb-4">Don't let dental issues hold you back. Reach out and get in touch with our caring team of experts who are committed to your dental health.</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+62 821-63877-9182</p>
                </div>
                <div class="col-lg-3 col-md-6">
                </div>
                <div class="col-lg-3 col-md-6">
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        @if (Auth::user()->role == 0)
                        <a class="text-light mb-2" href="/index"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="/makeappointment"><i class="fa fa-angle-right me-2"></i>Make Appointment</a>
                        <a class="text-light mb-2" href="/viewappointment"><i class="fa fa-angle-right me-2"></i>View Appointment</a>
                        <a class="text-light mb-2" href="/DigitalDocument"><i class="fa fa-angle-right me-2"></i>View Document</a>
                        <a class="text-light mb-2" href="/UploadDigitalDocument"><i class="fa fa-angle-right me-2"></i>Upload Document</a>
                        @else
                        <a class="text-light mb-2" href="/index"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="/viewappointment"><i class="fa fa-angle-right me-2"></i>View Appointment</a>
                        <a class="text-light mb-2" href="/approveappointment"><i class="fa fa-angle-right me-2"></i>Approve Appointment</a>
                        <a class="text-light mb-2" href="/dentistdocument"><i class="fa fa-angle-right me-2"></i>View Document</a>
                        <a class="text-light mb-2" href="/UploadDigitalDocument"><i class="fa fa-angle-right me-2"></i>Upload Document</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">E-Dental</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by HTML E-Dental</p>
                </div>
            </div>
        </div>
    </div>
    <a href="https://wa.me/+6282163879182" target="_blank">
        <img src="{{ asset('assets/img/whatsappicon.png') }}" alt="WhatsApp Logo" id="whatsapp-logo">
      </a>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

<script>
  const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('nav a').forEach(link => {
  if(link.href.includes(`${activePage}`)){
    link.classList.add('active');
    console.log(link);
  }
})
</script>