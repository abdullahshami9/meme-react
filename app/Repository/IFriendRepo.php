<?php 

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface IFriendRepo{
    public function search(Request $request): JsonResponse;
    public function create(Request $request): JsonResponse;
    public function update(Request $request): JsonResponse;
    public function friendList(Request $request) : JsonResponse;
    public function friendList_remove(Request $request) : JsonResponse;
}