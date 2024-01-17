<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Subjects;
use Carbon\Carbon;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('subjects')->delete();
        // 国語、数学、英語を追加
        DB::table('subjects')->insert([
            [ 'id' => '1','subject' => '国語', 'created_at' => Carbon::now()],
            [ 'id' => '2','subject' => '数学', 'created_at' => Carbon::now()],
            [ 'id' => '3','subject' => '英語', 'created_at' => Carbon::now()],
        ]);
    }
}
