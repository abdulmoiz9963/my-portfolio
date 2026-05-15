<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Project;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
        // Stream the file content from Cloudinary and serve it as a download
        $fileContent = file_get_contents($cvPath);

        if ($fileContent === false) {
            return back()->with('error', 'Could not fetch CV. Please try again.');
        }

        return response($fileContent, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Abdul_Moiz_Ashraf_CV.pdf"',
        ]);
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

    $data = $request->only(['name', 'email', 'subject', 'message']);

    try {
        Mail::send([], [], function ($mail) use ($data) {
            $mail->to(config('mail.from.address'))
                 ->replyTo($data['email'], $data['name'])
                 ->subject('Portfolio Contact: ' . $data['subject'])
                 ->html("
                    <div style='font-family: Arial, sans-serif; max-width: 600px;'>
                        <h2 style='color: #6c63ff;'>New Contact Message</h2>
                        <p><strong>Name:</strong> {$data['name']}</p>
                        <p><strong>Email:</strong> {$data['email']}</p>
                        <p><strong>Subject:</strong> {$data['subject']}</p>
                        <p><strong>Message:</strong></p>
                        <div style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>
                            {$data['message']}
                        </div>
                    </div>
                 ");
        });
    } catch (\Exception $e) {
        \Log::error('Mail error: ' . $e->getMessage());
        return back()->with('error', 'Could not send message. Please email me directly at ' . config('mail.from.address'));
    }

    return back()->with('success', 'Thanks! Your message has been sent.');
}
}
