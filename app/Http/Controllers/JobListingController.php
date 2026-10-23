<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'seniority' => 'nullable|in:trainee,junior,semi-senior,senior',
            'modality' => 'nullable|in:remote,hybrid,on-site',
        ]);

        $query = JobListing::where('status', 'published');
        $seniority = $validated['seniority'] ?? null;
        $modality = $validated['modality'] ?? null;

        if ($seniority) {
            $query->where('seniority', $seniority);
        }

        if($modality) {
            $query->where('modality',$modality);
        }


        return response()->json(
            $query
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->paginate(5)
        );
    }
}
