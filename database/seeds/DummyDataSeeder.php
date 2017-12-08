<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Total number of users.
     *
     * @var int
     */
    protected $totalUsers = 25;


    protected $totalJournals = 10;
    protected $journalWithPublicationRatio = 0.8;
    protected $maxPublicationsByJournal = 20;

    /**
     * Total number of tags.
     *
     * @var int
     */
    protected $totalTags = 10;

    /**
     * Percentage of users with posts.
     *
     * @var float Value should be between 0 - 1.0
     */
    protected $userWithAnnotationRatio = 0.8;

    /**
     * Maximum posts that can be created by a user.
     *
     * @var int
     */
    protected $maxAnnotationsByUser = 15;

    /**
     * Maximum tags that can be attached to an post.
     *
     * @var int
     */
    protected $maxAnnotationTags = 3;

    /**
     * Maximum number of comments that can be added to an post.
     *
     * @var int
     */
    // protected $maxAnnotationInPublication = 10;

    /**
     * Percentage of users with favorites.
     *
     * @var float Value should be between 0 - 1.0
     */
    protected $usersWithFavoritesRatio = 0.75;

    /**
     * Percentage of users with following.
     *
     * @var float Value should be between 0 - 1.0
     */
    protected $usersWithFollowingRatio = 0.75;

    /**
     * Populate the database with dummy data for testing.
     * Complete dummy data generation including relationships.
     * Set the property values as required before running database seeder.
     *
     * @param \Faker\Generator $faker
     */
    public function run(\Faker\Generator $faker)
    {
        $users = factory(\App\User::class)->times($this->totalUsers)->create();

        $tags = factory(\App\Tag::class)->times($this->totalTags)->create();

        $journals = factory(\App\Journal::class)->times($this->totalJournals)->create();

        $journals->random((int) $this->totalJournals * $this->journalWithPublicationRatio)
            ->each(function($journal) use ($faker) {
                $journal->publications()
                    ->saveMany(
                        factory(\App\Publication::class)
                            ->times($faker->numberBetween(1, $this->maxPublicationsByJournal))
                            ->make()
                    );
            });

        $users->random((int) $this->totalUsers * $this->userWithAnnotationRatio)
            ->each(function ($user) use ($faker) {
                $user->annotations()
                    ->saveMany(
                        factory(\App\Annotation::class)
                            ->times($faker->numberBetween(1, $this->maxAnnotationsByUser))
                            ->make()
                    );
//                    ->each(function ($annotation) use ($faker, $tags) {
//                        $annotation->tags()->attach(
//                            $tags->random($faker->numberBetween(1, min($this->maxAnnotationTags, $this->totalTags)))
//                        );
//                    });
            });

        $annotations = \App\Publication::all();

        $users->random((int) $users->count() * $this->usersWithFavoritesRatio)
            ->each(function ($user) use($faker, $annotations) {
                $annotations->random($faker->numberBetween(1, (int) $annotations->count() * 0.5))
                    ->each(function ($post) use ($user) {
                        $user->favorite($post);
                    });
            });

        $users->random((int) $users->count() * $this->usersWithFollowingRatio)
            ->each(function ($user) use($faker, $users) {
                $users->except($user->id)
                    ->random($faker->numberBetween(1, (int) ($users->count() - 1) * 0.2))
                    ->each(function ($userToFollow) use ($user) {
                        $user->follow($userToFollow);
                    });
            });
    }
}
