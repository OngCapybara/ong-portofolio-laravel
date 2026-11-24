<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    /**
     * GET /api/admin/projects
     */
    public function index(): JsonResponse
    {
        $projects = Project::with('skills')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $projects,
        ], 200);
    }

    /**
     * POST /api/admin/projects
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:150'],
            'summary'       => ['required', 'string', 'min:10', 'max:300'],
            'description'   => ['nullable', 'string'],
            'skills'        => ['required', 'string'], // input dipisah koma, misal: "Laravel, Tailwind CSS, MySQL"
            'thumbnail_url' => ['nullable', 'url'],
            'demo_url'      => ['nullable', 'url'],
            'github_url'    => ['nullable', 'url'],
            'is_featured'   => ['nullable', 'boolean'],
        ], [
            'title.required'      => 'Judul proyek wajib diisi.',
            'summary.required'    => 'Ringkasan proyek wajib diisi minimal 10 karakter.',
            'skills.required'     => 'Minimal satu teknologi/skill wajib diisi.',
            'thumbnail_url.url'   => 'URL thumbnail harus diawali http:// atau https://',
            'demo_url.url'        => 'URL demo harus diawali http:// atau https://',
            'github_url.url'      => 'URL GitHub harus diawali http:// atau https://',
        ]);

        // Buat slug unik otomatis dari title
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $project = Project::create([
            'title'         => $validated['title'],
            'slug'          => $slug,
            'summary'       => $validated['summary'],
            'description'   => $validated['description'] ?? $validated['summary'],
            'thumbnail_url' => $validated['thumbnail_url'] ?? 'https://placehold.co/640x360/09090b/0ea5e9?text=' . urlencode($validated['title']),
            'demo_url'      => $validated['demo_url'] ?? null,
            'github_url'    => $validated['github_url'] ?? null,
            'is_featured'   => (bool) ($validated['is_featured'] ?? true),
        ]);

        // Sinkronkan relasi many-to-many ke tabel skills
        $this->syncProjectSkills($project, $validated['skills']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Proyek baru berhasil ditambahkan ke portofolio!',
            'data'    => $project->load('skills'),
        ], 201);
    }

    /**
     * GET /api/admin/projects/{id}
     */
    public function show(int $id): JsonResponse
    {
        $project = Project::with('skills')->find($id);

        if (! $project) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data proyek tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $project,
        ], 200);
    }

    /**
     * PUT /api/admin/projects/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data proyek tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:150'],
            'summary'       => ['required', 'string', 'min:10', 'max:300'],
            'description'   => ['nullable', 'string'],
            'skills'        => ['required', 'string'],
            'thumbnail_url' => ['nullable', 'url'],
            'demo_url'      => ['nullable', 'url'],
            'github_url'    => ['nullable', 'url'],
            'is_featured'   => ['nullable', 'boolean'],
        ]);

        $project->update([
            'title'         => $validated['title'],
            'summary'       => $validated['summary'],
            'description'   => $validated['description'] ?? $validated['summary'],
            'thumbnail_url' => $validated['thumbnail_url'] ?: $project->thumbnail_url,
            'demo_url'      => $validated['demo_url'] ?? null,
            'github_url'    => $validated['github_url'] ?? null,
            'is_featured'   => (bool) ($validated['is_featured'] ?? $project->is_featured),
        ]);

        $this->syncProjectSkills($project, $validated['skills']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data proyek berhasil diperbarui!',
            'data'    => $project->load('skills'),
        ], 200);
    }

    /**
     * DELETE /api/admin/projects/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data proyek tidak ditemukan.',
            ], 404);
        }

        $title = $project->title;
        $project->skills()->detach();
        $project->delete();

        return response()->json([
            'status'  => 'success',
            'message' => "Proyek '{$title}' berhasil dihapus dari sistem.",
        ], 200);
    }

    /**
     * Helper: Mengubah string koma teknologi menjadi ID relasi di tabel skills
     */
    private function syncProjectSkills(Project $project, string $skillsInput): void
    {
        $names = array_filter(array_map('trim', explode(',', $skillsInput)));
        $skillIds = [];

        foreach ($names as $name) {
            $skill = Skill::firstOrCreate(
                ['name' => $name],
                [
                    'category' => 'Tools',
                    'level'    => 'Intermediate',
                    'icon'     => 'fa-solid fa-code',
                ]
            );
            $skillIds[] = $skill->id;
        }

        $project->skills()->sync($skillIds);
    }
}
