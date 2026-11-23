<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

/**
 * PortfolioController
 *
 * Menyajikan seluruh data portofolio publik melalui endpoint RESTful GET.
 * Menggunakan Eager Loading (with) untuk mencegah N+1 Query Problem
 * dan mengembalikan struktur amplop JSON yang konsisten.
 */
class PortfolioController extends Controller
{
    /**
     * GET /api/portfolio/profile
     * Mengembalikan data profil utama pemilik portofolio.
     */
    public function profile(): JsonResponse
    {
        $profile = Profile::first();

        if (! $profile) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data profil belum dikonfigurasi.',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Data profil berhasil diambil.',
            'data'    => [
                'id'            => $profile->id,
                'full_name'     => $profile->full_name,
                'headline'      => $profile->headline,
                'bio'           => $profile->bio,
                'photo_url'     => $profile->photo_url,
                'cv_url'        => $profile->cv_url,
                'email'         => $profile->email,
                'phone'         => $profile->phone,
                'location'      => $profile->location,
                'github_url'    => $profile->github_url,
                'linkedin_url'  => $profile->linkedin_url,
                'instagram_url' => $profile->instagram_url,
            ],
        ]);
    }

    /**
     * GET /api/portfolio/skills
     * Mengembalikan daftar keahlian teknis terurut berdasarkan kategori.
     */
    public function skills(): JsonResponse
    {
        $skills = Skill::orderBy('category')->orderBy('name')->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data skill berhasil diambil.',
            'total'   => $skills->count(),
            'data'    => $skills->map(fn ($skill) => [
                'id'       => $skill->id,
                'name'     => $skill->name,
                'category' => $skill->category,
                'level'    => $skill->level,
                'icon'     => $skill->icon,
            ]),
        ]);
    }

    /**
     * GET /api/portfolio/projects
     * Mengembalikan daftar proyek beserta daftar skill terkait (Eager Loading).
     */
    public function projects(): JsonResponse
    {
        // Eager Loading with('skills') mencegah N+1 Query Problem
        $projects = Project::with('skills')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data proyek berhasil diambil.',
            'total'   => $projects->count(),
            'data'    => $projects->map(fn ($project) => [
                'id'            => $project->id,
                'title'         => $project->title,
                'slug'          => $project->slug,
                'summary'       => $project->summary,
                'description'   => $project->description,
                'thumbnail_url' => $project->thumbnail_url,
                'demo_url'      => $project->demo_url,
                'github_url'    => $project->github_url,
                'is_featured'   => (bool) $project->is_featured,
                'skills'        => $project->skills->map(fn ($skill) => [
                    'id'       => $skill->id,
                    'name'     => $skill->name,
                    'category' => $skill->category,
                ]),
            ]),
        ]);
    }

    /**
     * GET /api/portfolio/projects/{slug}
     * Mengembalikan detail satu proyek berdasarkan slug uniknya (404 jika tidak ditemukan).
     */
    public function projectDetail(string $slug): JsonResponse
    {
        $project = Project::with('skills')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail proyek berhasil diambil.',
            'data'    => [
                'id'            => $project->id,
                'title'         => $project->title,
                'slug'          => $project->slug,
                'summary'       => $project->summary,
                'description'   => $project->description,
                'thumbnail_url' => $project->thumbnail_url,
                'demo_url'      => $project->demo_url,
                'github_url'    => $project->github_url,
                'is_featured'   => (bool) $project->is_featured,
                'skills'        => $project->skills->map(fn ($skill) => [
                    'id'       => $skill->id,
                    'name'     => $skill->name,
                    'category' => $skill->category,
                ]),
            ],
        ]);
    }

    /**
     * GET /api/portfolio/experiences
     * Mengembalikan riwayat pendidikan, organisasi, dan pengalaman kerja.
     */
    public function experiences(): JsonResponse
    {
        $experiences = Experience::orderByRaw('is_current DESC, start_date DESC')->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pengalaman berhasil diambil.',
            'total'   => $experiences->count(),
            'data'    => $experiences->map(fn ($exp) => [
                'id'           => $exp->id,
                'title'        => $exp->title,
                'organization' => $exp->organization,
                'type'         => $exp->type,
                'start_date'   => $exp->start_date,
                'end_date'     => $exp->end_date,
                'is_current'   => (bool) $exp->is_current,
                'description'  => $exp->description,
            ]),
        ]);
    }

    /**
     * GET /api/portfolio/certificates
     * Mengembalikan daftar sertifikat dan penghargaan.
     */
    public function certificates(): JsonResponse
    {
        $certificates = Certificate::orderBy('issued_date', 'desc')->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data sertifikat berhasil diambil.',
            'total'   => $certificates->count(),
            'data'    => $certificates->map(fn ($cert) => [
                'id'             => $cert->id,
                'title'          => $cert->title,
                'issuer'         => $cert->issuer,
                'issued_date'    => $cert->issued_date,
                'credential_url' => $cert->credential_url,
                'description'    => $cert->description,
            ]),
        ]);
    }
}
