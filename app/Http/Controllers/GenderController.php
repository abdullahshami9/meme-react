<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function get_gender(){
        $gender = Gender::select()->get();
        return new JsonResponse([
            'status' => 200,
            "gender"=> $gender
        ]);
    }
}
