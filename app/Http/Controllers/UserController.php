<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\content;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $contents = Content::where('user_id', $id)->get();
        $params = [
            'user' => $user,
            'contents' => $contents 
        ];

        return view('users.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $form = $request->all();

        if($request->icon != null){
            $rules = [
                'name' => 'required',
                'intro' => 'required',
                // 'icon' => [
                //     // 必須
                //     'required',
                //     // アップロードされたファイルであること
                //     'file',
                //     // 画像ファイルであること
                //     'image',
                //     // MIMEタイプを指定
                //     'mimes:jpeg,png',
                // ],
            ];
        }else{
            $rules = [
                'name' => 'required',
                'intro' => 'required',
            ];
        }
        $body = [
            'name.required'=> '名前が入力されていません',
            'intro.required'=> '自己紹介が入力されていません'
        ];
        $validator = Validator::make($form, $rules, $body);

        if($validator->fails()){
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }else{
            unset($form['_token']);
            $user->name = $request->name;
            $user->intro = $request->intro;
            $user->birth_year = $request->birth_year;
            $user->birth_month = $request->birth_month;
            $user->birth_day = $request->birth_day;
            if($request->icon != null){
                $filename = $request->file('icon')->store('public/avatar');
                $user->icon = basename($filename);
            }
            $user->save();
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
