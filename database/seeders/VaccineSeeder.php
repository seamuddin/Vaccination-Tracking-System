<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VaccineSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $vaccines = [
            // Birth - 2 Months
            [
                'name' => 'Hepatitis B',
                'manufacturer' => 'Generic',
                'description' => 'Protection against hepatitis B virus',
                'doses_required' => 1,
                'age_due_days' => 0,
                'number_of_doses' => 3,
                'dose_interval_days' => 28, // every 1 month
            ],
            [
                'name' => 'DTaP',
                'manufacturer' => 'Generic',
                'description' => 'Diphtheria, Tetanus, and Pertussis vaccine',
                'doses_required' => 1,
                'age_due_days' => 60,
                'number_of_doses' => 3,
                'dose_interval_days' => 30,
            ],
            [
                'name' => 'Hib',
                'manufacturer' => 'Generic',
                'description' => 'Haemophilus influenzae type b vaccine',
                'doses_required' => 1,
                'age_due_days' => 60,
                'number_of_doses' => 3,
                'dose_interval_days' => 30,
            ],
            [
                'name' => 'PCV13',
                'manufacturer' => 'Generic',
                'description' => 'Pneumococcal conjugate vaccine',
                'doses_required' => 1,
                'age_due_days' => 60,
                'number_of_doses' => 3,
                'dose_interval_days' => 30,
            ],
            [
                'name' => 'IPV',
                'manufacturer' => 'Generic',
                'description' => 'Inactivated Polio Vaccine',
                'doses_required' => 1,
                'age_due_days' => 60,
                'number_of_doses' => 3,
                'dose_interval_days' => 30,
            ],
            [
                'name' => 'Rotavirus',
                'manufacturer' => 'Generic',
                'description' => 'Protection against rotavirus infections',
                'doses_required' => 1,
                'age_due_days' => 60,
                'number_of_doses' => 2,
                'dose_interval_days' => 30,
            ],

            // 12 - 15 Months
            [
                'name' => 'MMR',
                'manufacturer' => 'Generic',
                'description' => 'Measles, Mumps, Rubella',
                'doses_required' => 1,
                'age_due_days' => 365,
                'number_of_doses' => 2,
                'dose_interval_days' => 180,
            ],
            [
                'name' => 'Varicella',
                'manufacturer' => 'Generic',
                'description' => 'Chickenpox vaccine',
                'doses_required' => 1,
                'age_due_days' => 365,
                'number_of_doses' => 2,
                'dose_interval_days' => 180,
            ],
            [
                'name' => 'Hepatitis A',
                'manufacturer' => 'Generic',
                'description' => 'Protection against hepatitis A virus',
                'doses_required' => 1,
                'age_due_days' => 365,
                'number_of_doses' => 2,
                'dose_interval_days' => 180,
            ],

            // 4 - 6 Years (boosters)
            [
                'name' => 'DTaP Booster',
                'manufacturer' => 'Generic',
                'description' => 'Diphtheria, Tetanus, Pertussis booster',
                'doses_required' => 1,
                'age_due_days' => 1460, // 4 years
                'number_of_doses' => 1,
                'dose_interval_days' => 0,
            ],
            [
                'name' => 'IPV Booster',
                'manufacturer' => 'Generic',
                'description' => 'Inactivated Polio booster',
                'doses_required' => 1,
                'age_due_days' => 1460,
                'number_of_doses' => 1,
                'dose_interval_days' => 0,
            ],
            [
                'name' => 'MMR Booster',
                'manufacturer' => 'Generic',
                'description' => 'Measles, Mumps, Rubella booster',
                'doses_required' => 1,
                'age_due_days' => 1460,
                'number_of_doses' => 1,
                'dose_interval_days' => 0,
            ],
            [
                'name' => 'Varicella Booster',
                'manufacturer' => 'Generic',
                'description' => 'Chickenpox booster',
                'doses_required' => 1,
                'age_due_days' => 1460,
                'number_of_doses' => 1,
                'dose_interval_days' => 0,
            ],
        ];

        foreach ($vaccines as $vaccine) {
            DB::table('vaccines')->insert(array_merge($vaccine, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
