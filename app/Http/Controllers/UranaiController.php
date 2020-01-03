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
        $export = array();
        $pre_export = array();
        $per_edit_export = array();
        $i = 0;
        $k = 0;
        foreach($request->check_texts as $request_data){
            if($request_data=='夢'){
            }elseif($request_data=='見'){
            }else{
                // Log::debug($request_data);
                // $select_uranai[] = Uranai::where('title', 'LIKE' , "%$request_data%")->get();
                // $selects_uranai[] = $select_uranai[];
                $selects_uranai[] = Uranai::where('title', 'LIKE' , "%$request_data%")->get(); 
            }
        }


        foreach($selects_uranai as $change_step1){
            $cnt_change_step1 = count($change_step1);
            if($cnt_change_step1 != 0){
                foreach($change_step1 as $change_step2){
                    $selects_uranai_changed[$k] = $change_step2;
                    $test[$k] = $change_step2;
                    // $selects_uranai_changed[$k] = $test[$k];
                    // Log::debug($change_step2);
                    // Log::debug($selects_uranai_changed[$k]);
                    // Log::debug($test[$k]);
                    // Log::debug($k);
                    $k = $k + 1;
                }
            }
            else{
                $selects_uranai_changed = "no_data";
            }
        }
        
        if($selects_uranai_changed != "no_data"){
            foreach($test as $duplication_check){
                $pre_export[$i] = $duplication_check;
                $per_edit_export[$i] = $pre_export[$i];
                if($i == 0 or $i == 1){
                }
                else{
                    $cnt = count($pre_export);
                    $cnt2 = $cnt - 1;
                    $esc = $per_edit_export[$i];
                    unset($per_edit_export[$i]);
                    foreach($per_edit_export as $post_export){
                        if($post_export->id == $duplication_check->id){
                            $export[] = $duplication_check;
                        }
                    }
                    $per_edit_export[$i] = $pre_export[$i];
                }
                $i = $i + 1;
            }
        }
        else{
            $export[] = ["no_data"];
        }
        $json = array(
            "hit_dreams" => $export,
        );
        $return_data = json_encode($json);
        return $json;
    }

    public function ajax_post_json(Request $request) {
        $content = Graph::where('content_id', $request->content_id)->get();
        $cnt = count($content);
        if ($cnt == 0){
            $user = Auth::user();
            $input_data = new Graph;
            $input_data->element_point = $request->ave;
            $input_data->user_id = $user->id;
            $input_data->content_id = $request->content_id;
            $input_data->save();
            $json = array(
                "message" => "診断完了です"
            );
        }
        else{
            $json = array(
                "message" => "診断済みです"
            );
        }
        return $json;
    }

    public function ajax_graph_json(Request $request){
        
        $user = User::find($request->id);
        $current_user = Auth::user();
        
        if($user->id == $current_user->id){
            $elemets_data = Graph::where('user_id', $user->id)->get();
            $json = array(
                "message" => "取得成功",
                "data" => $elemets_data
            );
        }
        else{
            $json = array(
                "message" => "エラー"
            );
        }
        
        return $json;
    }
}