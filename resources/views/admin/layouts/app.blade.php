<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('home.dashboard') }}</title>
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/auth/styles.css') }}"/>
    <link href="{{ asset('assets/admin/css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/my-custom-styles.css') }}">
    <link href="{{ asset('assets/admin/css/admin-layout.css') }}" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        :root {
            --font-family-sans-serif: 'Cairo', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        * {
            font-family: 'Cairo', sans-serif;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        .modal-title, h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif;
            font-weight: 600;
        }
        
        .btn {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] .ltr\:ml-64 {
            margin-left: 0;
            margin-right: 12rem;
        }
        
        [dir="rtl"] .ltr\:mr-64 {
            margin-right: 0;
            margin-left: 12rem;
        }
        
        /* Sidebar */
        .sidebar {
            width: 12rem;
            position: fixed;
            top: 0;
            bottom: 0;
            background-color: #1a1a1a;
            overflow-y: auto;
            z-index: 50;
            padding: 0;
        }

        /* تخصيص شريط التمرير */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #4a5568;
            border-radius: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #718096;
        }

        [dir="ltr"] .sidebar {
            left: 0;
        }
        
        [dir="rtl"] .sidebar {
            right: 0;
        }
        ul.main-menu {
            width: 100%;
            border: 1px solid;
            margin: 0;
        }

        ul.main-menu, ul.main-menu ul {
            margin: 0;
            padding: 0;
        }

        ul.main-menu li li {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        /* Main Content */
        .main-content {
            transition: margin 0.3s;
            padding-top: 1rem;
        }
        
        [dir="ltr"] .main-content {
            margin-left: 16rem;
        }
        
        [dir="rtl"] .main-content {
            margin-right: 16rem;
        }
        
        @media (max-width: 640px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            
            [dir="rtl"] .sidebar {
                transform: translateX(100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
        }

        /* تنسيقات القائمة */
        .nav-link {
            color: #a0aec0;
            padding: 0.25rem 0.5rem;
            display: flex;
            width: 100%;
            transition: all 0.2s ease-in-out;
            border-radius: 0.25rem;
            gap: 0.375rem;
        }
        button.nav-link {
            width: 100%;
            margin: 0;
            text-align: start;
        }
        button.nav-link span {
            width: 100%;
        }

        .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff !important;
            font-weight: 500;
        }

        .nav-link i {
            width: 1.25rem;
            text-align: center;
            font-size: 0.875rem;
        }

        /* تنسيقات القوائم الفرعية */
        .collapse .nav-link {
            padding-inline-start: .5rem;
        }

        /* تنسيق زر القائمة المنسدلة */
        button.nav-link {
            background: none;
            border: none;
            cursor: pointer;
            justify-content: space-between;
            margin: 0;
        }

        button.nav-link::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            transition: transform 0.2s;
            font-size: 0.75rem;
            opacity: 0.75;
        }

        button.nav-link[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        /* تنسيق مبدل اللغة */
        .sidebar .mt-8 .nav-link {
            justify-content: center;
            padding: 0.25rem;
            width: auto;
        }

        /* تقليل المسافات */
        .sidebar .p-4 {
            padding: 0.5rem;
        }

        .sidebar .mb-6 {
            margin-bottom: 0.5rem;
        }

        .sidebar .py-4 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .sidebar .gap-4 {
            gap: 0.5rem;
        }

        .sidebar .mt-2 {
            margin-top: 0.25rem;
        }

        .sidebar .space-y-2 > * + * {
            margin-top: 0;
        }

        .sidebar .mt-8 {
            margin-top: 1rem;
        }

        /* تنسيق منصب المستخدم */
        .sidebar .user-position {
            color: #60a5fa;
            text-shadow: 0 0 10px rgba(96, 165, 250, 0.5);
        }
        .nav-link.active {
            font-weight: bold;
            background-color: #007bff; /* لون الخلفية عند التحديد */
            color: white; /* لون النص عند التحديد */
        }
        
        /* تخصيص موقع Toastr حسب اتجاه الصفحة */
        #toast-container.toast-top-right {
            top: 1rem !important;
            {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 13rem !important;
            right: auto;
        }

        /* تخصيص موقع Toastr حسب اتجاه الصفحة */
        #toast-container.toast-bottom-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {
            bottom: 1rem !important;
            {{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 2rem !important;
            right: auto;
        }

        /* تخصيص شكل التوست حسب اتجاه اللغة */
        #toast-container .toast {
            direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};
            padding: 15px 15px 15px 50px;
        }

        #toast-container .toast-title {
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* تعديل موضع الأيقونة حسب اتجاه اللغة */
        #toast-container > div {
            {{ app()->getLocale() == 'ar' ? 'padding-right: 50px !important; padding-left: 15px !important;' : 'padding-left: 50px !important; padding-right: 15px !important;' }}
            background-position: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }} 15px center !important;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Mobile Toggle Button -->
    <button onclick="toggleSidebar()" class="fixed top-4 z-50 p-2 bg-gray-800 text-white rounded-lg shadow-lg sm:hidden" style="{{ app()->getLocale() == 'ar' ? 'right: 1rem' : 'left: 1rem' }}">
        <i class="fas fa-bars"></i>
    </button>

    @include('admin.inc.sidebar')
    
    <div class="main-content min-h-screen p-4">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Toastr Configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": {{ app()->getLocale() == 'ar' ? 'true' : 'false' }}
        };

        // عرض رسائل النجاح
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        // عرض رسائل الخطأ
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        // عرض أخطاء التحقق
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
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
</body>
</html>