<?php

use Illuminate\Database\Seeder;

class quiz_trial_seeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        for ($i = 0; $i < 100; $i++) {
            DB::table('quiz_trial')->insert([
                'question' => '<p>Siapakah yang tidak termasuk tim #teamIronMan ataupun #teamCap pada film marvel civil war?</p>',
                'choices1' => '<p>Iron Man</p>',
                'choices2' => '<p>Black Panther</p>',
                'choices3' => '<p>Hulk</p>',
                'choices4' => '<p>Thor</p>',
                'choices5' => '<p>Mickey Mouse</p>',
                'answer' => 'E'
            ]);
        }
    }

}
