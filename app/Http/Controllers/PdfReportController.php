<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Payment;
use App\Models\Institution;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;

class PdfReportController extends Controller
{
    public $institution;
    public function __construct()
    {
        $this->institution = Institution::first();
    }
    public function ageAffiliate($minor, $maximun, $status = '')
    {
        $affiliates = DB::table('affiliates')
            ->join('users', 'users.id', '=', 'affiliates.user_id')
            ->leftJoin('phones', 'phones.user_id', '=', 'users.id')
            ->select(
                'affiliates.id as affiliate_id',
                DB::raw("CONCAT(users.name, ' ', users.last_name) as full_name"),
                'users.email',
                'users.gender',
                DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) as age'),
                DB::raw('GROUP_CONCAT(phones.number SEPARATOR ", ") as phones')
            )
            ->where('affiliates.status', 'like', "%$status%")
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE())'), [$minor, $maximun])
            ->groupBy(
                'affiliates.id',
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate'
            )
            ->orderBy('age', 'asc')
            ->get();

        $masculino = $affiliates->where('gender', 'Masculino')->count();
        $femenino = $affiliates->where('gender', 'Femenino')->count();

        $pdf = new \FPDF();
        $pdf->AddPage();

        $totalWidth = 190;

        $widths = [
            'institucion' => 120,
            'gestion' => $totalWidth - 120,
            'masculino' => 63,
            'femenino' => 63,
            'total' => $totalWidth - 63 - 63,
            'rango' => $totalWidth,
            'status' => $totalWidth,
        ];

        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                $pdf->Image(public_path('storage/institution/logo.png'), 10, 6, 15, 15);
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $pdf->Image(public_path('image/logo.png'), 10, 6, 15, 15);
        }

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetXY(0, 15);
        $pdf->Cell(0, 10, utf8_decode('REPORTE DE AFILIADOS POR EDAD'), 0, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);


        $pdf->Cell($widths['institucion'], 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1, 0);
        $pdf->Cell($widths['gestion'], 7, utf8_decode('GESTIÓN: ') . date('Y'), 1, 1);


        $pdf->Cell($widths['masculino'], 7, "Masculino: $masculino", 1, 0);
        $pdf->Cell($widths['femenino'], 7, "Femenino: $femenino", 1, 0);
        $pdf->Cell($widths['total'], 7, 'Total registros: ' . count($affiliates), 1, 1);
        $status = $status ? $status : 'Todos';

        $pdf->Cell($widths['rango'], 7, utf8_decode("Rango de edad: De $minor a $maximun años"), 1, 1);
        $pdf->Cell($widths['status'], 7, utf8_decode("Estado:$status "), 1, 1);

        $pdf->Ln(5);


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(242, 242, 242);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(68, 68, 68);


        $w = [10, 50, 15, 55, 20, 40];

        $header = ['#', 'Nombres Completo', 'Edad', 'Correo Electrónico', 'Género', 'Teléfonos'];
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 8, utf8_decode($header[$i]), 1, 0, 'C', true);
        }
        $pdf->Ln();


        function shortenText($text, $maxLen = 30)
        {
            return mb_strimwidth($text, 0, $maxLen, "...");
        }


        $pdf->SetFont('Arial', '', 8);
        $fill = false;

        foreach ($affiliates as $index => $a) {
            $pdf->SetFillColor($fill ? 245 : 250, $fill ? 245 : 250, $fill ? 245 : 250);

            $pdf->Cell($w[0], 7, $index + 1, 1, 0, 'C', $fill);


            $pdf->Cell($w[1], 7, utf8_decode(shortenText($a->full_name, 30)), 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, $a->age, 1, 0, 'C', $fill);
            $pdf->Cell($w[3], 7, utf8_decode(shortenText($a->email, 35)), 1, 0, 'L', $fill);
            $pdf->Cell($w[4], 7, utf8_decode($a->gender), 1, 0, 'C', $fill);
            $pdf->Cell($w[5], 7, utf8_decode(shortenText($a->phones ?? '', 30)), 1, 0, 'L', $fill);

            $pdf->Ln();
            $fill = !$fill;
        }

        return response($pdf->Output('I', 'reporte_afiliados.pdf'))
            ->header('Content-Type', 'application/pdf');
    }
    public function specialityAffiliate(Request $request)
    {
        $specialities = $request->input('specialities', []);
        $affiliates = Affiliate::whereHas('professions.specialty', function ($query) use ($specialities) {
            $query->whereIn('name', $specialities);
        })
            ->with([
                'user.phones',
                'demands',
                'professions',
            ])
            ->select('id', 'status', 'user_id', 'address_office', 'address_number', 'zone')
            ->get();

        $total = $affiliates->count();

        $pdf = new \FPDF();
        $pdf->AddPage();
        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                $pdf->Image(public_path('storage/institution/logo.png'), 10, 6, 15, 15);
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $pdf->Image(public_path('image/logo.png'), 10, 6, 15, 15);
        }
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE AFILIADOS POR ESPECIALIDAD'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);

        $pdf->Cell(120, 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1);
        $pdf->Cell(70, 7, utf8_decode('GESTIÓN: 2025'), 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10); // Ajusta la fuente si es necesario
        $pdf->MultiCell(190, 7, utf8_decode('ESPECIALIDADES: ' . implode(', ', $specialities)), 1);
        $pdf->Ln();

        $pdf->Cell(190, 7, "TOTAL DE AFILIADOS: $total", 1);
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);
        $headers = ['#', 'Matrícula', 'Afiliado', 'Email', 'Celular', 'Demandas', 'Especialidades'];
        $widths = [8, 20, 40, 40, 30, 25, 27];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();


        $pdf->SetFont('Arial', '', 8);
        $fill = false;

        foreach ($affiliates as $index => $affiliate) {
            $user = $affiliate->user;
            $phone = $user->phones->first()->number ?? 'Sin número';

            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($widths[0], 6, $index + 1, 1, 0, 'C', $fill);
            $pdf->Cell($widths[1], 6, $affiliate->id, 1, 0, 'C', $fill);
            $pdf->Cell($widths[2], 6, utf8_decode($user->full_name ?? ''), 1, 0, 'L', $fill);
            $pdf->Cell($widths[3], 6, utf8_decode($user->email ?? ''), 1, 0, 'L', $fill);
            $pdf->Cell($widths[4], 6, utf8_decode($phone), 1, 0, 'L', $fill);
            $pdf->Cell($widths[5], 6, $affiliate->demands->count(), 1, 0, 'C', $fill);
            $pdf->Cell($widths[6], 6, $affiliate->professions->count(), 1, 0, 'C', $fill);
            $pdf->Ln();

            $fill = !$fill;
        }

        return response($pdf->Output('I', 'reporte_especialidades.pdf'))
            ->header('Content-Type', 'application/pdf');
    }
    public function statusAffiliate(Request $request)
    {
        $statusTotal = $request->input('statusTotal', []);

        $estados = array_keys($statusTotal);


        $affiliates = Affiliate::select('id', 'user_id', 'status', 'created_at')
            ->with(['user:id,name,last_name'])
            ->whereIn('status', $estados)
            ->get();

        $total = $affiliates->count();


        $pdf = new \FPDF();
        $pdf->AddPage();


        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                $pdf->Image(public_path('storage/institution/logo.png'), 10, 6, 15, 15);
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $pdf->Image(public_path('image/logo.png'), 10, 6, 15, 15);
        }


        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE AFILIADOS POR ESTADO'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);


        $pdf->Cell(120, 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1);
        $pdf->Cell(70, 7, utf8_decode('GESTIÓN: ' . now()->year), 1);
        $pdf->Ln();


        $estadoText = '';
        foreach ($statusTotal as $estado => $count) {
            $estadoText .= "$estado = $count, ";
        }
        $estadoText = rtrim($estadoText, ', ');
        $pdf->Cell(190, 7, utf8_decode('ESTADOS: ' . $estadoText), 1);
        $pdf->Ln();


        $pdf->Cell(190, 7, "TOTAL DE AFILIADOS: $total", 1);
        $pdf->Ln(10);


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);

        $headers = ['#', 'Matrícula', 'Afiliado', 'Estado', 'Antigüedad'];
        $widths = [10, 25, 75, 40, 40];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 8);
        $fill = false;

        foreach ($affiliates as $index => $affiliate) {
            $user = $affiliate->user;
            $created = Carbon::parse($affiliate->created_at);
            $antiguedad = $created->diffInYears(now());

            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($widths[0], 6, $index + 1, 1, 0, 'C', $fill);
            $pdf->Cell($widths[1], 6, $affiliate->id, 1, 0, 'C', $fill);
            $pdf->Cell($widths[2], 6, utf8_decode($user->name . ' ' . $user->last_name), 1, 0, 'L', $fill);
            $pdf->Cell($widths[3], 6, utf8_decode($affiliate->status), 1, 0, 'C', $fill);
            $pdf->Cell($widths[4], 6, $affiliate->antique, 1, 0, 'C', $fill);

            $pdf->Ln();
            $fill = !$fill;
        }

        return response($pdf->Output('I', 'reporte_afiliados_estado.pdf'))
            ->header('Content-Type', 'application/pdf');
    }
    public function affiliateDebt($affiliateId, $year = null, $type = null, $concept = null)
    {
        $year ??= date('Y');

        $affiliate = Affiliate::select('id', 'user_id')
            ->withSum(['payments as totalSum' => function ($query) use ($year, $type, $concept) {
                $query->whereYear('date', '>=', $year)
                    ->when($type, fn($q) => $q->where('status', 'like', "%{$type}%"))
                    ->when($concept, fn($q) => $q->where('fee_id', $concept));
            }], 'amount')
            ->withSum(['payments as prest' => function ($query) use ($year, $type, $concept) {
                $query->where('status', 'Por pagar')->whereYear('date', '>=', $year)
                    ->when($type, fn($q) => $q->where('status', 'like', "%{$type}%"))
                    ->when($concept, fn($q) => $q->where('fee_id', $concept));
            }], 'amount')
            ->withSum(['plans as planes' => function ($query) use ($year, $type, $concept) {
                $query->whereHas('payment', fn($q) => $q->where('status', 'Por pagar'))
                    ->whereYear('date', '>=', $year)
                    ->when($type, fn($q) => $q->where('status', 'like', "%{$type}%"))
                    ->when($concept, fn($q) => $q->where('fee_id', $concept));
            }], 'amount')
            ->withSum(['payments as total_pagado' => function ($query) use ($year, $type, $concept) {
                $query->where('status', 'pagado')->whereYear('date', '>=', $year)
                    ->when($type, fn($q) => $q->where('status', 'like', "%{$type}%"))
                    ->when($concept, fn($q) => $q->where('fee_id', $concept));
            }], 'amount')
            ->with([
                'user:name,last_name,ci,id,email',
                'user.phones:number,id,user_id'
            ])
            ->find($affiliateId);

        $payments = Payment::select('id', 'affiliate_id', 'date', 'status', 'amount', 'fee_id', 'updated_at', 'created_at')
            ->whereYear('date', '>=', $year)
            ->where('affiliate_id', $affiliateId)
            ->when($type, fn($q) => $q->where('status', 'like', "%{$type}%"))
            ->when($concept, fn($q) => $q->where('fee_id', $concept))
            ->addSelect([
                'debt' => Plan::selectRaw("
            CASE 
                WHEN payments.status = 'Pagado' THEN 0
                WHEN COUNT(plans.id) = 0 THEN payments.amount
                ELSE COALESCE(payments.amount-SUM(plans.amount), 0)
            END
        ")->whereColumn('plans.payment_id', 'payments.id')
            ])
            ->with(['fee:id,name'])
            ->orderBy('date', 'asc')
            ->get();

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                $pdf->Image(public_path('storage/institution/logo.png'), 10, 6, 15, 15);
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $pdf->Image(public_path('image/logo.png'), 10, 6, 15, 15);
        }
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 20, utf8_decode('DETALLE DE SALDO'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);


        $pdf->Cell(115, 7, 'Nombre Completo: ' . utf8_decode($affiliate->user->name . ' ' . $affiliate->user->last_name), 1, 0, 'L');
        $pdf->Cell(75, 7, utf8_decode('Matrícula: ') . $affiliate->id, 1, 1, 'L');


        $pdf->Cell(115, 7, 'C.I: ' . $affiliate->user->ci, 1, 0, 'L');
        $phones = $affiliate->user->phones->pluck('number')->implode(', ');
        $pdf->Cell(75, 7, utf8_decode('Teléfonos: ') . $phones, 1, 1, 'L');

        $pdf->Cell(190, 7, 'Correo: ' . utf8_decode($affiliate->user->email), 1, 1, 'L');
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(240, 240, 240);
        $pdf->Cell(0, 8, utf8_decode('RESUMEN FINANCIERO'), 0, 1, 'C', true);
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);

        $totalWidth = 63.3;

        $pdf->Cell($totalWidth, 8, 'TOTAL GENERAL', 1, 0, 'C', true);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell($totalWidth, 8, 'TOTAL PAGADO', 1, 0, 'C', true);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($totalWidth, 8, 'DEUDA ACTUAL', 1, 1, 'C', true);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($totalWidth, 8, number_format($affiliate->totalSum, 2) . ' Bs.', 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($totalWidth, 8, number_format($affiliate->total_pagado + $affiliate->planes, 2) . ' Bs.', 1, 0, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        $deuda = $affiliate->prest - $affiliate->planes;
        if ($deuda > 0) {
            $pdf->SetTextColor(220, 53, 69);
        } else {
            $pdf->SetTextColor(40, 167, 69);
        }
        $pdf->Cell($totalWidth, 8, number_format($deuda, 2) . ' Bs.', 1, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(240, 240, 240);
        $pdf->Cell(0, 8, utf8_decode('DETALLE DE PAGOS'), 0, 1, 'C', true);
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(200, 200, 200);
        $headers = ['#', 'Tipo', 'Fecha', 'Fecha Registro', 'Monto', 'Deuda', 'Estado'];
        $widths = [10, 35, 30, 30, 30, 30, 25];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 9);
        $fill = false;
        $totalRegistros = 0;

        foreach ($payments as $index => $payment) {
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
            }

            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($widths[0], 6, $index + 1, 1, 0, 'C', $fill);

            $pdf->Cell($widths[1], 6, utf8_decode($payment->fee->name), 1, 0, 'L', $fill);

            $pdf->Cell($widths[2], 6, $payment->fecha_display, 1, 0, 'C', $fill);

            $fechaRegistro = $payment->updated_at instanceof \Carbon\Carbon
                ? $payment->updated_at->format('d/m/Y')
                : ($payment->updated_at ?? 'N/A');
            $pdf->Cell($widths[3], 6, $fechaRegistro, 1, 0, 'C', $fill);

            $pdf->Cell($widths[4], 6, number_format($payment->amount, 2) . ' Bs.', 1, 0, 'R', $fill);

            $pdf->Cell($widths[5], 6, number_format($payment->debt, 2) . ' Bs.', 1, 0, 'R', $fill);

            if ($payment->status === 'Pagado') {
                $pdf->SetTextColor(40, 167, 69);
            } else {
                $pdf->SetTextColor(220, 53, 69);
            }
            $pdf->Cell($widths[6], 6, $payment->status, 1, 0, 'C', $fill);
            $pdf->SetTextColor(0, 0, 0);

            $pdf->Ln();
            $fill = !$fill;
            $totalRegistros++;
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(0, 6, utf8_decode("Total de registros mostrados: {$totalRegistros}"), 0, 1, 'R');

        $pdf->Output('D', 'Historial_Pagos_Afiliado_' . $affiliate->id . '_' . date('Y-m-d') . '.pdf');
    }
    public function contribution($from, $to)
    {

        $from = Carbon::parse($from)->startOfDay();
        $to   = Carbon::parse($to)->endOfDay();

        $affiliates = Affiliate::select('id', 'user_id', 'created_at')
            ->withSum(['payments' => function ($paymentsQuery) use ($from, $to) {
                $paymentsQuery
                    ->where('fee_id', 1)
                    ->where('status', 'Pagado')
                    ->whereBetween('created_at', [$from, $to]);
            }], 'amount')
            ->with(['user:id,name,last_name,email,ci', 'user.phones:number,user_id'])
            ->orderBy('id', 'desc')
            ->get();

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                $pdf->Image(public_path('storage/institution/logo.png'), 10, 6, 15, 15);
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $pdf->Image(public_path('image/logo.png'), 10, 6, 15, 15);
        }

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE PAGOS'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 7, utf8_decode('Institución:'), 1);
        $pdf->Cell(140, 7, utf8_decode($this->institution->name), 1);
        $pdf->Ln();
        $pdf->Cell(30, 7, utf8_decode('Gestión:'), 1);
        $pdf->Cell(20, 7, date('Y'), 1);
        $pdf->Cell(35, 7, 'Fecha Desde:', 1);
        $pdf->Cell(35, 7, $from->format('d/m/Y'), 1);
        $pdf->Cell(35, 7, 'Fecha Hasta:', 1);
        $pdf->Cell(35, 7, $to->format('d/m/Y'), 1);
        $pdf->Ln();

        $pdf->Cell(50, 7, 'Cantidad de Afiliados:', 1);
        $pdf->Cell(70, 7, count($affiliates), 1);
        $pdf->Cell(35, 7, 'Total Aportes:', 1);
        $pdf->Cell(35, 7, number_format($affiliates->sum('payments_sum_amount'), 2) . ' Bs.', 1);
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(200, 200, 200);
        $headers = ['Matricula', 'Nombre Completo', 'Monto Aportes', 'Fecha Registro', 'Teléfonos'];
        $widths = [20, 60, 30, 30, 50]; // Ajusta según tu gusto
        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 9);
        $fill = false;
        foreach ($affiliates as $affiliate) {
            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($widths[0], 6, $affiliate->id, 1, 0, 'C', $fill);
            $pdf->Cell($widths[1], 6, utf8_decode($affiliate->user->name . ' ' . $affiliate->user->last_name), 1, 0, 'L', $fill);
            $pdf->Cell($widths[2], 6, number_format($affiliate->payments_sum_amount ?? 0, 2) . ' Bs.', 1, 0, 'R', $fill);
            $pdf->Cell($widths[3], 6, \Carbon\Carbon::parse($affiliate->created_at)->format('d/m/Y'), 1, 0, 'C', $fill);
            $phones = $affiliate->user->phones->pluck('number')->implode(', ');
            $pdf->Cell($widths[4], 6, $phones, 1, 0, 'L', $fill);

            $pdf->Ln();
            $fill = !$fill;
        }

        $pdf->Output('D', 'Reporte_Afiliados.pdf');
    }
    public function contributionAffiliate($id, $from, $to)
    {


        $fromCarbon = Carbon::parse($from)->startOfDay();
        $toCarbon   = Carbon::parse($to)->endOfDay();

        $affiliate = Affiliate::select('id', 'user_id', 'status')
            ->with(['user:id,name,last_name', 'user.phones:number,user_id'])
            ->find($id);

        $pagos = Payment::where('status', 'Pagado')
            ->where('affiliate_id', $affiliate->id)
            ->whereBetween('created_at', [$fromCarbon, $toCarbon])
            ->with(['user:id,name,last_name'])
            ->get();

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();


        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                $pdf->Image(public_path('storage/institution/logo.png'), 10, 6, 15, 15);
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $pdf->Image(public_path('image/logo.png'), 10, 6, 15, 15);
        }


        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE PAGOS POR AFILIADO'), 0, 1, 'C');
        $pdf->Ln(3);




        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(40, 7, 'INSTITUCION:', 1);
        $pdf->Cell(110, 7, utf8_decode($this->institution->name), 1);
        $pdf->Cell(40, 7, 'GESTION: ' . date('Y'), 1);
        $pdf->Ln();

        $pdf->Cell(40, 7, 'Nombre:', 1);
        $pdf->Cell(110, 7, utf8_decode($affiliate->user->name . ' ' . $affiliate->user->last_name), 1);
        $pdf->Cell(40, 7, 'Matricula: ' . $affiliate->id, 1);
        $pdf->Ln();

        $pdf->Cell(40, 7, 'Fecha:', 1);
        $pdf->Cell(110, 7, $fromCarbon->format('d/m/Y') . ' al ' . $toCarbon->format('d/m/Y'), 1);
        $pdf->Cell(40, 7, 'Estado: ' . $affiliate->status, 1);
        $pdf->Ln(10);


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(200, 200, 200);

        $headers = ['Nro', 'Fecha', 'Recaudador', 'Aportes', 'Descargo', 'Total'];
        $widths  = [10, 35, 40, 35, 35, 35];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();


        $pdf->SetFont('Arial', '', 9);
        $fill = false;

        foreach ($pagos as $index => $pago) {
            $pdf->SetFillColor($fill ? 245 : 255);

            $pdf->Cell($widths[0], 6, $index + 1, 1, 0, 'C', $fill);
            $pdf->Cell($widths[1], 6, Carbon::parse($pago->updated_at)->format('d/m/Y H:i'), 1, 0, 'C', $fill);
            $pdf->Cell($widths[2], 6, utf8_decode($pago->user->full_name), 1, 0, 'L', $fill);
            $pdf->Cell($widths[3], 6, utf8_decode($pago->fecha_display), 1, 0, 'L', $fill);
            $pdf->Cell($widths[4], 6, utf8_decode($pago->type), 1, 0, 'L', $fill);
            $pdf->Cell($widths[5], 6, number_format($pago->amount, 2) . ' Bs.', 1, 0, 'R', $fill);

            $pdf->Ln();
            $fill = !$fill;
        }

        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
