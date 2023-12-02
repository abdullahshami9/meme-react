<?php

namespace App\Http\Controllers;

use App\Repository\IReactionRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    protected IReactionRepo $reactionRepo;
    public function __construct(IReactionRepo $iReactionRepo){
        $this->reactionRepo = $iReactionRepo;
    }

    public function add_reaction(Request $request): JsonResponse{
        $response = $this->reactionRepo->add_reaction($request);
        return new JsonResponse([
            'status' => ($response) ? 200 : 201,
            'response' => $response
        ]);
    }

    public function get_reaction(Request $request): JsonResponse{
        $reaction_count = $this->reactionRepo->get_reaction($request->post_id);
        return new JsonResponse([
            'status' => ($reaction_count) ? 200 : 201,
            'count' =>  ($reaction_count) ? $reaction_count : null
        ]);
    }

}
