<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title', 'ToDoリスト')</title>
    <meta charset="utf-8">
    <!-- Scripts -->
    <script src="js/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<!-- ▼▼▼▼共通ヘッダー▼▼▼▼　-->

<div class="py-3 container">

    <ul class="navbar-nav me-auto mb-2 mb-lg-0 float-end">
      <li class="nav-item dropdown ">
        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{\Auth::user()->name;}}
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/logout">ログアウト</a></li>
          <li><a class="dropdown-item" href="{{ route('users') }}">退会</a></li>
        </ul>
      </li>
    </ul>



  {{-- <div class="float-end ">
    <a href='/logout' class="link-info">ログアウト</a>
  </div> --}}
  {{-- <div class="float-end mx-4">
    <a href='{{ route('users') }}' class="link-secondary">退会</a>
  </div> --}}
</div>
<div class="pt-3 container">
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="閉じる"></button>
    {{ session('success') }}
  </div>
  @endif
</div>
<!-- ▲▲▲▲共通ヘッダー▲▲▲▲　-->

<!-- ▼▼▼▼ページ毎の個別内容▼▼▼▼　-->
<main>
@yield('content')
</main>
<!-- ▲▲▲▲ページ毎の個別内容▲▲▲▲　-->

<!-- ▼▼▼▼共通フッター▼▼▼▼　-->
<div class="py-5 container">
  <div class="small text-end">
      &copy; 2023 sato
  </div>
</div>
<!-- ▲▲▲▲共通フッター▲▲▲▲　-->
</body>
</html>
