<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyName = $this->faker->unique()->company();
        $imagePath = md5($companyName);
        $image = $this->faker->unique()->image();
        $imageFile = new File($image);

        return [
            'slug' => md5($this->faker->unique()->randomNumber()),
            'name' => $companyName,
            'email' => $this->faker->unique()->safeEmail(),
            'website' => $this->faker->unique()->url(),
            'logo' => Storage::disk('public')->putFile("images/company/{$imagePath}", $imageFile),
        ];
    }
}
