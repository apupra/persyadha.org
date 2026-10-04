<?php
namespace App\Controllers;

use App\Models\Profile;

class ProfilController extends BaseController
{
    public function index()
    {
        // Ambil data profil (kalau hanya ada 1 profil, ambil data pertama)
        $profile = Profile::first(); // Atau gunakan Profile::find(1) jika hanya 1 data tetap

        if (!$profile) {
            $profile = [
                'title' => 'Profil Yayasan Tidak Ditemukan',
                'subtitle' => '',
                'description' => '',
                'vision' => '',
                'mission' => '',
                'values' => '',
                'leader_message' => '',
                'leader_name' => '',
                'structure_image' => '',
                'profile_video' => '',
                'activity_image' => '',
            ];
        }

        $data = [
            'title' => 'Profil Persyadha Al Haromain',
            'profile' => $profile
        ];

        $this->render('profil/index', $data);
    }
}
