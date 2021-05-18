<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/*class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     /
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    /*public function definition()
    {
        return [
		
			'Name'=>$this->faker->name(),
			'gender'=>$this->faker->gender(),
			'department'=>'CSE';
			'email' => $this->faker->unique()->safeEmail(),
			'mobile' =>$this->faker->mobile(),
			'password' =>'abcd4321',
			'session' =>'0',
            ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
/*    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}*/
//App\Models\
$factory->define(App\Models\User::class,function (Faker\Generator $faker) {
    return [
			'Name'=>$this->faker->name(),
			'gender'=>$this->faker->gender(),
			'department'=>'CSE';
			'email' => $this->faker->unique()->safeEmail(),
			'mobile' =>$this->faker->mobile(),
			'password' =>'abcd4321',
			'session' =>'0',
            ];
}