@extends('layouts.default')
@section('title', 'ToDo更新')
@section('content')

<!-- フォーム -->
<form action="{{ route('update', ['todo' => $todo->id])}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="py-2">
    <div class="container">
      <h3 class="pb-3">ToDo更新</h3>

      <!-- タイトル -->
      <div class="pb-4 form-group row">
        <label for="title" class="col-md-2 col-form-label font-weight-bold ">
          タイトル
          <span class="badge bg-warning text-black">必須</span>
        </label>
        <div class="col-md-6">
          <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title"  value="{{ old('title', $todo->title) }}" >
        </div>
        <div class="col-md-4">
        @if($errors->has('title'))
          <p class="text-danger">*{{ $errors->first('title') }}</p>
        @endif
        </div>
      </div>

      <!-- 内容 -->
      <div class="pb-4 form-group row">
        <label for="content" class="col-md-2 col-form-label font-weight-bold ">
          内容
        </label>
        <div class="col-md-6">
          <textarea class="form-control @error('content') is-invalid @enderror" type="text" name="content" id="content" rows="5" placeholder="ToDo内容を入力">{{ old('content', $todo->content) }}</textarea>
        </div>
        <div class="col-md-4">
        @if($errors->has('content'))
          <p class="text-danger">*{{ $errors->first('content') }}</p>
        @endif
        </div>
      </div>

      <!-- カテゴリ -->
      <div class="pb-4 form-group row">
        <label for="category" class="col-md-2 col-form-label font-weight-bold">
          カテゴリ
          <span class="badge bg-warning text-black">必須</span>
        </label>

        <div class="col-md-2">
          <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
            <option value=""></option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if( $category->id == old('category_id', $todo->category_id)) selected @endif>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          @if($errors->has('category_id'))
          <p class="text-danger">*{{ $errors->first('category_id') }}</p>
          @endif
        </div>
      </div>

      <!-- 状態 -->
      <div class="pb-4 form-group row">
        <label for="category" class="col-md-2 col-form-label font-weight-bold">
            状態
          <span class="badge bg-warning text-black">必須</span>
        </label>

        <div class="col-md-2">
          <select class="form-select" name="status" id="status">
            <option @if("0" == old('status', $todo->status)) selected @endif value="0">未着手</option>
            <option @if("1" == old('status', $todo->status)) selected @endif value="1">進行中</option>
            <option @if("2" == old('status', $todo->status)) selected @endif value="2">完了</option>
          </select>
        </div>
        <div class="col-md-4">
          @if($errors->has('status'))
          <p class="text-danger">*{{ $errors->first('status') }}</p>
          @endif
        </div>
      </div>

      <!-- 期限 -->
      <div class="form-group pb-4 row">
        <label for="time_limit" class="col-md-2 col-form-label font-weight-bold">
          期限
          <span class="badge bg-warning text-black">必須</span>
        </label>
        <div class="col-md-2">
          <input type="date" class="form-control @error('time_limit') is-invalid @enderror" name="time_limit" id="time_limit" value="{{ old('time_limit', $todo->time_limit) }}">
        </div>
        <div class="col-md-4">
          @if($errors->has('time_limit'))
          <p class="text-danger">*{{ $errors->first('time_limit') }}</p>
          @endif
        </div>
      </div>
    </div>

    <!-- 更新ボタン -->
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <button type="submit" class="btn btn-success" style="width:120px">
              <i class="fa-solid fa-pen-to-square"></i>
              更新
            </button>
          </div>
          <div class="col-md-2 ">
            <button type="button" class="btn btn-secondary" style="width:120px" onclick="location.href='/'">
              <i class="fas fa-arrow-alt-circle-left"></i>
              戻る
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
<script>
  $('#js-pulldown').select2();

</script>
  @endsection
