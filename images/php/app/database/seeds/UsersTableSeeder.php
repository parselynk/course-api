<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        // create categories
        for ($i=1; $i <= 10; $i++) {
            $categories[$i-1] = factory(App\Category::class)->create(['name' => 'category_'.$i])->id;
        }

        // create users
        factory(App\User::class, 3)->create()->each(function ($user) use ($categories) {
            // create courses
            factory(App\Course::class, 2)->create()->each(
                //create exercises
                function ($course) use ($user, $categories) {
                    $exercices = [];
                    for ($i=1; $i <= rand(1, 3); $i++) {
                        $exercises[] = factory(App\Exercise::class)->create(['course_id' => $course->id, 'category_id' => $categories[rand(0, 9)]]);
                    }
                    $course->sessions()->saveMany(
                        // create sessions
                        factory(App\Session::class, rand(1, 5))->create(['user_id' => $user->id, 'course_id' => $course->id])->each(
                            function ($session) use ($user, $course, $exercises) {
                                $session->exercises()->saveMany($exercises);
                                // create scores
                                $session->score()->save(factory(App\Score::class)->create(['session_id' => $session->id]));
                            }
                        )
                    );
                }
            );
        });
    }
}
