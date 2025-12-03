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
        $this->user_id=auth()->user()->id;

        if ($fee->type == 'single_payment' || $discountAmount > 0) {
            if ($discountAmount > 0 && !empty($discountAmount)) {
                $this->amount = $this->amount - $this->amount * $discountAmount / 100;
            }
            $this->status = "Pagado";
            $payment = Payment::create($this->all());
        } else if ($payAmount != $this->amount) {
            $this->status = 'Por pagar';
            $payment = Payment::create($this->all());
            if($payAmount!=0){
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
            $this->payment->plans()->create([
                'amount' => $payAmount,
            ]);
        } else {
            $this->status = 'Pagado';
        }
        $this->payment->update($this->all());
    }




    public function store($quantity, $discountAmount)
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
        $this->storeAport($pendingPayments, $paymentDate, $quantity, $affiliate, $discountAmount);
        $total = $affiliate->payments()
            ->where('fee_id', 1)
            ->where('status', 'Por pagar')
            ->count();
        if($total<24){
            $affiliate->status='Activo';
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
            $view=$affiliate->payments()->create([
                'amount' => $total,
                'status' => 'Pagado',
                'date'   => $paymentDate,
                'fee_id' => $this->fee_id,
                'type' => $this->type,
                'created_at' => $date_intial,
                'user_id' => auth()->user()->id
            ]);
        }
    }
}
