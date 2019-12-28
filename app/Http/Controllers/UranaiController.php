<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Content;
use App\Uranai;
use Validator;

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

    public function ajax_get_uranai(Request $requests) {
        
    }
}
