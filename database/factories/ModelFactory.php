<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\User::class, function (\Faker\Generator $faker) {

    return [
        'username' => str_replace('.', '', $faker->unique()->userName),
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'bio' => $faker->sentence,
        'image' => 'https://cdn.worldvectorlogo.com/logos/laravel.svg',
    ];
});

$factory->define(\App\Journal::class, function(\Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(5),
        'issn' => $faker->numberBetween(1000, 9999)
    ];
});
$factory->define(\App\Publication::class, function (\Faker\Generator $faker) {
    static $journals;
    static $reduce = 999;

    $journals = $journals ?: \App\Journal::all();
    return [
        'journal_id' => $journals->random()->id,
        'title' => $faker->sentence,
        'abstract' => $faker->paragraphs($faker->numberBetween(1, 3), true),
        'published_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
        'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
    ];
});

$factory->define(\App\Annotation::class, function (\Faker\Generator $faker) {

    static $users;
    static $publications;
    static $reduce = 999;

    $users = $users ?: \App\User::all();
    $publications = $publications ?: \App\Publication::all();

    return [
        'body' => $faker->paragraph($faker->numberBetween(1, 5)),
        'user_id' => $users->random()->id,
        'publication_id' => $publications->random()->id,
        'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
    ];
});

$factory->define(\App\Tag::class, function (\Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->word,
    ];
});
