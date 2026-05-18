<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function uploadToCloudinary($filePath, $options = [])
    {
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true],
        ]);
        return $cloudinary->uploadApi()->upload($filePath, $options);
    }

    public function dashboard()
    {
        $stats = [
            'projects'       => Project::count(),
            'skills'         => Skill::count(),
            'experience'     => Experience::count(),
            'certifications' => Certification::count(),
            'messages'       => 0,
        ];
        $recentProjects = Project::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function profileEdit()
    {
        $profile = Profile::firstOrNew([]);
        return view('admin.profile.edit', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|max:100',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::firstOrNew([]);
        $data = $request->only(['name', 'email', 'phone', 'location', 'tagline', 'about', 'linkedin', 'github']);

        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            try {
                $result = $this->uploadToCloudinary(
                    $request->file('profile_image')->getRealPath(),
                    ['folder' => 'portfolio/profile']
                );
                $data['profile_image'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        $profile->fill($data)->save();
        return back()->with('success', 'Profile updated successfully!');
    }

    public function cvUpload()
    {
        $profile = Profile::first();
        $currentCv = $profile->cv_path ?? null;
        return view('admin.cv.upload', compact('currentCv'));
    }

    public function cvStore(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:5120',
        ]);

        $profile = Profile::firstOrNew([]);

        try {
            $result = $this->uploadToCloudinary(
                $request->file('cv')->getRealPath(),
                [
                    'folder'        => 'portfolio/cv',
                    'resource_type' => 'raw',
                    'public_id'     => 'Abdul_Moiz_Ashraf_CV',
                    'access_mode'   => 'public',
                    'invalidate'    => true,
                ]
            );
            $profile->cv_path = $result['secure_url'];
            $profile->save();
        } catch (\Exception $e) {
            return back()->with('error', 'CV upload failed: ' . $e->getMessage());
        }

        return back()->with('success', 'CV uploaded successfully!');
    }

    public function skillsIndex()
    {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function skillsCreate()
    {
        return view('admin.skills.form');
    }

    public function skillsStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'category' => 'required|string|max:100',
        ]);
        Skill::create($request->only(['name', 'category', 'icon', 'sort_order']));
        return redirect()->route('admin.skills.index')->with('success', 'Skill added!');
    }

    public function skillsEdit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function skillsUpdate(Request $request, Skill $skill)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'category' => 'required|string|max:100',
        ]);
        $skill->update($request->only(['name', 'category', 'icon', 'sort_order']));
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated!');
    }

    public function skillsDestroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill deleted.');
    }

    // ─── Experience ─────────────────────────────────────────────────────────────

    public function experienceIndex()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experience.index', compact('experiences'));
    }

    public function experienceCreate()
    {
        return view('admin.experience.form');
    }

    public function experienceStore(Request $request)
    {
        $request->validate([
            'role'        => 'required|string|max:150',
            'company'     => 'required|string|max:150',
            'start_date'  => 'required|string|max:50',
            'description' => 'required|string',
        ]);

        Experience::create($request->only(['role', 'company', 'start_date', 'end_date', 'type', 'description', 'tech_stack', 'sort_order']));
        return redirect()->route('admin.experience.index')->with('success', 'Experience added!');
    }

    public function experienceEdit(Experience $experience)
    {
        return view('admin.experience.form', compact('experience'));
    }

    public function experienceUpdate(Request $request, Experience $experience)
    {
        $request->validate([
            'role'        => 'required|string|max:150',
            'company'     => 'required|string|max:150',
            'start_date'  => 'required|string|max:50',
            'description' => 'required|string',
        ]);

        $experience->update($request->only(['role', 'company', 'start_date', 'end_date', 'type', 'description', 'tech_stack', 'sort_order']));
        return redirect()->route('admin.experience.index')->with('success', 'Experience updated!');
    }

    public function experienceDestroy(Experience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Experience deleted.');
    }


    public function projectsIndex()
    {
        $projects = Project::orderBy('sort_order')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function projectsCreate()
    {
        return view('admin.projects.form');
    }

    public function projectsStore(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only(['title', 'description', 'tech_stack', 'live_url', 'github_url', 'sort_order', 'category']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $result = $this->uploadToCloudinary(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'portfolio/projects']
                );
                $data['image'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project added!');
    }

    public function projectsEdit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function projectsUpdate(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only(['title', 'description', 'tech_stack', 'live_url', 'github_url', 'sort_order', 'category']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $result = $this->uploadToCloudinary(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'portfolio/projects']
                );
                $data['image'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    public function projectsDestroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project deleted.');
    }

    // ─── Certifications ─────────────────────────────────────────────────────────────

    public function certificationsIndex()
    {
        $certifications = Certification::orderBy('sort_order')->get();
        return view('admin.certifications.index', compact('certifications'));
    }

    public function certificationsCreate()
    {
        return view('admin.certifications.form');
    }

    public function certificationsStore(Request $request)
    {
        $request->validate([
            'name'                 => 'required|string|max:200',
            'certificate_number'   => 'required|string|max:200|unique:certifications,certificate_number',
            'start_date'           => 'required|string|max:50',
            'expiry_date'          => 'nullable|string|max:50',
            'image'                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only(['name', 'certificate_number', 'start_date', 'expiry_date', 'sort_order']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $result = $this->uploadToCloudinary(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'portfolio/certifications']
                );
                $data['image'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification added!');
    }

    public function certificationsEdit(Certification $certification)
    {
        return view('admin.certifications.form', compact('certification'));
    }

    public function certificationsUpdate(Request $request, Certification $certification)
    {
        $request->validate([
            'name'               => 'required|string|max:200',
            'certificate_number' => 'required|string|max:200|unique:certifications,certificate_number,' . $certification->id,
            'start_date'         => 'required|string|max:50',
            'expiry_date'        => 'nullable|string|max:50',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only(['name', 'certificate_number', 'start_date', 'expiry_date', 'sort_order']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $result = $this->uploadToCloudinary(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'portfolio/certifications']
                );
                $data['image'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated!');
    }

    public function certificationsDestroy(Certification $certification)
    {
        $certification->delete();
        return back()->with('success', 'Certification deleted.');
    }
}
