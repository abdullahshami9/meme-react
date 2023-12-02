<?php 

namespace App\Repository;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReactionRepo implements IReactionRepo{
    public function add_reaction(Request $request){
        
        $existingReaction = Reaction::where([
            'post_id_fk' => $request->post_id_fk,
            'profile_id_fk' => $request->profile_id_fk
            ])
            ->first();
    
        if ($existingReaction) {
            // User has already reacted to this post
            return false;
        }
    
        // User has not reacted to this post, proceed with saving the reaction
        $reaction = new Reaction;
        $reaction->reaction_type_id_fk = $request->reaction_type_id_fk;
        $reaction->post_id_fk = $request->post_id_fk;
        $reaction->profile_id_fk = $request->profile_id_fk;
    
        return $reaction->save();
    }

    public function get_reaction($post_id) {

        $data= [];
        if($post_id){
            $count = Reaction::where([
                'post_id_fk' => $post_id
            ])
            ->count();

            $data['count'] = $count;
        }

        return $data['count'];
    }
    
}