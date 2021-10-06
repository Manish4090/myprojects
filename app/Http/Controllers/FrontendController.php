<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class FrontendController extends Controller
{
    public function getstates(Request $request){
		dd("sdfsdfssdfsdfd");
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
