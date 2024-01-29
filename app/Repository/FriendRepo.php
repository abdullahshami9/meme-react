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
        ->limit(7)
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

    public function update(Request $request): JsonResponse
{
    if ($request->isMethod("post")) {
        $myProfileId = $request->my_profile_id;
        $myFriendProfileId = $request->my_friend_profile_id;

        // Check if the friendship already exists
        $existingFriendship = Friend::where('my_profile_id_fk', $myProfileId)
            ->where('my_friend_profile_id_fk', $myFriendProfileId)
            ->first();

        if ($existingFriendship) {
            // Friendship already exists
            if ($existingFriendship->is_status == 'hommy') {
                return response()->json(['message' => 'You\'re already homies']);
            }

            // Update status based on request param
            $newStatus = $request->status;
            if ($newStatus == 'confirm') {
                $existingFriendship->is_status = 'Hommy';
            } elseif ($newStatus == 'blocked') {
                $existingFriendship->is_status = 'Blocked';
            }
            else{
                $existingFriendship->is_status = $request->status;
            }

            $existingFriendship->save();
        } else {
            // Friendship doesn't exist, create a new one
            $friend = new Friend();
            $friend->my_profile_id_fk = $myProfileId;
            $friend->my_friend_profile_id_fk = $myFriendProfileId;
            $friend->is_status = $request->input('status'); // Set status directly from request param
            $friend->save();
        }

        return response()->json(['message' => 'Friendship updated successfully']);
    }
}

    public function friendList(Request $request): JsonResponse{
        if ($request->isMethod("post")) {
            $my_profile_id = $request->my_profile_id;
            $myFriend = friend::select('username', 'friends.my_friend_profile_id_fk','profile_img_url','bio','is_status')
            ->join('profile', 'friends.my_friend_profile_id_fk', '=', 'profile.id')
            ->where('friends.my_profile_id_fk', $my_profile_id)
            ->distinct()
            ->get();
            // dd($myFriend);
            return new JsonResponse([
                "status"=> '200',
                'message'=> 'Friend List',
                'list'=> $myFriend
                ]);
        }

    }

    public function friendList_remove(Request $request): JsonResponse
{
    if ($request->isMethod("post")) {
        $my_profile_id = $request->my_profile_id;
        $my_friend_profile_id = $request->my_friend_profile_id; // Assuming you pass the friend's profile id for deletion

        // if ($request->has('delete_friend')) {
            // Delete friend based on my_profile_id and my_friend_profile_id_fk
            friend::where('my_profile_id_fk', $my_profile_id)
                ->where('my_friend_profile_id_fk', $my_friend_profile_id)
                ->delete();

            return new JsonResponse([
                "status" => '200',
                'message' => 'Friend deleted successfully',
            ]);
        // }
        
        //  else {
        //     // Retrieve friend list
        //     $myFriend = friend::select('username', 'friends.my_friend_profile_id_fk', 'profile_img_url', 'bio', 'is_status')
        //         ->join('profile', 'friends.my_friend_profile_id_fk', '=', 'profile.id')
        //         ->where('friends.my_profile_id_fk', $my_profile_id)
        //         ->distinct()
        //         ->get();

        //     return new JsonResponse([
        //         "status" => '200',
        //         'message' => 'Friend List',
        //         'list' => $myFriend,
        //     ]);
        // }
    }
}



}