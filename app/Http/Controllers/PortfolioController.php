<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Project;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $skills = Skill::orderBy('sort_order')->get()->groupBy('category');
        $experiences = Experience::orderBy('sort_order')->orderByDesc('created_at')->get();
        $projects = Project::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('portfolio.index', compact('profile', 'skills', 'experiences', 'projects'));
    }

    public function downloadCv()
{
    $profile = Profile::first();
    $cvPath = $profile->cv_path ?? null;

    if ($cvPath) {
        // Insert fl_attachment without specifying filename (avoids duplication)
        $downloadUrl = str_replace('/upload/', '/upload/fl_attachment/', $cvPath);
        return redirect($downloadUrl);
    }

    $defaultPath = public_path('cv/Abdul_Moiz_Ashraf_CV.pdf');
    if (file_exists($defaultPath)) {
        return response()->download($defaultPath, 'Abdul_Moiz_Ashraf_CV.pdf');
    }

    return back()->with('error', 'CV not available yet.');
}

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        // Store the contact message in session / or optionally mail
        // You can integrate Mail::to(...) here
        // \App\Models\ContactMessage::create($request->only(['name','email','subject','message']));

        return back()->with('success', 'Thanks! Your message has been sent.');
    }
}
