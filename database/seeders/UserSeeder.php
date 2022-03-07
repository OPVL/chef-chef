<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function __construct(protected Csv $csv)
    {
        $this->csv->setFile('users.csv');
    }

    public function run(): void
    {
        $rows = collect($this->csv->read());
        $this->command->getOutput()->progressStart($rows->count());

        $rows->each(
            function (array $user): void {
                $payload = [
                    'name' => Str::ucfirst($user[0]),
                    'email' => $user[1],
                    'password' => bcrypt($user[2]),
                    'is_super' => $user[3],
                ];

                if (!User::firstOrCreate($payload)) {
                    return;
                }

                $this->command->getOutput()->progressAdvance();
            }
        );
        $this->command->getOutput()->progressFinish();
    }
}
