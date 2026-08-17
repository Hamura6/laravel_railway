<?php

namespace App\Livewire\Forms;

use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PaymentForm extends Form
{
    public ?Payment $payment;
    public $id = 0;
    #[Validate('required|not_in:Elegir')]
    public $fee_id = 'Elegir';
    #[Validate('required|decimal:0,2|gte:1.00|lte:9999.99')]
    public $amount = 0;
    public $date = '';
    public $status = 'Por pagar';
    #[Validate('required|not_in:0')]
    public $affiliate_id = 0;
    public $user_id = 0;
    public $type = 'cash';

    public function storeFees($payAmount, $discountAmount)
    {
        $fee = Fee::find($this->fee_id);
        $affiliate = Affiliate::find($this->affiliate_id);
        if (!$affiliate) {
            throw new \Exception("El afiliado no existe.");
        }
        $this->date = now();
        $this->user_id = auth()->user()->id;

        if ($fee->type == 'single_payment' || $discountAmount > 0) {
            if ($discountAmount > 0 && !empty($discountAmount)) {
                $this->amount = $this->amount - $this->amount * $discountAmount / 100;
            }
            $this->status = "Pagado";
            $payment = Payment::create($this->all());
        } else if ($payAmount != $this->amount) {
            $this->status = 'Por pagar';
            $payment = Payment::create($this->all());

            if ($payAmount != 0) {
                $payment->plans()->create([
                    'amount' => $payAmount,
                ]);
            }
        } else {
            $this->status = 'Pagado';
            $payment = Payment::create($this->all());
        }
    }
    public function updateFees($payAmount, $discountAmount)
    {
        $this->payment->plans()->delete();
        $this->date = now();
        $fee = Fee::find($this->fee_id);
        if ($fee->type == 'single_payment' || $discountAmount > 0) {
            if ($discountAmount > 0 && !empty($discountAmount)) {
                $this->amount = $this->amount - $this->amount * $discountAmount / 100;
            }
            $this->status = "Pagado";
        } else if ($payAmount != $this->amount) {
            $this->status = 'Por pagar';
            if ($payAmount != 0) {
                $this->payment->plans()->create([
                    'amount' => $payAmount,
                ]);
            }
        } else {
            $this->status = 'Pagado';
        }
        $this->payment->update($this->all());
    }
    public function store($quantity, $discountAmount, $categoria)
    {
        $affiliate = Affiliate::find($this->affiliate_id);
        if (!$affiliate) {
            throw new \Exception("El afiliado no existe.");
        }
        $pendingPayments = $affiliate->payments()
            ->where('fee_id', 1)
            ->where('status', 'Por pagar')
            ->orderBy('date', 'asc')
            ->get();
        /* dd($pendingPayments); */
        $paymentDate = $this->dateFirst($affiliate);
        if ($categoria == 'Q') {
            $this->storeAport($pendingPayments, $paymentDate, $quantity, $affiliate, $discountAmount);
        } else {
            $this->storeAportAmount($pendingPayments, $paymentDate, $quantity, $affiliate, $discountAmount);
        }
        $total = $affiliate->payments()
            ->where('fee_id', 1)
            ->where('status', 'Por pagar')
            ->count();
        if ($total < 24 && $affiliate->status != 'Fallecido') {
            $affiliate->status = 'Activo';
            $affiliate->save();
        }
    }
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
        $this->fill($payment->only(['id', 'affiliate_id', 'fee_id', 'user_id']));
    }
    public function update($payAmount)
    {

        $this->payment->plans()->delete();
        if ($this->fee_id == 1) {

            $affiliate = Affiliate::find($this->affiliate_id);
            $result = $affiliate->payments()->where('fee_id', 1)->where('status', 'Por pagar')->orderBy('id')->get();
            $date = $this->dateFirst($result, $affiliate);
            $this->storeAport($result, $date, $payAmount, $affiliate, $payAmount);
        } else {
            $this->date = now();

            $fee = Fee::find($this->fee_id);
            if ($fee->quantity > 1) {
                $this->status = $payAmount == $fee->amount ? 'Pagado' : 'Por pagar';
                $this->payment->plans()->create([
                    'amount' => $payAmount,
                ]);
            } else {
                $this->status = 'Pagado';
            }
            $this->payment->update($this->all());
        }
    }
    public function dateFirst($affiliate)
    {
        $date = $affiliate->payments()
            ->where('fee_id', 1)
            ->where('status', 'Por pagar')
            ->orderBy('date', 'desc')
            ->first();
        if ($date) {
            $paymentDate = Carbon::parse($date->date)->firstOfMonth();
        } else {
            $date = $affiliate->payments()
                ->where('fee_id', 1)
                ->where('status', 'Pagado')
                ->orderBy('date', 'desc')
                ->first();
            if ($date) {
                /*  dd($date); */
                $paymentDate = Carbon::parse($date->date)/* ->addMonth(1) */->firstOfMonth();
            } else {
                $paymentDate = Carbon::parse($affiliate->created_at)->firstOfMonth();
            }
        }
        return $paymentDate;
    }
    /*  public function storeAport($pendingPayments, $paymentDate, $quantity, $affiliate,$discountAmount)
    {
        foreach ($pendingPayments as $payment) {
            if($discountAmount>0){
                $amount=$payment->amount-($payment->amount*$discountAmount/100);
                $payment->update([
                    'status' => 'Pagado',
                    'amount'=>$amount
                ]);
            }else{
                $payment->update([
                    'status' => 'Pagado',
                ]);
            }
            $quantity--;
            if ($quantity <= 0) break;
        }
        if($discountAmount>0){
            $this->amount=$this->amount-$this->amount*$discountAmount/100;

        }
        while ($quantity > 0) {
            $affiliate->payments()->create([
                'amount' => $this->amount,
                'status' => 'Pagado',
                'date'   => $paymentDate,
                'fee_id' => $this->fee_id,
                'type' => $this->type,
                'user_id'=>auth()->user()->id 
            ]);

            $paymentDate = Carbon::parse($paymentDate)->addMonth(1);
            $quantity--;
        }
    } */
    public function storeAport($pendingPayments, $paymentDate, $quantity, $affiliate, $discountAmount)
    {


        $total = 0;

        $date_intial =  $pendingPayments->first()->date ?? Carbon::parse($paymentDate)->addMonth(1)->firstOfMonth();


        $quantity = (int)$quantity;
        foreach ($pendingPayments as $payment) {
            if ($discountAmount > 0) {
                $total += ($payment->amount - ($payment->amount * $discountAmount / 100));
            } else {
                $total += $payment->amount;
            }
            $quantity--;
            if ($quantity <= 0) {
                $payment->update([
                    'status' => 'Pagado',
                    'created_at' => $date_intial,
                    'amount' => $total,
                    'type' => $this->type,
                    'discount' => is_numeric($discountAmount) ? (float)$discountAmount : 0,
                    'user_id' => auth()->user()->id
                ]);
                break;
            } else {
                $payment->delete();
                $paymentDate = $payment->date;
            }
        }

        if ($discountAmount > 0) {
            $this->amount = $this->amount - $this->amount * $discountAmount / 100;
        }
        if ($quantity > 0) {
            $paymentDate = Carbon::parse($paymentDate)->addMonth($quantity);
            $total += ($this->amount * $quantity);
            $affiliate->payments()->create([
                'amount' => $total,
                'status' => 'Pagado',
                'date'   => $paymentDate,
                'fee_id' => $this->fee_id,
                'type' => $this->type,
                'discount' => is_numeric($discountAmount) ? (float)$discountAmount : 0,
                'created_at' => $date_intial,
                'user_id' => auth()->user()->id
            ]);
        }
    }
    public function storeAportAmount($pendingPayments, $paymentDate, $amount, $affiliate, $discountAmount)
    {
        $discount = is_numeric($discountAmount) ? (float)$discountAmount : 0;
        $totalPaid = $amount;
        $remaining = $amount;
        $dateInitial = $pendingPayments->first()->date
            ?? Carbon::parse($paymentDate)->addMonth()->firstOfMonth();

        $lastDate = null;

        foreach ($pendingPayments as $payment) {
            $pay = $discount > 0
                ? $payment->amount - ($payment->amount * $discount / 100)
                : $payment->amount;

            $remainder = 0;

            if ($remaining < $pay) {
                $remainder = $payment->amount - $remaining;
                $remaining -= $payment->amount;
            } else {
                $remaining -= $pay;
            }

            if ($remaining <= 0) {
                $paidData = [
                    'status'     => 'Pagado',
                    'created_at' => $dateInitial,
                    'amount'     => $totalPaid,
                    'type'       => $this->type,
                    'discount'   => $discount,
                    'user_id'    => auth()->id(),
                ];

                if ($remainder > 0) {
                    $paidData['date'] = Carbon::parse($payment->date);
                }

                $payment->update($paidData);

                if ($remainder > 0) {
                    $affiliate->payments()->create([
                        'amount'     => $remainder,
                        'status'     => 'Por pagar',
                        'date'       => $paidData['date'],
                        'fee_id'     => 1,
                        'type'       => 'cash',
                        'created_at' => $paidData['date'],
                        'user_id'    => auth()->id(),
                    ]);
                }

                $remaining = 0;
                break;
            }

            $lastDate = $payment->date;
            $payment->delete();
        }

        if ($discount > 0) {
            $this->amount -= $this->amount * $discount / 100;
        }

        if ($remaining > 0) {
            $feeMonthly = Fee::find(1)->amount;
            $baseDate = $lastDate
                ? Carbon::parse($lastDate)
                : Carbon::parse($dateInitial)->firstOfMonth();

            $monthsForward = (int)($remaining / $this->amount);
            $paymentDate = $baseDate->copy()->addMonths($monthsForward);

            $affiliate->payments()->create([
                'amount'     => $totalPaid,
                'status'     => 'Pagado',
                'date'       => $paymentDate->copy()->addMonth(),
                'discount'   => $discount,
                'fee_id'     => $this->fee_id,
                'type'       => $this->type,
                'created_at' => $dateInitial,
                'user_id'    => auth()->id(),
            ]);

            $fraction = fmod($remaining, $this->amount);
            if ($fraction > 0) {
                $affiliate->payments()->create([
                    'amount'     => $feeMonthly - $fraction,
                    'status'     => 'Por pagar',
                    'date'       => $paymentDate->copy()->addMonth(),
                    'fee_id'     => $this->fee_id,
                    'type'       => 'cash',
                    'created_at' => $paymentDate->copy()->addMonth(),
                    'user_id'    => auth()->id(),
                ]);
            }
        }
    }
}
