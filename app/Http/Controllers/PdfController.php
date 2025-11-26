<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Recognition;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;



class PdfController extends Controller
{


    public function generarConFpdf($minor, $maximun)
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
        ];

        // Logo
        $pdf->Image(public_path('assets/img/escudo.png'), 10, 6, 30);

        // Encabezado centralizado
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetXY(0, 15);
        $pdf->Cell($totalWidth, 10, utf8_decode('Detalle de Demandas'), 0, 1, 'C');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);

        // Primera fila: INSTITUCIÓN y GESTIÓN
        $pdf->Cell($widths['institucion'], 7, utf8_decode('INSTITUCIÓN: Ilustre colegio de abogados'), 1, 0);
        $pdf->Cell($widths['gestion'], 7, utf8_decode('GESTIÓN: ') . date('Y'), 1, 1);

        // Segunda fila: Masculino, Femenino y Total
        $pdf->Cell($widths['masculino'], 7, "Masculino: $masculino", 1, 0);
        $pdf->Cell($widths['femenino'], 7, "Femenino: $femenino", 1, 0);
        $pdf->Cell($widths['total'], 7, 'Total registros: ' . count($affiliates), 1, 1);

        // Tercera fila: Rango de edad
        $pdf->Cell($widths['rango'], 7, utf8_decode("Rango de edad: De $minor a $maximun años"), 1, 1);

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



    public function form($id)
    {
        $affiliate = Affiliate::with([
            'user:id,name,last_name,ci,email,gender,birthdate,status,photo,martial_status',
            'university:id,name,entity',
            'professions.specialty:id,name',
            'professions.university:id,name'
        ])->findOrFail($id);

        $html = view('pdf.form', compact('affiliate'))->render();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_left' => 15,
            'margin_right' => 15
        ]);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('formulario_' . $affiliate->id . '.pdf', 'I');
    }

    public function debt($id, $form, $to, $type = '', $fee = '')
    {

        /* $affiliate = Affiliate::with(['payments' => function ($query) use ($to, $form, $type, $fee) {
            $query->whereBetween('updated_at', [$form, $to])
                ->when($type, fn($q) => $q->where('status', 'like', "%{$type}%"))
                ->when($fee, fn($q) => $q->where('fee_id', $fee));
        }])->find($id);
        $affiliate = Affiliate::find($id);
        $from = Carbon::parse($form);
        $to = Carbon::parse($to);
        $data = ['affiliate' => $affiliate, 'from' => $from, 'to' => $to];
        $pdf = Pdf::loadView('pdf.debt', $data);
        return $pdf->stream(); */
    }
    public function demandsDetails($id)
    {
        /*  $affiliate = Affiliate::select('id', 'user_id', 'address_home', 'address_number_home', 'zone_home', 'address_office', 'address_number', 'zone')
            ->with(['user:name,last_name,id,ci,email', 'user.phones:number,user_id'])
            ->find($id);
        $demands = Demand::where('affiliate_id', $affiliate->id)
            ->orderBy('id', 'desc')
            ->get();
        $data = ['affiliate' => $affiliate, 'demands' => $demands,];
        $pdf = Pdf::loadView('pdf.demandsDetails', $data);
        return $pdf->stream(); */

        // Obtener datos
        $affiliate = Affiliate::select('id', 'user_id', 'address_home', 'address_number_home', 'zone_home', 'address_office', 'address_number', 'zone')
            ->with([
                'user:id,name,last_name,ci,email', 
                'user.phones:number,user_id',
                'demands:date,name,complainant,phone,created_at,status,description,id,affiliate_id'])
            ->find($id);

        $data = ['affiliate' => $affiliate];

        $html = view('pdf.demandsDetails', $data)->render();

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->WriteHTML($html);

        $mpdf->Output('demands_details.pdf', 'I');
    }
    public function ageAffiliate($minor, $maximun)
    {

        /* $affiliates = DB::table('affiliates')
            ->join('users', 'users.id', '=', 'affiliates.user_id')
            ->leftJoin('phones', 'phones.user_id', '=', 'users.id')
            ->select(
                'affiliates.id as affiliate_id',
                DB::raw("CONCAT(users.name, ' ', users.last_name) as full_name"),
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate',
                DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) as age'),
                DB::raw('GROUP_CONCAT(phones.number SEPARATOR ", ") as phones')
            )
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE())'), [$minor, $maximun])
            ->groupBy(
                'affiliates.id',
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate'
            )
            ->orderByDesc('affiliates.id')
            ->take(600)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray(); */


        /* $query =  Affiliate::select('id', 'user_id') 
            ->with([
                'user:id,name,last_name,email,birthdate,gender',
                'user.phones:id,user_id,number' 
            ])
            ->whereHas('user', function ($query) use ($minor, $maximun) {
                $query->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())'), [$minor, $maximun]);
            })
            ->orderByDesc('id');

        $affiliates = $query->get()->map(function ($affiliate) {
            $user = $affiliate->user;

            $user->full_name = "{$user->name} {$user->last_name}";
            $user->age = Carbon::parse($user->birthdate)->age;

            return $affiliate;
        });



        $masculino = User::where('gender', 'Masculino')
            ->whereIn('id', $affiliates->pluck('user_id'))
            ->count();

        $femenino = User::where('gender', 'Femenino')
            ->whereIn('id', $affiliates->pluck('user_id'))
            ->count();

        $affiliates = $query->take(600)->get();


        $data = ['affiliates' => $affiliates, 'femenino' => $femenino, 'masculino' => $masculino];
        $pdf = Pdf::loadView('pdf.report.ageAffiliate', $data);
        return $pdf->stream(); */
    }
    /*     public function ageAffiliate($minor, $maximun)
    {

        $affiliates = DB::table('affiliates')
            ->join('users', 'users.id', '=', 'affiliates.user_id')
            ->leftJoin('phones', 'phones.user_id', '=', 'users.id')
            ->select(
                'affiliates.id as affiliate_id',
                DB::raw("CONCAT(users.name, ' ', users.last_name) as full_name"),
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate',
                DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) as age'),
                DB::raw('GROUP_CONCAT(phones.number SEPARATOR ", ") as phones')
            )
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE())'), [$minor, $maximun])
            ->groupBy(
                'affiliates.id',
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate'
            )
            ->orderByDesc('affiliates.id')
            ->take(600)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();


        $query =  Affiliate::select('id', 'user_id') // usa también 'id' si lo necesitas en la vista
            ->with([
                'user:id,name,last_name,email,birthdate,gender', // solo lo necesario
                'user.phones:id,user_id,number' // reduce los campos de phones
            ])
            ->whereHas('user', function ($query) use ($minor, $maximun) {
                $query->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())'), [$minor, $maximun]);
            })
            ->orderByDesc('id');

        $affiliates = $query->get()->map(function ($affiliate) {
            $user = $affiliate->user;

            $user->full_name = "{$user->name} {$user->last_name}";
            $user->age = Carbon::parse($user->birthdate)->age;

            return $affiliate;
        });



        $masculino = User::where('gender', 'Masculino')
            ->whereIn('id', $affiliates->pluck('user_id'))
            ->count();

        $femenino = User::where('gender', 'Femenino')
            ->whereIn('id', $affiliates->pluck('user_id'))
            ->count();

        $affiliates = $query->take(655)->get();

        // dd($affiliates);

        $data = ['affiliates' => $affiliates, 'femenino' => $femenino, 'masculino' => $masculino];
        $pdf = Pdf::loadView('pdf.report.ageAffiliate', $data);
        return $pdf->stream();
    }



 */











    public function exportPDF($minor, $maximun)
    {
        // Supongamos que este es tu query base
        $affiliates = DB::table('affiliates')
            ->join('users', 'users.id', '=', 'affiliates.user_id')
            ->leftJoin('phones', 'phones.user_id', '=', 'users.id')
            ->select(
                'affiliates.id as affiliate_id',
                DB::raw("CONCAT(users.name, ' ', users.last_name) as full_name"),
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate',
                DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) as age'),
                DB::raw('GROUP_CONCAT(phones.number SEPARATOR ", ") as phones')
            )
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE())'), [$minor, $maximun])
            ->groupBy(
                'affiliates.id',
                'users.name',
                'users.last_name',
                'users.email',
                'users.gender',
                'users.birthdate'
            )
            ->orderByDesc('affiliates.id')
            ->take(600)
            ->get();
        // Cuenta géneros directamente de la colección
        $masculino = $affiliates->where('gender', 'Masculino')->count();
        $femenino = $affiliates->where('gender', 'Femenino')->count();
        $affiliates = $affiliates->map(fn($item) => (array) $item)->toArray();


        // Renderiza la vista en HTML
        $html = view('pdf.affiliates', compact('affiliates', 'masculino', 'femenino'))->render();

        // Instancia mPDF
        ini_set('pcre.backtrack_limit', 10000000);
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 11,
            'default_font' => 'sans',
            'use_kwt' => true, // usar t
        ]);


        $mpdf->WriteHTML($html);
        return response($mpdf->Output('reporte.pdf', 'I'))->header('Content-Type', 'application/pdf');
    }
    public function listAffiliate($id)
    {
        // 1️⃣ Cargar el reconocimiento con sus relaciones
        $recognition = Recognition::select('id', 'date', 'type', 'name','quantity')
            ->with([
                'affiliates' => function ($query) {
                    $query->select('affiliates.id', 'user_id', 'affiliates.created_at')
                        ->with([
                            'user' => function ($q) {
                                $q->select('id', 'name', 'last_name', 'gender')
                                    ->with([
                                        'phones' => function ($p) {
                                            $p->select('id', 'user_id', 'number');
                                        }
                                    ]);
                            }
                        ]);
                }
            ])
            ->findOrFail($id);

        // 2️⃣ Preparar los datos para la vista
        $data = compact('recognition');

        // 3️⃣ Renderizar la vista en HTML
        $html = view('pdf.listAffliate', $data)->render();

        // 4️⃣ Crear instancia de mPDF
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_left' => 10,
            'margin_right' => 10,
            'default_font_size' => 10,
            'default_font' => 'dejavusans',
        ]);

        // 5️⃣ Escribir el HTML al PDF
        $mpdf->WriteHTML($html);

        // 6️⃣ Descargar o mostrar en navegador
        $fileName = 'reporte_' . $recognition->id . '.pdf';
        return $mpdf->Output($fileName, 'I');
    }
}
