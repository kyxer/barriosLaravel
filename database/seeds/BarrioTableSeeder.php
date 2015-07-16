<?php

use Illuminate\Database\Seeder;

use App\Barrio;

class BarrioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barrios')->delete();

        for($i = 0; $i<10; $i++){
            Barrio::create([
                'postal_code' => 12345 + $i,
                'url_name' => 'barrio-'.$i,
                'name' => 'barrio '. $i
            ]);
        }

    }
}
