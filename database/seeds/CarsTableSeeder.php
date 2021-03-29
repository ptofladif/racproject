<?php

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = array(
            array(
                "brand_id" => "17",
                "plate" => "15-TP-50",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "17",
                "plate" => "23-TE-37",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "18",
                "plate" => "29-XD-09",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "5",
                "plate" => "14-XB-58",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "33",
                "plate" => "82-ZU-97",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "7",
                "plate" => "AE27LX",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "18",
                "plate" => "AD-06-AA",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "32",
                "plate" => "AA99DR",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "14",
                "plate" => "AA03CM",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "3",
                "plate" => "07-XL-44",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "7",
                "plate" => "NE8229",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "14",
                "plate" => "43-QD-38",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "3",
                "plate" => "73-69-LR",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "20",
                "plate" => "17-NI-30",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "7",
                "plate" => "AE22BR",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "6",
                "plate" => "54-UU-56",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "7",
                "plate" => "95-PT-17",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "18",
                "plate" => "44-TO-27",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "7",
                "plate" => "CR-33-KV",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
            array(
                "brand_id" => "4",
                "plate" => "62-IO-15",
                "daily_price" => 50,
                "rented" => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ),
        );

        Car::insert($cars);
    }
}
