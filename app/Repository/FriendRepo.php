<?php 
namespace App\Repository;

use App\Models\friend;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FriendRepo implements IFriendRepo{

    public function search(Request $request) : JsonResponse{
        // $query = $request->input('query');
        $query = $request->search;

        $results = Profile::select('id','user_id_fk','username','city_id_fk')
        ->where('username', 'like', "%$query%")
        // ->join("profile","id","=","")
        ->get();

        return new JsonResponse([
            'status' => 200,
            'message'=> $results
        ]);
    }

    public function create(Request $request) : JsonResponse{
        if ($request->isMethod('post')) {
            # code...
            $myProfileId = $request->my_profile_id;
            $myFriend_profileId = $request->my_friend_profile_id;
            $status = "Pending";
            
            if (($myProfileId) > 0 && ($myFriend_profileId != $myProfileId) && isset($myFriend_profileId) && isset($myProfileId)) {
                # code...
                $friend = new friend();
                $friend->my_profile_id_fk = $myProfileId;
                $friend->my_friend_profile_id_fk = $myFriend_profileId;
                $friend->is_status = $status;
                $result = $friend->save();
            }
            else{
                $result = false;
            }
            
            $status = ($result) ? 200 : 201;
            return new JsonResponse([
                "status"=> $status,
                "message"=> $result
                ]);
                
        }else{
            return new JsonResponse([
                "status"=> 400,
                "message"=> "Your Request is not post"
                ]);
        }
    }

    public function update(Request $request) : JsonResponse{
        if ($request->isMethod("post")) {
            $myProfileId = $request->my_profile_id;
            $myFriend_profileId = $request->my_friend_profile_
            ->my_friend_profile_id;
            $status = player_status($myFriend_profileId);
            $friend = new friend();
            $friend->my_profile_id_fk = $myProfileId;
            $friend->my_friend_profile_id_
            = $myFriend_profileId;
            $friend->is_status = $status;
            $friend->save();
        }
    }
}