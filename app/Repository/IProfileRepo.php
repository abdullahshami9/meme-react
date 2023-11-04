<?php 

namespace App\Reposity;

use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

interface IProfileRepo{
    public function search(Request $request): JsonResponse;
    public function create(Request $request): JsonResponse;
    public function update(Request $request, $id): JsonResponse;
}