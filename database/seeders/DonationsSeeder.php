<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donation;
use Carbon\Carbon;

class DonationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Donation::create([
            'title' => 'Donasi Pembangunan Sekolah',
            'description' => 'Menggalang dana untuk pembangunan sekolah di daerah terpencil.',
            'target_amount' => 50000000,
            'collected_amount' => 2000000,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'image_path' => "C:\Users\mgiri\Documents\KULIAH\SMS5\WEB-PRAKTIKUM\ujian\charity-backend\public\images\me.jpg",
            'category' => 'Pendidikan',
            'visibility' => true,
            'created_by' => 1,

        ]);

        Donation::create([
            'title' => 'Donasi Bantuan Bencana',
            'description' => 'Bantuan darurat untuk korban bencana alam.',
            'target_amount' => 100000000,
            'collected_amount' => 50000000,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(60),
            'image_path' => "C:\Users\mgiri\Documents\KULIAH\SMS5\WEB-PRAKTIKUM\ujian\charity-backend\public\images\me.jpg",
            'category' => 'Bencana',
            'visibility' => true,
            'created_by' => 1,

        ]);

        Donation::create([
            'title' => 'Donasi Bantuan Kesehatan',
            'description' => 'Dana untuk pengobatan pasien tidak mampu.',
            'target_amount' => 75000000,
            'collected_amount' => 15000000,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(90),
            'image_path' => "C:\Users\mgiri\Documents\KULIAH\SMS5\WEB-PRAKTIKUM\ujian\charity-backend\public\images\me.jpg",
            'category' => 'Kesehatan',
            'visibility' => true,
            'created_by' => 1,

        ]);
    }
}