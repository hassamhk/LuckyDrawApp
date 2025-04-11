<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipationResource;
use App\Models\Participation;
use Illuminate\Http\Request;

class ParticipationApiController extends Controller
{
    public function index(Request $request)
    {
        $participations = Participation::where('user_id', $request->user()->id)
            ->with('product')
            ->latest()
            ->get();

        return ParticipationResource::collection($participations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = $request->user();

        $exists = Participation::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already participated'], 409);
        }

        $participation = Participation::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);

        return new ParticipationResource($participation);
    }
}
