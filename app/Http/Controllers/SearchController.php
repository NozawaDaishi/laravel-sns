<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = User::query();

        //$request->input()で検索時に入力した項目を取得します。
        $search = $request->input('name');

        // ユーザ名入力フォームで入力した文字列を含むカラムを取得します
        if ($request->has('name') && $search != '') {
            $query->where('name', 'like', '%'.$search.'%')->get();
        }

        //ユーザを1ページにつき10件ずつ表示させます
        $data = $query->paginate(10);

        return view('users.search',[
            'data' => $data
        ]);
    }
}
