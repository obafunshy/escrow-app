<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();
        $imagePlaceholder = $faker->imageUrl(width: 800, height: 600);
        $imageUrl = $this->storeImageFromUrl($imagePlaceholder, 'public/images');

        // $tagIds =  Tag::whereIn('id', [1, 2])->pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence,
            'user_id' => rand(1, 3),
            'slug' => $this->faker->slug,
            'image' => $imageUrl,
            'content' => $this->faker->paragraph,
            'status'=> rand(0,1),
            'likes' => $this->faker->numberBetween(0, 2),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Attach tags to the post
            $tagIds =  Tag::whereIn('id', [1, 2])->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        });
    }

    private function storeImageFromUrl($url, $path)
    {
        $contents = file_get_contents($url);
        $fileName = basename($url);

        Storage::put($path . '/' . $fileName, $contents);

        return $path . '/' . $fileName;
    }
}
