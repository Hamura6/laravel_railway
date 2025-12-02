<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Recognition;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;
use App\Helpers\GlobalPdf;



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

        $pdf = new GlobalPdf();
        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln(40); // crea espacio bajo el header

        // -------------------------------------------------------
        // FILAS SUPERIORES DE INFORMACIÓN
        // -------------------------------------------------------

        $widths = [
            'institucion' => 120,
            'gestion' => 70,
            'masculino' => 63,
            'femenino' => 63,
            'total' => 64,
            'rango' => 190,
        ];

        $pdf->Cell($widths['institucion'], 7, utf8_decode('INSTITUCIÓN: Ilustre Colegio de Abogados'), 1, 0);
        $pdf->Cell($widths['gestion'], 7, 'GESTIÓN: ' . date('Y'), 1, 1);

        $pdf->Cell($widths['masculino'], 7, "Masculino: $masculino", 1, 0);
        $pdf->Cell($widths['femenino'], 7, "Femenino: $femenino", 1, 0);
        $pdf->Cell($widths['total'], 7, 'Total registros: ' . count($affiliates), 1, 1);

        $pdf->Cell($widths['rango'], 7, utf8_decode("Rango de edad: De $minor a $maximun años"), 1, 1);

        $pdf->Ln(5);

        // -------------------------------------------------------
        // TABLA
        // -------------------------------------------------------

        $w = [10, 50, 15, 55, 20, 40];
        $header = ['#', 'Nombre Completo', 'Edad', 'Correo', 'Género', 'Teléfonos'];

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(240, 240, 240);

        foreach ($header as $i => $head) {
            $pdf->Cell($w[$i], 8, utf8_decode($head), 1, 0, 'C', true);
        }
        $pdf->Ln();

        function shortenText($text, $maxLen = 30)
        {
            return mb_strimwidth($text, 0, $maxLen, "...");
        }

        $pdf->SetFont('Arial', '', 8);
        $fill = false;

        foreach ($affiliates as $index => $a) {

            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($w[0], 7, $index + 1, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 7, utf8_decode(shortenText($a->full_name)), 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, $a->age, 1, 0, 'C', $fill);
            $pdf->Cell($w[3], 7, utf8_decode(shortenText($a->email)), 1, 0, 'L', $fill);
            $pdf->Cell($w[4], 7, utf8_decode($a->gender), 1, 0, 'C', $fill);
            $pdf->Cell($w[5], 7, utf8_decode(shortenText($a->phones ?? '')), 1, 1, 'L', $fill);

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
        /*   $affiliate = Affiliate::with([
            'user',
            'university',
            'professions.specialty',
            'professions.university'
        ])->findOrFail($id);


        $pdf = new GlobalPdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 10); */

        /*
    =========================================================
    ============= SECCIÓN 1: FOTO Y TABLA SUPERIOR ==========
    =========================================================
    */

        // Foto del usuario
        /*   $pdf->Image(
            public_path("storage/users/" . $affiliate->user->photo),
            150,
            45,
            40,
            40
        ); */

        // TABLA DE FECHAS
        /*   $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 8, "Fecha de Registro", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 8, $affiliate->created_at, 1, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 8, "Matricula ICAP", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 8, $affiliate->id, 1, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 8, "Matricula CONALAB", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 8, $affiliate->enrollment_conalab, 1, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 8, "Matricula RPA", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 8, $affiliate->enrollment_RPA, 1, 1);

        $pdf->Ln(5); */

        /*
    =========================================================
    ==================== SECCIÓN 2: DATOS PERSONALES ========
    =========================================================
    */
        /*  $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(2, 27, 65);
        $pdf->Cell(0, 8, utf8_decode("1. DATOS PERSONALES"), 0, 1);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(4);
        $pdf->SetTextColor(0, 0, 0); */

        // Apellidos
        /* $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 8, "Apellidos", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(155, 8, utf8_decode($affiliate->user->last_name), 1, 1); */

        // Nombres
        /*  $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 8, "Nombres", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(155, 8, utf8_decode($affiliate->user->name), 1, 1);
 */
        // Fila con CI - nacimiento - lugar
        /*  $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 8, "C.I", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(30, 8, $affiliate->user->ci, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 8, "Fecha de Nacimiento", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 8, $affiliate->user->birthdate, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 8, "Lugar", 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 8, $affiliate->place, 1, 1); */

        /*
    =========================================================
    ==================== SIGUEN LAS DEMÁS SECCIONES =========
    =========================================================
    */

        // Puedes seguir así armando las demás tablas:
        // - Datos del Afiliado
        // - Datos Profesionales
        // - Especializaciones (con foreach)
        // - Firma

        /* return response($pdf->Output("I", "formulario_$id.pdf"))
            ->header("Content-Type", "application/pdf"); */

/* $affiliate = Affiliate::with([
    'user:id,name,last_name,ci,email,gender,birthdate,status,photo,martial_status',
    'university:id,name,entity',
    'professions.specialty:id,name',
    'professions.university:id,name'
])->findOrFail($id);

$pdf = new GlobalPdf();
$pdf->AddPage();

// Colores
$headerColor = [200,200,200];
$dataColor = [255,255,255];

// ====== Logo ======
$institutionLogo = public_path('storage/institution/'.$institution->logo);
$userPhoto = public_path('storage/users/'.$affiliate->user->photo);

if(file_exists($institutionLogo)){
    $pdf->Image($institutionLogo, 10, 10, 40);
}

// ====== Título centrado ======
$pdf->SetFont('Arial','BU',16);
$pdf->SetXY(0, 20);
$pdf->Cell(0,10,'FORMULARIO DE INSCRIPCION',0,1,'C');
$pdf->Ln(15);

// ====== Tabla perfil + foto ======
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(...$headerColor);

$startX = $pdf->GetX();
$startY = $pdf->GetY();

$widthCol1 = 120;
$widthCol2 = 60;

// Primera columna: tabla con datos
$fields = [
    'Fecha de Registro' => $affiliate->created_at,
    'Matrícula ICAP' => $affiliate->id,
    'Matrícula CONALAB' => $affiliate->enrollment_conalab,
    'Matrícula RPA' => $affiliate->enrollment_RPA,
];

foreach($fields as $title => $value){
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell($widthCol1,8,$title,1,0,'C',true);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell($widthCol2,8,$value,1,1,'L');
}

// Segunda columna: foto
if(file_exists($userPhoto)){
    $pdf->Image($userPhoto, $startX+$widthCol1+$widthCol2+5, $startY, 35, 35);
}

$pdf->Ln(40);

// ====== 1. Datos Personales ======
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'1. Datos Personales',0,1);
$pdf->Ln(2);

// Tabla Datos Personales
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(...$headerColor);

// Apellidos
$pdf->Cell(35,8,'Apellidos',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(155,8,$affiliate->user->last_name,1,1,'L');

// Nombres
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Nombres',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(155,8,$affiliate->user->name,1,1,'L');

// C.I, Fecha Nacimiento, Lugar
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'C.I',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,8,$affiliate->user->ci,1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Fecha de Nacimiento',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,8,$affiliate->user->birthdate,1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Lugar',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,8,$affiliate->place,1,1,'L');

// Sexo, Estado Civil, Deporte
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Sexo',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->user->gender,1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Estado Civil',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->user->martial_status,1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Deporte',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->sport,1,1,'L');

// Domicilio
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Domicilio',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,8,$affiliate->address_home,1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'No.',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,8,$affiliate->address_number_home,1,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Zona',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->zone_home,1,1,'L');

$pdf->Ln(5);

// ====== 2. Datos de Afiliado ======
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'2. Datos de Afiliado',0,1);
$pdf->Ln(2);

// Primera fila: Matrículas y Fecha de registro
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Fecha de Registro',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->created_at,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Matrícula ICAP',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->id,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Matrícula CONALAB',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->enrollment_conalab,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Matrícula RPA',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->enrollment_RPA,1,1,'L');

// Segunda fila: Sede, Ejercicio profesional, Institución
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'Sede',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,8,$affiliate->sede,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,8,'Ejercicio Profesional',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(60,8,$affiliate->profession.'-'.$affiliate->profession_status,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'Institución',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(60,8,$affiliate->institution,1,1,'L');

// Tercera fila: Domicilio procesal
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Domicilio Procesal',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,8,$affiliate->address_office,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'No.',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,8,$affiliate->address_number,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'Zona',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(60,8,$affiliate->zone,1,1,'L');

$pdf->Ln(5);

// ====== 3. Datos Profesionales ======
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'3. Datos Profesionales',0,1);
$pdf->Ln(2);

// Universidad
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,8,'Universidad que cursó sus estudios en Derecho',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130,8,$affiliate->university->name,1,1,'L');

// Entidad, Fecha Título, Número de Título
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Entidad',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,8,$affiliate->university->entity,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,8,'Fecha de extensión del Título',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,8,$affiliate->date,1,0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'Número de título',1,0,'C',true);
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,8,$affiliate->number,1,1,'L');

$pdf->Ln(5);

// ====== 4. Especializaciones ======
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'4. Especializaciones',0,1);
$pdf->Ln(2);

foreach($affiliate->professions as $profession){
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(35,8,'Especialización',1,0,'C',true);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(65,8,$profession->specialty->name,1,0,'L');

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,8,'Área',1,0,'C',true);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(65,8,$profession->area,1,1,'L');

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,8,'Fecha',1,0,'C',true);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(45,8,$profession->date,1,0,'L');

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,8,'Universidad',1,0,'C',true);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(70,8,$profession->university->name,1,1,'L');

    $pdf->Ln(2);
}

// ====== Firma ======
$pdf->Ln(10);
$pdf->Cell(0,5,'______________________________',0,1,'C');
$pdf->Cell(0,5,'FIRMA',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,'NOTA: POR FAVOR AL FIRMAR NO SOBREPASE LA LINEA',0,1,'C');

// ====== Salida ======
$pdf->Output('I', 'formulario_'.$affiliate->id.'.pdf'); */


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
                'demands:date,name,complainant,phone,created_at,status,description,id,affiliate_id'
            ])
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
        $recognition = Recognition::select('id', 'date', 'type', 'name', 'quantity')
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
