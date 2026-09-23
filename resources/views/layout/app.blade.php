<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> مطعم الشامي |Al-Shami </title>
    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>


        
   
    @import url('https://fonts.googleapis.com/css2?family=amiri:wght@400;600;700;800&display=swap');

   
    html, body {
        font-family: 'amiri', sans-serif !important; 
        background-color: #eeedde !important;      
        color: #2b2b2b !important;                 

    /* 3. النافبار والقائمة الجانبية (Offcanvas) */
    .navbar, nav.navbar, .offcanvas {
        background-color: #947612a4 !important;       /* لون القائمة البني الذهبي */
        border-bottom: 3px solid #644e09 !important;
        color: #ffffff !important;
        font-family: 'Cairo', sans-serif !important;
    }

    .navbar .nav-link, .offcanvas .nav-link {
        color: #ffffff !important;
    }

    .navbar .nav-link:hover, .navbar .nav-link.active {
        color: #f3e294 !important;                  /* لون التمييز عند التمرير */
    }

    
    .h1, .h2, .h3, .h4, .h5, .h6 {
        color: #534109 !important;                  /* عناوين بالبني الداكن بدلاً من الأزرق والأصفر */
        font-family: 'Cairo', sans-serif !important;
        font-weight: 700 !important;
    }

    
    .badge.bg-primary {
        background-color: #9c7d40 !important;       /* أزرار وبادجات باللون الذهبي البني */
        border-color: #644e09 !important;
        color: #ffffff !important;
        font-family: 'Cairo', sans-serif !important;
        font-weight: 600 !important;
    }

    .btn-primary:hover {
        background-color: #45370b !important;
        border-color: #231b02 !important;
        color: #ffffff !important;

    }

    
    .card {
        background-color: #9c7d40 !important;       
        color: #ffffff !important;
        border: 1px solid #644e09 !important;
        border-radius: 12px !important;
        font-family: 'Cairo', sans-serif !important;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border-color 0.3s ease-in-out !important;
        cursor: pointer;
    }

    .card .btn {
    transition: background-color 0.3s ease, transform 0.2s ease !important;
}

.card .btn:hover {
    transform: scale(1.05) !important; /* يكبر الزر قليلاً عند الماوس */
    background-color: #644e09 !important;
    color: #ffffff !important;
}

.card:hover {
    transform: translateY(-8px) !important; 
    box-shadow: 0 10px 20px rgba(83, 65, 9, 0.25) !important; 
    border-color: #534109 !important; /* يغير لون الإطار الخارجي للكارت عند الوقوف عليه */
}
    .card .card-title {
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    /* 7. النصوص الفرعية والتوضيحية */
    .text-muted {
        color: #3f3c35 !important;
        font-family: 'Cairo', sans-serif !important;
    }



</style>
    
</head>
<body class="bg-custom-black text-white">
    
    <!-- Navbar -->
     
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom-black border-bottom border-warning border-3 sticky-top" style="z-index: 1030;">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" width="45" height="45" class="me-2">
      <span class="fs-4 fw-bold text-custom-yellow">شاورما الشامي</span>
    </a>

    <!-- Offcanvas Toggler Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Sidebar Offcanvas Container -->
    <div class="offcanvas offcanvas-start bg-custom-black text-white" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header border-bottom border-warning">
        <h5 class="offcanvas-title fw-bold text-custom-yellow" id="offcanvasNavbarLabel">القائمة الرئيسية 🌯</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body">
        <!-- Live Search Bar -->
        <div class="mx-auto position-relative my-2 my-lg-0" style="width: 100%; max-width: 400px;">
          <input type="text" id="live-search-input" class="form-control" placeholder="ابحث عن وجبة أو قسم..." autocomplete="off">
          <div id="search-results-box" class="list-group position-absolute w-100 shadow-lg d-none mt-1" style="z-index: 1050; max-height: 300px; overflow-y: auto;"></div>
        </div>

        <!-- Navigation Links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">الرئيسية</a></li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-custom-yellow fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              وجبات الشامي 🌯
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('category.show', 'chicken') }}">دجاج الشامي 🍗</a></li>
              <li><a class="dropdown-item" href="{{ route('category.show', 'shawarma') }}">شاورما الشامي 🥙</a></li>
              <li><a class="dropdown-item" href="{{ route('category.show', 'sandwiches') }}">سندوتشات الشامي 🥖</a></li>
              <li><a class="dropdown-item" href="{{ route('category.show', 'appetizers') }}">مقبلات الشامي 🍟</a></li>
            </ul>
          </li>

          @guest
            <li class="nav-item"><a class="btn btn-outline-warning text-white my-1 my-lg-0 me-lg-2 ms-lg-2" href="{{ route('login') }}">دخول</a></li>
            <li class="nav-item"><a class="btn btn-warning my-1 my-lg-0" href="{{ route('register') }}">حساب جديد</a></li>
          @else
            <li class="nav-item ms-lg-2 me-lg-2">
              <a class="nav-link text-custom-yellow fw-bold" href="{{ route('cart.index') }}">
                🛒 السلة <span class="badge bg-warning text-dark">{{ session('cart') ? count(session('cart')) : 0 }}</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                👤 {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile') }}">الملف الشخصي</a></li>
                @if(Auth::user()->isAdmin())
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item text-custom-yellow fw-bold" href="{{ route('admin.dashboard') }}">لوحة الإحصائيات</a></li>
                  <li><a class="dropdown-item text-custom-yellow fw-bold" href="{{ route('admin.meals.create') }}">إدارة وإضافة الوجبات</a></li>
                  <li><a class="dropdown-item text-custom-yellow fw-bold" href="{{ route('admin.orders') }}">إدارة الطلبات</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">تسجيل الخروج</button>
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>
</nav>

    <!-- Main Content -->
    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>


<footer class="bg-dark text-white pt-4 pb-3 mt-5">
    <div class="container text-center text-md-start">
        <div class="row">

            <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                <h5 class="text-uppercase fw-bold text-warning mb-3">مطعم الشامي</h5>
                <p>أطيب الوجبات والأكلات الطازجة يومياً. يسعدنا خدمتكم وتلبية طلباتكم دائماً.</p>
            </div>

            <p>
                    <i class="fas fa-map-marker-alt text-warning mb-3"></i>
                   <a href="https://maps.google.com/?cid=14118843628149697211" target="_blank" class="btn btn-outline-light btn-floating m-1" role="button"> العنوان📍
                                                      
                                                                 </a>
                                                                 <br>
                   : مول الشهامه
                  امام مول السلام محور خدمات الحي الثاني
                </p>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h5 class="text-uppercase fw-bold text-warning mb-3">تواصل معنا👇</h5>
             
                

                <p>
                    <i class="fab fa-whatsapp me-2 text-success"></i>
                    <a href="https://wa.me/01206008819" target="_blank" class="text-white text-decoration-none">01206008819:🌐</a>
                </p>
                <p>
                    <i class="fab fa-whatsapp me-2 text-success"></i>
                    <a href="https://wa.me/01039143554" target="_blank" class="text-white text-decoration-none">01039143554:🌐</a>
                </p>
                   <p>
                    <i class="fab fa-phone me-2 text-success"></i>
                <a href="01100288030" target="_blank" class="text-white text-decoration-none">01097692950:📞</a>
                </p>
                  <p>
                    <i class="fab fa-phone me-2 text-success"></i>
                <a href="01097692950" target="_blank" class="text-white text-decoration-none">01097692950:📞</a>
                </p>
                <p>
                <i class="fab fa-phone me-2 text-success"></i>
                <a href="01022093223" target="_blank" class="text-white text-decoration-none">01022093223:📞</a>
                </p>
                
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 text-center">
                <h5 class="text-uppercase fw-bold text-warning mb-3">تابعنا🤝</h5>
            
                <a href="https://www.facebook.com/share/1Dxc1TeRhr/" target="_blank" class="btn btn-outline-light btn-floating m-1" role="button">
                    <i class="fab fa-facebook-f"></i> الفيسبوك
                </a>
            </div>

        </div>
    </div>

  
    <div class="text-center p-3 border-top border-secondary mt-3">
        © {{ date('Y') }} جميع الحقوق محفوظة للمطعم.<br>
        By/RAMD
    </div>
</footer>


    <!-- Bootstrap & JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Live Search JavaScript Code
      document.addEventListener('DOMContentLoaded', function () {
          const input = document.getElementById('live-search-input');
          const box = document.getElementById('search-results-box');
          let timer;

          input.addEventListener('input', function () {
              clearTimeout(timer);
              const q = this.value.trim();
              if (q.length === 0) { box.classList.add('d-none'); box.innerHTML = ''; return; }

              timer = setTimeout(() => {
                  fetch(`/live-search?query=${encodeURIComponent(q)}`)
                      .then(res => res.json())
                      .then(data => {
                          box.innerHTML = '';
                          if (data.categories.length === 0 && data.meals.length === 0) {
                              box.innerHTML = `<div class="list-group-item text-muted text-center">لا توجد نتائج</div>`;
                          } else {
                              data.categories.forEach(c => {
                                  box.innerHTML += `<a href="/category/${c.slug}" class="list-group-item list-group-item-action fw-bold bg-light">📌 قسم: ${c.name}</a>`;
                              });
                              data.meals.forEach(m => {
                                  box.innerHTML += `
                                      <div class="list-group-item d-flex align-items-center justify-content-between">
                                          <div><strong>${m.name}</strong> - <span class="text-success">${m.price} ج.م</span></div>
                                          <form action="/cart/add/${m.id}" method="POST" class="m-0">
                                              <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                              <button class="btn btn-warning btn-sm">🛒 إضافة</button>
                                          </form>
                                      </div>`;
                              });
                          }
                          box.classList.remove('d-none');
                      });
              }, 300);
          });
      });
    </script>
</body>
</html>