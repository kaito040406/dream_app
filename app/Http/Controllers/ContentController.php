<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\content;
use Validator;
class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();
        $user = Auth::user();
        $params = [
            'user' => $user,
            'content' => $contents,
        ];
        return view('contents.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = new Content;
        $form = $request->all();

        // 最低限なバリデーション処理です。ここでは特に説明はしません。
        $rules = [
            'user_id' => 'integer|required', // 2項目以上条件がある場合は「 | 」を挟む
            'title' => 'required',
            'body' => 'required',
        ];
        $body = [
            'user_id.integer' => 'System Error',
            'user_id.required' => 'System Error',
            'title.required'=> 'タイトルが入力されていません',
            'body.required'=> 'メッセージが入力されていません'
        ];
        $validator = Validator::make($form, $rules, $body);

        if($validator->fails()){
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }else{
            unset($form['_token']);
            $content->user_id = $request->user_id;
            $content->title = $request->title;
            $content->body = $request->body;
            $content->save();
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $content_id)
    {
        $content = Content::find($content_id);
        $user = Auth::user();
        $params = [
            'user' => $user,
            'content' => $content,
        ];
        return view('contents.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $content_id)
    {
        $content = Content::find($content_id);
        $form = $request->all();

        // 最低限なバリデーション処理です。ここでは特に説明はしません。
        $rules = [
            'user_id' => 'integer|required', // 2項目以上条件がある場合は「 | 」を挟む
            'title' => 'required',
            'body' => 'required',
        ];
        $body = [
            'user_id.integer' => 'System Error',
            'user_id.required' => 'System Error',
            'title.required'=> 'タイトルが入力されていません',
            'body.required'=> 'メッセージが入力されていません'
        ];
        $validator = Validator::make($form, $rules, $body);

        if($validator->fails()){
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }else{
            unset($form['_token']);
            $content->user_id = $request->user_id;
            $content->title = $request->title;
            $content->body = $request->body;
            $content->save();
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $content_id)
    {
        $content = Content::find($content_id);
        $content->delete();
        return redirect('/');
    }

    public function delete($user_id, $content_id)
    {
        $content = Content::find($content_id);
        $user = Auth::user();
        $params = [
            'user' => $user,
            'content' => $content,
        ];
        return view('contents.delete', $params);
    }
}
