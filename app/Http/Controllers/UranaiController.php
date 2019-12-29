<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Content;
use App\Uranai;
use App\Graph;
use Validator;
use Log;

class UranaiController extends Controller
{
    public function ajax_get_json(Request $id) {
        $select_text = Content::find($id);
        $json = array(
            "text" => $select_text,
        );
        $return_data = json_encode($json);
        return $json;
    }

    public function ajax_get_uranai(Request $request) {
        $selects_uranai = array();
        foreach($request->check_texts as $request_data){
            if($request_data=='夢'){
            }elseif($request_data=='見'){
            }else{
                $select_uranai = Uranai::where('title', 'LIKE' , "%$request_data%")->get();
                $selects_uranai[] = $select_uranai;
            }
            
        }
        $json = array(
            "hit_dreams" => $selects_uranai,
        );
        $return_data = json_encode($json);
        return $json;
    }

    public function ajax_post_json(Request $request) {
        $content = Graph::where('content_id', $request->content_id)->get();
        $cnt = count($content);
        Log::debug($cnt);
        if ($cnt == 0){
            $user = Auth::user();
            $input_data = new Graph;
            $input_data->element_point = $request->ave;
            $input_data->user_id = $user->id;
            $input_data->content_id = $request->content_id;
            $input_data->save();
            $json = array(
                "message" => "登録完了"
            );
        }
        else{
            $json = array(
                "message" => "登録済み"
            );
        }
        return $json;
    }
}