<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;

class VotingController extends Controller
{
    public function index()
    {
        $paslon = Candidate::all();
        return view('voting.index', compact('paslon'));
    }

    public function submit(Request $request)
    {
        if (auth()->user()->has_voted) {
            return back()->with('error', 'Anda sudah melakukan voting!');
        }

        Vote::create([
            'user_id' => auth()->id(),
            'candidate_id' => $request->candidate_id,
        ]);

        auth()->user()->update(['has_voted' => 1]);

        return redirect()->route('voting.success', [
            'id' => $request->candidate_id
        ]);
    }

    // <-- tambahkan ini
    public function success($id)
    {
        $paslon = Candidate::findOrFail($id);
        return view('voting.success', compact('paslon'));
    }
}
