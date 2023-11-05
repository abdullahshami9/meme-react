<?php

namespace App\Http\Controllers;

use App\Repository\IFriendRepo;
use Illuminate\Http\Request;


class FriendController extends Controller
{
    private IFriendRepo $friendRepo;
    public function __construct(IFriendRepo $friendRepo){
        $this->friendRepo = $friendRepo;
    }
    public function search(Request $request)
    {
        return $this->friendRepo->search($request);
    }
    public function send_hommy_request(Request $request){
        return $this->friendRepo->create($request);
    }

    public function updateFriendRequest(Request $request){
        return $this->friendRepo->update($request);
    }

}
