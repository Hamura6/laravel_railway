<?php

namespace Database\Seeders;

use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Phone;
use App\Models\Profession;
use App\Models\University;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call(SeederPermission::class);
        $this->call(SeederRol::class);
        $this->call(FeeSeeder::class);
        $this->call(SeederUniversity::class);
        $this->call(InstitutionSeeder::class);

        /* DB::listen(fn($q) => logger()->debug('SQL' . make_query_sql($q))); */

        $this->call(UserSeeder::class);
        $this->call(AffiliateSeeder::class);

        $this->call(SeederSpecialty::class);
        $this->call(DeceasedsSeeder::class);
        $this->call(DirectorySeed::class);

        $userMaster = User::create([
            'name' => 'Hamura',
            'last_name' => 'Otsutsuki',
            'birthdate' => '2005-10-10',
            'gender' => 'Masculino',
            'martial_status' => 'Divorciado',
            'ci' => '14482906',
            'email' => 'deidaramen2@gmail.com',
            'password' => Hash::make('madaradelos6')
        ]);
        $userMaster->assignRole('Administrador');
        $permissionsAll = Permission::pluck('id')->toArray();
        $role=Role::find(2);
        $role->syncPermissions($permissionsAll);
        $userMaster = User::create([
            'name' => 'Madara',
            'last_name' => 'Uchiha',
            'birthdate' => '2005-10-10',
            'gender' => 'Masculino',
            'martial_status' => 'Divorciado',
            'ci' => '14482907',
            'email' => 'deidaramen3@gmail.com',
            'password' => Hash::make('madaradelos7')
        ]);
        $userMaster->assignRole('Contadora');

         /* $this->call(PaymentSeeder::class); */

        /* $this->generatePayments($userMaster);
 */
        // Profession::factory()->count(3000)->create();

    }

    private function generatePayments(User $userMaster)
    {
        $feeIds = Fee::pluck('id')->toArray();
        $affiliateIds = Affiliate::pluck('id');
        $userId = $userMaster->id;

        $generatePayment = function () use ($userId, $feeIds, $affiliateIds) {
            return [
                'amount' => fake()->randomFloat(2, 10, 1000),
                'status' => fake()->randomElement(['Pagado', 'Por pagar']),
                'date' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d H:i:s'),
                'fee_id' => fake()->randomElement($feeIds),
                'user_id' => $userId,
                'affiliate_id' => fake()->randomElement($affiliateIds),
            ];
        };

        // Número total de registros a insertar
        $totalPayments = 40000;
        $batchSize = 10000;

        for ($batch = 0; $batch < $totalPayments / $batchSize; $batch++) {
            $payments = [];

            for ($i = 0; $i < $batchSize; $i++) {
                $payments[] = $generatePayment();
            }

            // Inserta los registros por lote para evitar sobrecargar la memoria
            Payment::insert($payments);
            unset($payments); // libera memoria
        }
    }
}
