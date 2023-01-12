@extends('layouts.default')
@section('title', 'ToDoリスト')

@section('content')

<section>
  <form action="{{ route('show')}}" method="GET" enctype="multipart/form-data">
  @csrf
  <div class="py-2">
    <div class="container">
      <h3 class="pb-3">ToDoリスト検索</h3>
        <!-- タイトル -->
        <div class="form-group pb-4 row">
          <label for="search_title" class="col-md-2 col-form-label font-weight-bold">タイトル</label>
          <div class="col-md-4">
            <input type="text" class="form-control " name="search_title" id="search_title" value="{{ old('search_title', Session::get('search_title')) }}">
          </div>
        </div>

        <!-- カテゴリ -->
        <div class="form-group row pb-4">
          <label for="search_category_id" class="col-md-2 col-form-label font-weight-bold">カテゴリ</label>
          <div class="col-md-2 dropdown">
            <select class="form-select" name="search_category_id" id="search_category">
              <option selected value=""></option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}" @if( $category->id == old('search_category_id', Session::get('search_category_id'))) selected @endif>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- 状態 -->
        <div class="form-group row pb-4">
          <label for="search_status" class="col-md-2 col-form-label font-weight-bold">状態</label>
          <div class="col-md-2 dropdown">

<!--                <button class="btn btn-primary dropdown-toggle" type="button" id="search_status" data-bs-toggle="dropdown" aria-expanded="false">状態を選択</button>
                  <ul class="dropdown-menu" aria-labelledby="search_status">
                    <li><button class="dropdown-item" type="button" name="未着手" value="0">未着手</button></li>
                    <li><button class="dropdown-item" type="button" name="進行中" value="1">進行中</button></li>
                    <li><button class="dropdown-item" type="button" name="完了" value="2">完了</button></li>
                  </ul>
-->

            <select class="form-select" name="search_status" id="search_status">
              <option selected value=""></option>
              <option @if("0" == old('search_status', Session::get('search_status'))) selected @endif value="0">未着手</option>
              <option @if("1" == old('search_status', Session::get('search_status'))) selected @endif value="1">進行中</option>
              <option @if("2" == old('search_status', Session::get('search_status'))) selected @endif value="2">完了</option>
            </select>
          </div>
        </div>

        <!-- 期限 -->
        <div class="form-groupp b-4 row">
          <label for="search_time_limit" class="col-md-2 col-form-label font-weight-bold">期限</label>
          <div class="col-md-2">
            <input type="date" class="form-control " name="search_time_limit" id="search_time_limit" value="{{ old('search_time_limit', Session::get('search_time_limit')) }}">
          </div>
        </div>

        <!-- 検索ボタン、クリアボタン -->
        <div class="row justify-content-end">
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary" style="width:120px" onclick="location.href='{{ route('show') }}'">
              <i class="fas fa-search"></i>検索
            </button>

            <button type="button" id="btnClear" class="btn btn-secondary" style="width:120px">
              <i class="fas fa-sync-alt"></i>クリア
            </button>
          </div>
        </div>
      </div>
    </div>

    <br>

    <!-- 登録ボタン -->
    <div class="container">
      <div class="pt-4 row">
        <div class="col-md-12">
          <button type="button" class="btn btn-success" style="width:120px" onclick="location.href='{{ route('create') }}'">
            <i class="fas fa-plus"></i>登録
          </button>
        </div>
      </div>
    </div>
  </form>

    <div class="py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <section id="goods_list">
              <h3>ToDoリスト</h3>
              <!-- ToDoリストの表 -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 3%">#</th>
                    <th style="width: 30%">タイトル</th>
                    <th style="width: 10%">カテゴリ</th>
                    <th style="width: 10%">状態</th>
                    <th style="width: 20%">期限</th>
                    <th style="width: 20%">操作</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($todos as $todo)
                  <tr>
                    <td class="align-middle">{{ $loop->index+1 }}</td>
                    <td class="align-middle">
                      <a href='{{ route('reference', ['todo' => $todo->id]) }}' class="text-decoration-none link-primary" > {{ $todo->title }}</a>
                      {{-- <a href="javascript:void(0)" tabindex="0"  data-bs-container="body" data-bs-toggle="popover"  data-bs-placement="top" data-bs-content="{{ $todo->content }}">{{ $todo->title }}</a> --}}
                      {{-- <a href="javascript:void(0)" class="text-decoration-none link-primary" data-bs-todoTitle={{ $todo->title }} data-bs-todoContent={{ $todo->content }} data-bs-toggle="modal" data-bs-target="#referenceModal"> {{ $todo->title }}</a> --}}
                    </td>

                    <!-- Todo内容確認モーダル -->
                    {{-- <div class="modal fade" id="referenceModal" tabindex="-1" aria-labelledby="referenceModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-todoTitle" id="referenceModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-todoContent">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                          </div>
                        </div>
                      </div>
                    </div> --}}

                    <td class="align-middle">{{ $todo->category->name }}</td>
                    <td class="align-middle">
                      @foreach(config('constants.status') as $key => $value)
                      @if ($key == $todo->status)
                        {{ $value }}
                      @endif
                      @endforeach
                    </td>
                    <td class="align-middle">{{ $todo->time_limit }}</td>
                    <td class="align-middle">
                      <div class="row">
                      <form action="{{ route('destroy', ['todo' => $todo->id])}}" method="POST" >
                        @csrf
                        @method('DELETE')

                      <button type="button" class="btn btn-primary" onclick="location.href='{{ route('edit', ['todo' => $todo->id]) }}'">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                      <button type="submit" class="btn btn-danger" onclick='return confirm("削除してもよろしいですか？");'>
                        <i class="fas fa-trash"></i>
                      </button>

                      {{-- <form action="" method="POST" name="deleteForm">

                        <button type="button" class="btn btn-danger" data-bs-title={{ $todo->title }} data-bs-id={{ $todo->id }} data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i>
                          </button>

                        <!-- 削除用モーダル -->
                        <div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">確認</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">削除</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                              </div>
                            </div>
                          </div>
                        </div> --}}


                      </form>
                    </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- ▼▼▼▼ページャー▼▼▼▼　-->
        {{ $todos->appends(request()->query())->links()}}
        <!-- ▲▲▲▲ページャー▲▲▲▲　-->
      </div>
    </div>
</section>

<script type="text/javascript">

    // クリアボタン押下時
    $(function(){
    $("#btnClear").click(function() {
            $("#search_title").val("");
            $("#search_category").val("");
            $("#search_status").val("");
            $("#search_time_limit").val("");
          });
    });

//     // 削除ボタン押下時
//     const deleteModal = document.getElementById('deleteModal')
//     deleteModal.addEventListener('show.bs.modal', event => {
//       // モーダルを起動するボタン
//       const button = event.relatedTarget
//       // data-bs-* 属性から情報を抽出
//       const recipient = button.getAttribute('data-bs-title')

//       const id = button.getAttribute('data-bs-id')

// alert(id)
// const deleteForm = document.getElementById("deleteForm");


//       // モーダルの内容を更新
//       const modalBody = deleteModal.querySelector('.modal-body')
//       modalBody.textContent = '「' + recipient + '」' + ' を削除してもよろしいですか？';

//       deleteForm.action = "{{ route('destroy', ['todo' =>" + id + "])}}";

//       deleteForm.submit();
//     })
// function deleteConfirm(title) {

//     if (window.confirm(title + "を削除してもよろしいですか？")) {
//       // location.href = "hoge.php";
//     } else {
//       return false;
//     }
//   }

    </script>
@endsection
