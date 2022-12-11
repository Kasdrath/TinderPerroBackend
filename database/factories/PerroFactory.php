<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perro;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perro>
 */
class PerroFactory extends Factory
{
    protected $model = Perro::class;

    public function definition()
    {
        return [
            'nombre_perro' => $this->faker->name,
            'url_foto' => $this->faker->email,
            'descripcion' => $this->faker->text(15)
        ];
    }
}
