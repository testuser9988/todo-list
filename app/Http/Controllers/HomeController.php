<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ToDoリスト一覧画面
     * @param $request 画面情報
     * @return ToDoリスト一覧画面
     */
    public function index()
    {
        session()->put('search_title', "");
        session()->put('search_category_id', "");
        session()->put('search_status', "");
        session()->put('search_time_limit_from', "");
        session()->put('search_time_limit_to', "");

        $todos = Todo::orderBy('time_limit', 'ASC')
        ->where('user_id', '=', \Auth::id())
        ->paginate(10);
        $categories = Category::all();

        return view('index', ['todos' => $todos], compact('categories'));
    }

    /**
     * 新規ToDo登録画面表示
     * @param $request 画面情報
     * @return 初期画面表示
     */
    public function create(Request $request)
    {
        // カテゴリー一覧
        $categories = Category::all();

        return view('create', compact('categories'));
    }

    /**
     * 新規ToDo登録
     * @param $request 画面情報
     * @return ToDoリスト一覧画面
     */
    public function store(StoreTodoRequest $request)
    {
        // 入力チェック
        $insertData = $request->validated();
        // 新規ToDo作成
        $todo = new Todo($insertData);
        $todo->user_id = \Auth::id();
        $todo->status = '0';
        $todo->category_id = $insertData['category_id'];
        $todo->save();

        return to_route('index')->with('success', 'ToDoを登録しました。');
    }

    /**
     * ToDo検索
     * @param $request 画面情報
     * @return ToDoリスト一覧画面
     */
    public function show(Request $request)
    {

        // 検索条件
        $title = $request['search_title'];
        $category_id = $request['search_category_id'];
        $status = $request['search_status'];
        $time_limit_from = $request['search_time_limit_from'];
        $time_limit_to = $request['search_time_limit_to'];

        // 値を保存
        session()->put('search_title', $title);
        session()->put('search_category_id', $category_id);
        session()->put('search_status', $status);
        session()->put('search_time_limit_from', $time_limit_from);
        session()->put('search_time_limit_to', $time_limit_to);

        $query = Todo::query();

        // 検索条件.タイトルが入力されている場合
        if ($title != null && $title != "") {
            $query->where('title', 'LIKE', "%{$title}%");
        }

        // 検索条件.カテゴリが入力されている場合
        if ($category_id != null && $category_id != "") {
            $query->where('category_id', '=', $category_id);
        }

        // 検索条件.状態が入力されている場合
        if ($status != null && $status != "") {
            $query->where('status', '=', $status);
        }

        // 検索条件.期限Fromが入力されている場合
        if ($time_limit_from != null && $time_limit_from != "") {
            $query->where('time_limit', '>=', $time_limit_from);
        }

        // 検索条件.期限Toが入力されている場合
        if ($time_limit_to != null && $time_limit_to != "") {
            $query->where('time_limit', '<=', $time_limit_to);
        }

        $query->where('user_id', '=', \Auth::id());

        $query->orderBy('time_limit', 'ASC')->simplePaginate(10);

        $todos = $query->paginate(10);

        $categories = Category::all();

        return view('index', ['todos' => $todos], compact('categories'));
    }

    /**
     * ToDo更新画面表示
     * @param $id 選択されたToDoのID
     * @return ToDoリスト一覧画面
     */
    public function edit($id)
    {
        $todo = Todo::findOrfail($id);
        $categories = Category::all();

        return view('edit', ['todo' => $todo, 'categories' => $categories]);
    }

    /**
     * ToDo更新
     * @param $request 画面情報
     * @param $id 選択されたToDoのID
     * @return ToDoリスト一覧画面
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        $todo = Todo::findOrfail($id);
        // 入力チェック
        $updateData =$request->validated();

        $todo->category()->associate($updateData['category_id']);

        $todo->update($updateData);

        return to_route('index')->with('success', 'ToDoを更新しました');
    }

    /**
     * ToDo削除
     * @param $id 選択されたToDoのID
     * @return ToDoリスト一覧画面
     */
    public function destroy($id)
    {
        $todo = Todo::findOrfail($id);
        $todo->delete();

        return to_route('show')->with('success', 'ToDoを削除しました');
    }

    /**
     * ToDo参照
     * @param $id 選択されたToDoのID
     * @return ToDo参照画面
     */
    public function reference($id)
    {
        $todo = Todo::findOrfail($id);
        $categories = Category::all();

        return view('reference', ['todo' => $todo, 'categories' => $categories]);
    }

    /**
     * 戻るボタン押下時
     * @param $request 画面情報
     * @return ToDoリスト一覧画面
     */
    public function back(Request $request)
    {

        // 検索条件
        $title = $request->session()->get('search_title');
        $category_id = $request->session()->get('search_category_id');
        $status = $request->session()->get('search_status');
        $time_limit_from = $request->session()->get('search_time_limit_from');
        $time_limit_to = $request->session()->get('search_time_limit_to');

        $query = Todo::query();

        // 検索条件.タイトルが入力されている場合
        if ($title != null && $title != "") {
            $query->where('title', 'LIKE', "%{$title}%");
        }

        // 検索条件.カテゴリが入力されている場合
        if ($category_id != null && $category_id != "") {
            $query->where('category_id', '=', $category_id);
        }

        // 検索条件.状態が入力されている場合
        if ($status != null && $status != "") {
            $query->where('status', '=', $status);
        }

        // 検索条件.期限Fromが入力されている場合
        if ($time_limit_from != null && $time_limit_from != "") {
            $query->where('time_limit', '>=', $time_limit_from);
        }

        // 検索条件.期限Toが入力されている場合
        if ($time_limit_to != null && $time_limit_to != "") {
            $query->where('time_limit', '<=', $time_limit_to);
        }

        $query->where('user_id', '=', \Auth::id());

        $query->orderBy('time_limit', 'ASC')->simplePaginate(10);

        $todos = $query->paginate(10);

        $categories = Category::all();

        return view('index', ['todos' => $todos], compact('categories'));

    }

    /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // ログアウト処理
        Auth::logout();
        // 現在使っているセッションを無効化(セキュリティ対策のため)
        $request->session()->invalidate();
        // セッションを無効化を再生成(セキュリティ対策のため)
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
