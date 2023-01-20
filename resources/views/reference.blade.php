@extends('layouts.default')
@section('title', 'ToDo確認')
@section('content')

<!-- フォーム -->
<form action="" method="POST" >
  <div class="py-2">
    <div class="container">
      <h3 class="pb-3">ToDo確認</h3>

      <!-- タイトル -->
      <div class="pb-4 form-group row">
        <label for="title" class="col-md-2 col-form-label font-weight-bold ">
          タイトル
        </label>
        <div class="col-md-6">
          {{ old('title', $todo->title) }}
        </div>
      </div>

      <!-- 内容 -->
      <div class="pb-4 form-group row">
        <label for="content" class="col-md-2 col-form-label font-weight-bold ">
          内容
        </label>
        <div class="col-md-6 text-break" >
          {{ old('content', $todo->content) }}
        </div>
      </div>

      <!-- カテゴリ -->
      <div class="pb-4 form-group row">
        <label for="category" class="col-md-2 col-form-label font-weight-bold">
          カテゴリ
        </label>

        <div class="col-md-2">
          @foreach($categories as $category)
            @if( $category->id == old('category_id', $todo->category_id)) {{ $category->name }} @endif
          @endforeach
        </div>
      </div>

      <!-- 状態 -->
      <div class="pb-4 form-group row">
        <label for="category" class="col-md-2 col-form-label font-weight-bold">
          状態
        </label>

        <div class="col-md-2">
          @if("0" == old('status', $todo->status)) 未着手 @endif
          @if("1" == old('status', $todo->status)) 進行中 @endif
          @if("2" == old('status', $todo->status)) 完了 @endif
        </div>
      </div>

      <!-- 期限 -->
      <div class="form-group pb-4 row">
        <label for="time_limit" class="col-md-2 col-form-label font-weight-bold">
          期限
        </label>
        <div class="col-md-2">
          {{ old('time_limit', $todo->time_limit) }}
        </div>
      </div>
    </div>

    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-11 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-secondary" style="width:120px" onclick="location.href='/back'">
              <i class="fas fa-arrow-alt-circle-left"></i>
              戻る
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
  @endsection
