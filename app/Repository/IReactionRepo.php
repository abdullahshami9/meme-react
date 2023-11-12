<?php 

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface IReactionRepo{
    public function add_reaction(Request $request);
}