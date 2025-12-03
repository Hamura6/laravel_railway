<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfReportController extends Controller
{
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

        // Anchos para las filas superiores
        $widths = [
            'institucion' => 120,
            'gestion' => $totalWidth - 120,
            'masculino' => 63,
            'femenino' => 63,
            'total' => $totalWidth - 63 - 63,
            'rango' => $totalWidth,
            'status' => $totalWidth,
        ];

        // Logo
        $pdf->Image(public_path('image/logo.png'), 10, 6, 30);

        // Encabezado centralizado
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetXY(0, 15);
        $pdf->Cell(0, 10, utf8_decode('REPORTE DE AFILIADOS POR EDAD'), 0, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);

        // Primera fila: INSTITUCIÓN y GESTIÓN
        $pdf->Cell($widths['institucion'], 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1, 0);
        $pdf->Cell($widths['gestion'], 7, utf8_decode('GESTIÓN: ') . date('Y'), 1, 1);

        // Segunda fila: Masculino, Femenino y Total
        $pdf->Cell($widths['masculino'], 7, "Masculino: $masculino", 1, 0);
        $pdf->Cell($widths['femenino'], 7, "Femenino: $femenino", 1, 0);
        $pdf->Cell($widths['total'], 7, 'Total registros: ' . count($affiliates), 1, 1);
        $status = $status ? $status : 'Todos';
        // Tercera fila: Rango de edad
        $pdf->Cell($widths['rango'], 7, utf8_decode("Rango de edad: De $minor a $maximun años"), 1, 1);
        $pdf->Cell($widths['status'], 7, utf8_decode("Estado:$status "), 1, 1);

        $pdf->Ln(5);

        // Tabla encabezados
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(242, 242, 242);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(68, 68, 68);

        // Anchos de columna para tabla
        $w = [10, 50, 15, 55, 20, 40];

        $header = ['#', 'Nombres Completo', 'Edad', 'Correo Electrónico', 'Género', 'Teléfonos'];
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 8, utf8_decode($header[$i]), 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Función para truncar texto largo con puntos suspensivos
        function shortenText($text, $maxLen = 30)
        {
            return mb_strimwidth($text, 0, $maxLen, "...");
        }

        // Tabla datos con filas alternadas
        $pdf->SetFont('Arial', '', 8);
        $fill = false;

        foreach ($affiliates as $index => $a) {
            $pdf->SetFillColor($fill ? 245 : 250, $fill ? 245 : 250, $fill ? 245 : 250);

            $pdf->Cell($w[0], 7, $index + 1, 1, 0, 'C', $fill);

            // Truncar textos largos y decodificar para ñ y acentos
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
        // Traer afiliados con esas especialidades
        $affiliates = Affiliate::whereHas('professions.specialty', function ($query) use ($specialities) {
            $query->whereIn('name', $specialities);
        })
            ->with([
                'user.phones',
                'demands',
                'professions',
            ])
            ->select('id', 'status', 'user_id')
            ->get();

        $total = $affiliates->count();

        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->Image(public_path('image/logo.png'), 10, 6, 30);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE AFILIADOS POR ESPECIALIDAD'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);

        // Fila: Institución y Gestión
        $pdf->Cell(120, 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1);
        $pdf->Cell(70, 7, utf8_decode('GESTIÓN: 2025'), 1);
        $pdf->Ln();

        // Fila: Especialidades
        $pdf->Cell(190, 7, utf8_decode('ESPECIALIDADES: ' . implode(', ', $specialities)), 1);
        $pdf->Ln();

        // Fila: Total
        $pdf->Cell(190, 7, "TOTAL DE AFILIADOS: $total", 1);
        $pdf->Ln(10);

        // Encabezados de la tabla
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);
        $headers = ['#', 'Matrícula', 'Afiliado', 'Email', 'Celular', 'Demandas', 'Especialidades'];
        $widths = [8, 20, 40, 40, 30, 25, 27];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Datos
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
        // Obtener solo las claves (estados) para filtrar
        $estados = array_keys($statusTotal);

        // Consulta de afiliados con estados filtrados
        $affiliates = Affiliate::select('id', 'user_id', 'status', 'created_at')
            ->with(['user:id,name,last_name'])
            ->whereIn('status', $estados)
            ->get();

        $total = $affiliates->count();

        // Crear PDF
        $pdf = new \FPDF();
        $pdf->AddPage();

        // Logo
        $pdf->Image(public_path('image/logo.png'), 10, 6, 30);

        // Título centrado
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE AFILIADOS POR ESTADO'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);

        // Institución y gestión
        $pdf->Cell(120, 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1);
        $pdf->Cell(70, 7, utf8_decode('GESTIÓN: ' . now()->year), 1);
        $pdf->Ln();

        // Estados y conteos
        $estadoText = '';
        foreach ($statusTotal as $estado => $count) {
            $estadoText .= "$estado = $count, ";
        }
        $estadoText = rtrim($estadoText, ', ');
        $pdf->Cell(190, 7, utf8_decode('ESTADOS: ' . $estadoText), 1);
        $pdf->Ln();

        // Total afiliados
        $pdf->Cell(190, 7, "TOTAL DE AFILIADOS: $total", 1);
        $pdf->Ln(10);

        // Encabezados de tabla
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);

        $headers = ['#', 'Matrícula', 'Afiliado', 'Estado', 'Antigüedad'];
        $widths = [10, 25, 75, 40, 40];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Datos afiliados
        $pdf->SetFont('Arial', '', 8);
        $fill = false;

        foreach ($affiliates as $index => $affiliate) {
            $user = $affiliate->user;
            $created = Carbon::parse($affiliate->created_at);
            $antiguedad = $created->diffInYears(now());

            // Alternar color de fila
            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($widths[0], 6, $index + 1, 1, 0, 'C', $fill);
            $pdf->Cell($widths[1], 6, $affiliate->id, 1, 0, 'C', $fill);
            $pdf->Cell($widths[2], 6, utf8_decode($user->name . ' ' . $user->last_name), 1, 0, 'L', $fill);
            $pdf->Cell($widths[3], 6, utf8_decode($affiliate->status), 1, 0, 'C', $fill);
            $pdf->Cell($widths[4], 6, $affiliate->antique, 1, 0, 'C', $fill);

            $pdf->Ln();
            $fill = !$fill;
        }

        // Enviar PDF para descarga
        return response($pdf->Output('I', 'reporte_afiliados_estado.pdf'))
            ->header('Content-Type', 'application/pdf');
    }
    public function affiliateDebt($affiliateId, $year = null, $type = null, $concept = null)
{
    $year ??= date('Y');

    // Obtener afiliado con sumas y relaciones
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

    // Obtener pagos filtrados
    $payments = Payment::select('id', 'affiliate_id', 'date', 'status', 'amount', 'fee_id','updated_at','created_at')
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
        ->orderBy('id', 'desc')
        ->get();

    // Crear PDF personalizado con header y footer mejorados
    $pdf = new class extends \FPDF {
        
        function Header() {
            // Logo en header
            $this->Image(public_path('image/logo.png'), 10, 6, 30);
            
            // Título principal
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(190, 10, utf8_decode('HISTORIAL DE PAGOS DEL AFILIADO'), 0, 1, 'C');
            
            // Subtítulo con fecha de generación
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(190, 5, utf8_decode('Generado el: ' . now()->format('d/m/Y H:i:s')), 0, 1, 'C');
            
            $this->Ln(8);
        }
        
        function Footer() {
            // Posición a 1.5 cm del final
            $this->SetY(-15);
            
            // Fondo rojo para el pie de página
            $this->SetFillColor(220, 53, 69); // Rojo
            $this->SetTextColor(255, 255, 255); // Texto blanco
            $this->SetFont('Arial', 'B', 9);
            
            // Rectángulo de fondo rojo que cubre todo el ancho
            $this->Rect(0, $this->GetY(), $this->GetPageWidth(), 10, 'F');
            
            // Información de contacto centrada
            $this->Cell(0, 10, utf8_decode('📞 Teléfono: 71234567 • 📍 Dirección: Av. Principal #123 • ✉ Email: contacto@colegio.com'), 0, 0, 'C');
            
            // Número de página alineado a la derecha
            $this->SetY(-15);
            $this->SetX(-30);
            $this->Cell(25, 10, 'Pág. ' . $this->PageNo(), 0, 0, 'R');
        }
    };

    $pdf->AddPage();

    // ========== MEJORAS EN LA ESTRUCTURA DE DATOS ==========
    
    // Encabezado de información del afiliado
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(0, 8, utf8_decode('INFORMACIÓN DEL AFILIADO'), 0, 1, 'C', true);
    $pdf->Ln(2);

    // Datos del afiliado - estructura mejorada
    $pdf->SetFont('Arial', '', 10);
    
    // Fila 1
    $pdf->Cell(40, 7, 'Nombre Completo:', 1, 0, 'L');
    $pdf->Cell(75, 7, utf8_decode($affiliate->user->name . ' ' . $affiliate->user->last_name), 1);
    $pdf->Cell(30, 7, 'Matrícula:', 1, 0, 'L');
    $pdf->Cell(45, 7, $affiliate->id, 1, 1, 'C');

    // Fila 2
    $pdf->Cell(40, 7, 'C.I:', 1, 0, 'L');
    $pdf->Cell(75, 7, $affiliate->user->ci, 1);
    $pdf->Cell(30, 7, 'Teléfonos:', 1, 0, 'L');
    $phones = $affiliate->user->phones->pluck('number')->implode(', ');
    $pdf->Cell(45, 7, $phones, 1, 1, 'C');

    // Fila 3
    $pdf->Cell(40, 7, 'Correo:', 1, 0, 'L');
    $pdf->Cell(150, 7, $affiliate->user->email, 1, 1, 'L');

    $pdf->Ln(8);

    // ========== RESUMEN FINANCIERO MEJORADO ==========
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(0, 8, utf8_decode('RESUMEN FINANCIERO'), 0, 1, 'C', true);
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);

    // Totales con mejor formato
    $totalWidth = 63.3; // 190 / 3
    
    // Fila 1: Total
    $pdf->Cell($totalWidth, 8, 'TOTAL GENERAL', 1, 0, 'C', true);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell($totalWidth, 8, number_format($affiliate->totalSum, 2) . ' Bs.', 1, 0, 'C');
    
    // Fila 2: Pagado (continuación)
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($totalWidth, 8, 'TOTAL PAGADO', 1, 1, 'C', true);
    
    // Fila 3: Montos
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell($totalWidth, 8, number_format($affiliate->total_pagado + $affiliate->planes, 2) . ' Bs.', 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($totalWidth, 8, 'DEUDA ACTUAL', 1, 0, 'C', true);
    $pdf->SetFont('Arial', 'B', 11);
    
    // Calcular y mostrar deuda con color condicional
    $deuda = $affiliate->prest - $affiliate->planes;
    if ($deuda > 0) {
        $pdf->SetTextColor(220, 53, 69); // Rojo para deuda
    } else {
        $pdf->SetTextColor(40, 167, 69); // Verde si no hay deuda
    }
    $pdf->Cell($totalWidth, 8, number_format($deuda, 2) . ' Bs.', 1, 1, 'C');
    $pdf->SetTextColor(0, 0, 0); // Restaurar color negro

    $pdf->Ln(10);

    // ========== TABLA DE PAGOS MEJORADA ==========
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(0, 8, utf8_decode('DETALLE DE PAGOS'), 0, 1, 'C', true);
    $pdf->Ln(2);

    // Encabezados de tabla
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(200, 200, 200);
    $headers = ['#', 'Tipo', 'Fecha', 'Fecha Registro', 'Monto', 'Deuda', 'Estado'];
    $widths = [10, 35, 30, 30, 30, 30, 25];
                
    foreach ($headers as $i => $header) {
        $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
    }
    $pdf->Ln();
    
    // Datos de pagos
    $pdf->SetFont('Arial', '', 9);
    $fill = false;
    $totalRegistros = 0;
    
    foreach ($payments as $index => $payment) {
        // Control de paginación automática
        if ($pdf->GetY() > 250) {
            $pdf->AddPage();
        }
        
        $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);
        
        // # 
        $pdf->Cell($widths[0], 6, $index + 1, 1, 0, 'C', $fill);
        
        // Tipo 
        $pdf->Cell($widths[1], 6, utf8_decode($payment->fee->name), 1, 0, 'L', $fill);
        
        // Fecha 
        $pdf->Cell($widths[2], 6, $payment->fecha_display, 1, 0, 'C', $fill);
        
        // Fecha registro 
        $fechaRegistro = $payment->updated_at instanceof \Carbon\Carbon 
            ? $payment->updated_at->format('d/m/Y')
            : ($payment->updated_at ?? 'N/A');
        $pdf->Cell($widths[3], 6, $fechaRegistro, 1, 0, 'C', $fill);
        
        // Monto 
        $pdf->Cell($widths[4], 6, number_format($payment->amount, 2).' Bs.', 1, 0, 'R', $fill);
        
        // Deuda 
        $pdf->Cell($widths[5], 6, number_format($payment->debt, 2) .' Bs.', 1, 0, 'R', $fill);
        
        // Estado con color condicional
        if ($payment->status === 'Pagado') {
            $pdf->SetTextColor(40, 167, 69); // Verde
        } else {
            $pdf->SetTextColor(220, 53, 69); // Rojo
        }
        $pdf->Cell($widths[6], 6, $payment->status, 1, 0, 'C', $fill);
        $pdf->SetTextColor(0, 0, 0); // Restaurar color
        
        $pdf->Ln();
        $fill = !$fill;
        $totalRegistros++;
    }

    // Mostrar contador de registros
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->Cell(0, 6, utf8_decode("Total de registros mostrados: {$totalRegistros}"), 0, 1, 'R');

    // Descargar PDF
    $pdf->Output('D', 'Historial_Pagos_Afiliado_' . $affiliate->id . '_' . date('Y-m-d') . '.pdf');
}
    public function contribution($from, $to)
    {
        // 1️⃣ Obtener institución desde la cache
        $institution = cache('institution');

        // 2️⃣ Convertir fechas a Carbon
        $from = Carbon::parse($from)->startOfDay();
        $to   = Carbon::parse($to)->endOfDay();

        // 3️⃣ Obtener los afiliados filtrados
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

        // 4️⃣ Crear PDF
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Logo
        $pdf->Image(public_path('image/logo.png'), 10, 6, 30);

        // Título
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE PAGOS'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(5);

        // Datos generales
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 7, utf8_decode('Institución:'), 1);
        $pdf->Cell(140, 7, utf8_decode($institution->name), 1);
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

        // Encabezados de tabla
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(200, 200, 200);
        $headers = ['Matricula', 'Nombre Completo', 'Monto Aportes', 'Fecha Registro', 'Teléfonos'];
        $widths = [20, 60, 30, 30, 50]; // Ajusta según tu gusto
        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, utf8_decode($header), 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Datos de afiliados
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

        // Descargar PDF
        $pdf->Output('D', 'Reporte_Afiliados.pdf');
    }
    public function contributionAffiliate($id, $from, $to)
    {
        $institution = cache('institution');

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

   
        $pdf->Image(public_path('image/logo.png'), 10, 6, 30);

 
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 10, utf8_decode('REPORTE DE PAGOS POR AFILIADO'), 0, 1, 'C');
        $pdf->Ln(3);

   


        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(40, 7, 'INSTITUCION:', 1);
        $pdf->Cell(110, 7, utf8_decode($institution->name), 1);
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
