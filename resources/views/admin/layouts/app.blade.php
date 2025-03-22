<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('home.dashboard') }}</title>
    @if(app()->getLocale() == 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/my-custom-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-layout.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    {{-- specially called styles --}}
    @yield('styles')
    
    @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/layout.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dt/ar.css') }}">
    
    @else
    <link rel="stylesheet" href="{{ asset('assets/admin/css/layout.ltr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dt/en.css') }}">
    @endif
</head>
<body class="bg-gray-100">
    <!-- Mobile Toggle Button -->
    {{-- <button onclick="toggleSidebar()" 
        class="fixed top-4 z-50 p-2 bg-gray-800 text-white rounded-lg shadow-lg sm:hidden" 
        style="{{ app()->getLocale() == 'ar' ? 'right: 1rem' : 'left: 1rem' }}">
        <i class="fas fa-bars"></i>
    </button> --}}

    @include('admin.inc.sidebar')
    <div class="main-content min-h-screen position-relative">
        {{-- روابط الخلفية --}}
        <div class="top-header mb-5" >
            <nav aria-label="breadcrumb">
                <div class="breadcrumb list-unstyled">
                    <div class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">{{__('dashboard.dashboard')}}</a></div>
                    @yield('header-breadcrumb')
                </div>
            </nav>
        </div>
        
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // معالجة الأخطاء غير المعالجة في الوعود
        window.addEventListener('unhandledrejection', function(event) {
            console.warn('تم تجاهل خطأ في وعد:', event.reason);
            event.preventDefault(); // منع ظهور الخطأ في وحدة التطوير
        });

        
    </script>
    <script>
        // Toggle Sidebar on Mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.querySelector('button[onclick="toggleSidebar()"]');
            
            if (window.innerWidth <= 640 && 
                sidebar.classList.contains('open') && 
                !sidebar.contains(event.target) && 
                event.target !== toggleButton) {
                sidebar.classList.remove('open');
            }
        });
    </script>
       
    <script>

        // عرض رسائل النجاح
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}", "{{ __('general.success') }}");
        @endif

        // عرض رسائل الخطأ
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}", "{{ __('general.error') }}");
        @endif

        // عرض رسائل التحذير
        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}", "{{ __('general.warning') }}");
        @endif

        // عرض رسائل المعلومات
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}", "{{ __('general.info') }}");
        @endif

        // عرض أخطاء التحقق
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}", "{{ __('general.validation_error') }}");
            @endforeach
        @endif

        // Toggle Sidebar on Mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.querySelector('button[onclick="toggleSidebar()"]');
            
            if (window.innerWidth <= 640 && 
                sidebar.classList.contains('open') && 
                !sidebar.contains(event.target) && 
                event.target !== toggleButton) {
                sidebar.classList.remove('open');
            }
        });


        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    @section('footer_scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    @if (app()->getLocale() == 'ar')
    <script>
        let table = new DataTable('#myTable', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json',
                lengthMenu: "_MENU_ سجلات لكل صفحة",
                paginate: {
                    first: '<<',
                    last: '>>',
                    next: '>',
                    previous: '<'
                }
            }
        });
        // إعدادات التوستر
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "10000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": true
        };
    </script>
    @else
    <script>
        let table = new DataTable('#myTable', {
            language: {
                paginate: {
                    first: '<<',
                    last: '>>',
                    next: '>',
                    previous: '<'
                }
            }
        });
        // إعدادات التوستر
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "10000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": true
        };
    </script>
    @endif
    @show
</body>
</html>