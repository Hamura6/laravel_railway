<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Fee;
use App\Models\Affiliate;

class CrearteContribution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:crearte-contribution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paymentDate = Carbon::now()->startOfMonth();
        $fee = Fee::find(1);
        $affiliates = Affiliate::whereIn('status', ['Activo', 'Inactivo'])->get();
        foreach ($affiliates as $affiliate) {

            $exists = $affiliate->payments()
                ->whereYear('date', '>=', $paymentDate->year)
                ->whereMonth('date', '>=', $paymentDate->month)
                ->exists();
            if (!$exists) {
                $affiliate->payments()->create([
                    'amount'     => $fee->amount,
                    'status'     => 'Por pagar',
                    'date'       => $paymentDate,
                    'fee_id'     => $fee->id,
                    'type'       => 'cash',
                    'user_id'    => null
                ]);
            }
            $pendientes = $affiliate->payments()
                ->where('status', 'Por pagar')
                ->where('fee_id', 1)
                ->count();
            if ($pendientes >= 24) {
                $affiliate->update(['status' => 'Inactivo']);
            } else {
                $affiliate->update(['status' => 'Activo']);
            }
        }
    }
}
