<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Certificate;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Profil Ong Azis Saliem
        Profile::create([
            'full_name'     => 'Ong Azis Saliem',
            'headline'      => 'Informatics Student | Full-Stack & Robotics Developer',
            'bio'           => 'Mahasiswa S1 Informatika Universitas Teknokrat Indonesia yang berfokus membangun produk digital berbasis web & mobile yang cepat, bersih, serta sistem otonom berbasis mikrokontroler dan robotika.',
            'photo_url'     => '/assets/atmin/ongganteng.JPG',
            'cv_url'        => '/CV_Ong.pdf',
            'email'         => 'ongazissaliem.sama@gmail.com',
            'phone'         => '085768457271',
            'location'      => 'Bandar Lampung, Indonesia',
            'github_url'    => 'https://github.com/OngCapybara',
            'linkedin_url'  => 'https://linkedin.com/in/ong-azis-saliem',
            'instagram_url' => 'https://instagram.com/ong_capy',
        ]);

        // 2. Skills (8 Skill lintas 4 kategori)
        $skillTw      = Skill::create(['name' => 'Tailwind CSS', 'category' => 'Frontend', 'level' => 'Advanced', 'icon' => 'fa-solid fa-wind']);
        $skillReact   = Skill::create(['name' => 'ReactJS', 'category' => 'Frontend', 'level' => 'Intermediate', 'icon' => 'fa-brands fa-react']);
        $skillFlutter = Skill::create(['name' => 'Flutter', 'category' => 'Frontend', 'level' => 'Advanced', 'icon' => 'fa-solid fa-mobile-screen']);
        $skillLaravel = Skill::create(['name' => 'Laravel (PHP)', 'category' => 'Backend', 'level' => 'Advanced', 'icon' => 'fa-brands fa-laravel']);
        $skillPython  = Skill::create(['name' => 'Python', 'category' => 'Backend', 'level' => 'Advanced', 'icon' => 'fa-brands fa-python']);
        $skillMysql   = Skill::create(['name' => 'MySQL', 'category' => 'Database', 'level' => 'Intermediate', 'icon' => 'fa-solid fa-database']);
        $skillFire    = Skill::create(['name' => 'Firebase Firestore', 'category' => 'Database', 'level' => 'Advanced', 'icon' => 'fa-solid fa-fire']);
        $skillGit     = Skill::create(['name' => 'Git & GitHub', 'category' => 'Tools', 'level' => 'Advanced', 'icon' => 'fa-brands fa-git-alt']);

        // 3. Projects (3 Proyek unggulan) + Relasi Many-to-Many via sync()
        $proj1 = Project::create([
            'title'         => 'JagaNetra — AI Room Security CCTV',
            'slug'          => Str::slug('JagaNetra AI Room Security CCTV'),
            'summary'       => 'Sistem pemantauan keamanan ruangan real-time berbasis YOLOv8 dan aplikasi mobile Flutter dengan sinkronisasi Firebase.',
            'description'   => 'Mengintegrasikan deteksi objek berbasis YOLOv8 dan OpenCV dengan aplikasi mobile lintas platform Flutter serta penyimpanan cloud Firebase Firestore.',
            'thumbnail_url' => 'https://placehold.co/640x360',
            'demo_url'      => null,
            'github_url'    => 'https://github.com/OngCapybara',
            'is_featured'   => true,
        ]);
        $proj1->skills()->sync([$skillPython->id, $skillFlutter->id, $skillFire->id]);

        $proj2 = Project::create([
            'title'         => 'Kost Life — Student Finance Tracker',
            'slug'          => Str::slug('Kost Life Student Finance Tracker'),
            'summary'       => 'Aplikasi web manajemen keuangan mahasiswa dengan pencatatan transaksi harian, countdown anggaran, dan integrasi AI.',
            'description'   => 'Dibangun dengan Laravel dan Tailwind CSS untuk membantu mahasiswa mengelola anggaran bulanan serta memantau arus kas secara terstruktur.',
            'thumbnail_url' => 'https://placehold.co/640x360',
            'demo_url'      => null,
            'github_url'    => 'https://github.com/OngCapybara',
            'is_featured'   => true,
        ]);
        $proj2->skills()->sync([$skillLaravel->id, $skillTw->id, $skillMysql->id, $skillGit->id]);

        $proj3 = Project::create([
            'title'         => 'Personal Portfolio Web (Laravel + Tailwind)',
            'slug'          => Str::slug('Personal Portfolio Web Laravel Tailwind'),
            'summary'       => 'Website portofolio responsif dengan dukungan dark/light mode serta RESTful API backend Laravel.',
            'description'   => 'Antarmuka portofolio modern dengan arsitektur komponen Blade, Tailwind CSS v4, dan skema database relasional MySQL.',
            'thumbnail_url' => 'https://placehold.co/640x360',
            'demo_url'      => null,
            'github_url'    => 'https://github.com/OngCapybara/ong-portofolio-laravel',
            'is_featured'   => false,
        ]);
        $proj3->skills()->sync([$skillLaravel->id, $skillTw->id, $skillReact->id, $skillMysql->id]);

        // 4. Experiences (3 Riwayat)
        Experience::create([
            'title'        => 'Mahasiswa S1 Informatika',
            'organization' => 'Universitas Teknokrat Indonesia',
            'type'         => 'Pendidikan',
            'start_date'   => '2024-09-01',
            'end_date'     => null,
            'is_current'   => true,
            'description'  => 'Mendalami rekayasa perangkat lunak full-stack, pengembangan aplikasi mobile, Computer Vision, dan sistem tertanam.',
        ]);

        Experience::create([
            'title'        => 'Robotics & Electronics Instructor',
            'organization' => 'Sekolah Menengah Kejuruan (SMK)',
            'type'         => 'Kerja',
            'start_date'   => '2025-02-01',
            'end_date'     => null,
            'is_current'   => true,
            'description'  => 'Membimbing siswa kejuruan dalam perakitan elektronika, pemrograman mikrokontroler, dan proyek robotika berbasis praktik.',
        ]);

        Experience::create([
            'title'        => 'Autonomous Robotics & Drone Developer (KRSRI)',
            'organization' => 'Tim Robotika Universitas Teknokrat Indonesia',
            'type'         => 'Organisasi',
            'start_date'   => '2025-01-15',
            'end_date'     => null,
            'is_current'   => true,
            'description'  => 'Mengembangkan sistem navigasi otonom pada robot Hexapod 18-DOF dan UAV untuk kompetisi robotika nasional.',
        ]);

        // 5. Certificates (2 Sertifikat)
        Certificate::create([
            'title'          => 'Delegasi Proposal Kompetisi Robot SAR Nasional (KRSRI)',
            'issuer'         => 'Universitas Diponegoro / Kemendikbudristek',
            'issued_date'    => '2026-06-15',
            'credential_url' => 'https://github.com/OngCapybara',
            'description'    => 'Kompetisi nasional perancangan robot berkaki otonom misi pencarian dan penyelamatan.',
        ]);

        Certificate::create([
            'title'          => 'Full-Stack Web & Mobile Application Development',
            'issuer'         => 'Universitas Teknokrat Indonesia',
            'issued_date'    => '2025-11-20',
            'credential_url' => 'https://github.com/OngCapybara',
            'description'    => 'Pengembangan aplikasi web berbasis Laravel dan aplikasi mobile terintegrasi REST API.',
        ]);
    }
}
