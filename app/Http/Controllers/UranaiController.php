<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Content;
use App\Uranai;
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
}