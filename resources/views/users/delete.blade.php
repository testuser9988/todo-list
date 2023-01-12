<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title', 'ToDoリスト')</title>
    <meta charset="utf-8">
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="js/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/select2.min.css">
    <script src="/js/select2.min.js"></script>



</head>
<section>
    <div class="py-2">
        <div class="container">
            <h3 class="pb-3">退会の確認</h3>
            <div class="card-body pb-4">
                <p class="card-text">退会をすると投稿も全て削除されます。</p>
                <p class="card-text">それでも退会をしますか？</p>
            </div>


        <form action="{{ route('users.destroy')}}" method="POST" >
            @csrf
            @method('DELETE')
            <div class="pb-4">
                <button type="submit" class="btn btn-danger">退会する</button>
            </div>
        </form>
        <div class="pb-4">
          <a href="/" class="btn btn-primary">キャンセルする</a>
        </div>

    </div>
{{-- <div class="container">
    <div class="card border-dark mb-3">
        <div class="card-header">
          <h3>退会の確認</h3>
        </div>
      <div class="card-body">
        <p class="card-text">退会をすると投稿も全て削除されます。</p>
        <p class="card-text">それでも退会をしますか？</p>
      </div>
    </div>

    <div class="btn-group">
        <form action="{{ route('users.destroy')}}" method="POST" >
            @csrf
            @method('DELETE')
          <button type="submit" class="btn btn-danger">退会する</button>
        </form>

        <div class="ml-3">
          <a href="/" class="btn btn-primary">キャンセルする</a>
        </div>
    </div>
</div> --}}

</section>
