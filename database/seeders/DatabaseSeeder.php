<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\PlacePhoto;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email' => 'admin@pariwisata.id',
        ]);
        // $visitors = User::factory(100)->create();
        // $places = Place::factory(10)->hasPhotos(3)->create();

        // foreach ($visitors as $visitor) {
        //     foreach ($places as $place) {
        //         Review::factory()->create([
        //             'user_id' => $visitor->id,
        //             'place_id' => $place->id,
        //         ]);
        //     }
        // }
    }
}
