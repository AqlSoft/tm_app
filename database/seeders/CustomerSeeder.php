<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ar_SA'); // استخدام Faker لإنشاء بيانات عشوائية باللغة العربية

        for ($i = 0; $i < 15; $i++) {
            $type = $faker->randomElement(['individual', 'company', 'factory', 'farm']);
            $commercialRecord = ($type !== 'individual') ? $faker->numerify('##########') : null;
            $taxNumber = ($type !== 'individual') ? $faker->numerify('###########') : null;
            $identityNumber = ($type === 'individual') ? $faker->numerify('##########') : null;

            DB::table('customers')->insert([
                'name_ar' => $faker->company,
                'name_en' => $faker->company,
                'type' => $type,
                'identity_number' => $identityNumber,
                'commercial_record' => $commercialRecord,
                'tax_number' => $taxNumber,
                'brand_name' => $faker->companySuffix,
                'subscription_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'website' => $faker->url,
                'city' => $faker->city,
                'address' => $faker->address,
                'notes' => $faker->sentence,
                'is_active' => $faker->boolean,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}
