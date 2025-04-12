<?php

namespace App\Http\Controllers;

use App\Models\Winner;
use App\Models\Product;
use App\Models\Participation;
use App\Models\User;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $winners = Winner::with(['user', 'product'])->latest()->get();
        return view('backend.winners.index', compact('winners'));
    }
    // Manual Winner Selection
    public function selectManualWinner($productId, Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $product = Product::findOrFail($productId);
        $user = User::findOrFail($request->user_id);

        // Check if the user participated in the product
        $participation = Participation::where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$participation) {
            return response()->json(['message' => 'User did not participate in this product.'], 400);
        }

        // Store Winner
        $winner = Winner::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Winner selected successfully!',
            'winner' => $winner,
        ]);
    }

    // Automatic Winner Selection (Random)
    public function selectRandomWinner($productId)
    {
        $product = Product::findOrFail($productId);

        // Get all participants for the product
        $participants = Participation::where('product_id', $product->id)->get();

        if ($participants->isEmpty()) {
            return response()->json(['message' => 'No participants for this product.'], 400);
        }

        // Randomly select a participant
        $randomParticipant = $participants->random();

        // Store Winner
        $winner = Winner::create([
            'product_id' => $product->id,
            'user_id' => $randomParticipant->user_id,
        ]);

        return response()->json([
            'message' => 'Automatic winner selected successfully!',
            'winner' => $winner,
        ]);
    }
    // Automatic Winner Selection (HASH Function)
    public function selectHashWinner($productId)
    {
        $product = Product::findOrFail($productId);

        $participants = Participation::where('product_id', $product->id)->get();

        if ($participants->isEmpty()) {
            return response()->json(['message' => 'No participants for this product.'], 400);
        }

        // Generate a map of participant ID => hash (CRC32)
        $hashMap = $participants->mapWithKeys(function ($participant) {
            // Combine participant ID and created_at to make it more unpredictable
            $data = $participant->id . $participant->created_at->timestamp;
            $hash = crc32($data); // You can also use md5 or sha1 and convert to int
            return [$participant->id => $hash];
        });

        // Sort by hash value and pick the smallest (or random)
        $sorted = $hashMap->sort();

        // Get winning participant ID (lowest hash wins)
        $winnerId = $sorted->keys()->first();

        // Fetch actual participant model
        $winnerParticipant = $participants->where('id', $winnerId)->first();

        // Store winner
        $winner = Winner::create([
            'product_id' => $product->id,
            'user_id' => $winnerParticipant->user_id,
        ]);

        return response()->json([
            'message' => 'Winner selected using hash-based algorithm!',
            'winner' => $winner,
        ]);
    }

}
