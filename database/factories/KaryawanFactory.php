<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posisi = ['admin', 'karyawan', 'barista', 'kasir'];
        $selectedPosisi = $this->faker->randomElement($posisi);

        // Gaji berdasarkan posisi
        $gajiRange = [
            'admin' => [8000000, 12000000],
            'karyawan' => [3000000, 5000000],
            'barista' => [3500000, 5500000],
            'kasir' => [3000000, 4500000]
        ];

        return [
            'nama' => $this->faker->name(),
            'umur' => $this->faker->numberBetween(18, 50),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => $this->faker->address(),
            'posisi' => $selectedPosisi,
            'gaji' => $this->faker->numberBetween($gajiRange[$selectedPosisi][0], $gajiRange[$selectedPosisi][1]),
            'status' => $this->faker->randomElement(['aktif', 'tidak aktif']),
        ];
    }
}
