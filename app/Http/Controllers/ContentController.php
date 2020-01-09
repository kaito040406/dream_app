<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Content;
use App\Graph;
use Validator;
use Carbon\Carbon;
use Log;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $check_user = User::find($id);
        $now_user = Auth::user();
        if($check_user == null){
            return redirect()->action('ContentController@index', ['id' => $now_user->id]);
        }
        elseif($check_user->$id == $now_user->$id){
            $user = $check_user;
        }
        else{
            return redirect()->action('ContentController@index', ['id' => $now_user->id]);
        }
        $contents = Content::all();
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
        $rules = [
            'user_id' => 'integer|required',
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
            return redirect("/users/$content->user_id");
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
        $check_user = User::find($user_id);
        $now_user = Auth::user();
        $content = Content::find($content_id);
        if($check_user == null){
            return redirect()->action('ContentController@edit', ['user_id' => $now_user->id, 'content_id' => $content_id]);
        }
        elseif($check_user == $now_user){
            $user = $check_user;
        }
        else{
            return redirect()->action('ContentController@edit', ['user_id' => $now_user->id, 'content_id' => $content_id]);
        }

        if($content->user_id != $user->id){
            return redirect()->action('UserController@show', ['id' => $now_user->id]);
        }

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
        $graph_data = Graph::where('content_id',$content_id);
        $form = $request->all();
        $rules = [
            'user_id' => 'integer|required',
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
            $graph_data ->delete();
            return redirect("/users/$id");
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
        $check_user = User::find($user_id);
        $now_user = Auth::user();
        $content = Content::find($content_id);
        $graph_data = Graph::where('content_id',$content_id);
        
        if($check_user == null){
            return redirect()->action('UserController@show', ['id' => $now_user->id]);
        }
        elseif($check_user == $now_user){
            $user = $check_user;
        }
        else{
            return redirect()->action('UserController@show', ['id' => $now_user->id]);
        }
        if($content->user_id != $user->id){
            return redirect()->action('UserController@show', ['id' => $now_user->id]);
        }

        $content->delete();
        $graph_data ->delete();
        return redirect("/users/$user_id");
    }

    public function delete($user_id, $content_id)
    {
        $check_user = User::find($user_id);
        $now_user = Auth::user();
        $content = Content::find($content_id);
        
        if($check_user == null){
            return redirect()->action('ContentController@delete', ['user_id' => $now_user->id, 'content_id' => $content_id]);
        }
        elseif($check_user == $now_user){
            $user = $check_user;
        }
        else{
            return redirect()->action('ContentController@delete', ['user_id' => $now_user->id, 'content_id' => $content_id]);
        }
        if($content->user_id != $user->id){
            return redirect()->action('UserController@show', ['id' => $now_user->id]);
        }

        $params = [
            'user' => $user,
            'content' => $content,
        ];
        return view('contents.delete', $params);
    }
    public function ajax_new_content_json(Request $request) {

        $content = new Content;
        $form = $request->all();
        $rules = [
            'user_id' => 'required',
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
            $json = array(
                "message" => "エラー"
            );
        }else{
            // unset($form['_token']);
            $content->user_id = $request->user_id;
            $content->title = $request->title;
            $content->body = $request->body;
            $content->save();
            $user = User::find($request->user_id);
            $now = Carbon::now()->format('Y年m月d日');
            $new_content = Content::where('user_id',$request->user_id)->orderBy('created_at', 'desc')->first();
            $json = array(
                "message" => "投稿完了",
                "data" => $new_content,
                "day" => $now,
                "user" => $user
            );
        }
        
        return $json;
    }
}
