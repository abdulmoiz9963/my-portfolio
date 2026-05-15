<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Project;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Mail;

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
        // Email to you (portfolio owner)
        Mail::send([], [], function ($mail) use ($data) {
            $mail->to(config('mail.from.address'))
                 ->replyTo($data['email'], $data['name'])
                 ->subject('Portfolio Contact: ' . $data['subject'])
                 ->html("
                    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                        <h2 style='color: #6c63ff; border-bottom: 2px solid #6c63ff; padding-bottom: 10px;'>
                            New Contact Message
                        </h2>
                        <p><strong>Name:</strong> {$data['name']}</p>
                        <p><strong>Email:</strong> {$data['email']}</p>
                        <p><strong>Subject:</strong> {$data['subject']}</p>
                        <p><strong>Message:</strong></p>
                        <div style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>
                            {$data['message']}
                        </div>
                        <p style='color: #999; font-size: 12px; margin-top: 20px;'>
                            Sent from your portfolio contact form.
                        </p>
                    </div>
                 ");
        });

        // Confirmation email to sender
        Mail::send([], [], function ($mail) use ($data) {
            $mail->to($data['email'], $data['name'])
                 ->subject('Thanks for reaching out, ' . $data['name'] . '!')
                 ->html("
                    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                        <h2 style='color: #6c63ff; border-bottom: 2px solid #6c63ff; padding-bottom: 10px;'>
                            Message Received!
                        </h2>
                        <p>Hi <strong>{$data['name']}</strong>,</p>
                        <p>Thanks for getting in touch! I'll get back to you as soon as possible.</p>
                        <p><strong>Your message:</strong></p>
                        <div style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>
                            {$data['message']}
                        </div>
                        <br>
                        <p>Best regards,<br><strong>Abdul Moiz Ashraf</strong></p>
                        <p style='color: #999; font-size: 12px;'>DevOps Engineer | Lahore, Pakistan</p>
                    </div>
                 ");
        });

    } catch (\Exception $e) {
        return back()->with('error', 'Failed to send message. Please try again or email me directly.');
    }

    return back()->with('success', 'Thanks! Your message has been sent.');
}
}
