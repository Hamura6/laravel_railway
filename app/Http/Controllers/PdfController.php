<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Recognition;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;
use App\Helpers\GlobalPdf;
use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;

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
        $pdf->Ln(40);
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
        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                /* $manager = new ImageManager(new Driver());
                $image = $manager->read($logoPath)->resize(50, 50);
                $institutionLogo = base64_encode($image->toJpeg()); */
                $institutionLogo = Image::read($logoPath)->resize(50, 50)->toJpeg();
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $logoPath = public_path('image/logo.png');
            $institutionLogo = Image::read($logoPath)->resize(50, 50)->toJpeg();
        }
        $institutionLogo = base64_encode($institutionLogo);
        $affiliate = Affiliate::with([
            'user:id,name,last_name,ci,email,gender,birthdate,status,photo,martial_status',
            'university:id,name,entity',
            'professions.specialty:id,name',
            'professions.university:id,name'
        ])->findOrFail($id);
        $disk = User::storageDisk();
        if (!empty($affiliate->user->photo) && $disk->exists($affiliate->user->photo)) {
    $logoPath = storage_path('app/disk-users/' . $affiliate->user->photo);

    if (file_exists($logoPath)) {
        $imageUser = Image::read($logoPath)->resize(70, 70)->toJpeg();
        $imageUser = "data:image/jpeg;base64," . base64_encode($imageUser);
    } else {
        $logoPath  = public_path('image/user.png');
        $imageUser = Image::read($logoPath)->resize(50, 50)->toJpeg();
        $imageUser = "data:image/jpeg;base64," . base64_encode($imageUser);
    }
} else {
    $logoPath  = public_path('image/user.png');
    $imageUser = Image::read($logoPath)->resize(50, 50)->toJpeg();
    $imageUser = "data:image/jpeg;base64," . base64_encode($imageUser);
}

        $html = view('pdf.form', compact('affiliate', 'institutionLogo', 'imageUser'))->render();

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

        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                /* $manager = new ImageManager(new Driver());
                $image = $manager->read($logoPath)->resize(50, 50);
                $institutionLogo = base64_encode($image->toJpeg()); */
                $institutionLogo = Image::read($logoPath)->resize(50, 50)->toJpeg();
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $logoPath = public_path('image/logo.png');
            $institutionLogo = Image::read($logoPath)->resize(50, 50)->toJpeg();
        }
        $institutionLogo = base64_encode($institutionLogo);
        // Obtener datos
        $affiliate = Affiliate::select('id', 'user_id', 'address_home', 'address_number_home', 'zone_home', 'address_office', 'address_number', 'zone')
            ->with([
                'user:id,name,last_name,ci,email',
                'user.phones:number,user_id',
                'demands:date,name,complainant,phone,created_at,status,description,id,affiliate_id'
            ])
            ->find($id);

        $data = ['affiliate' => $affiliate, 'institutionLogo' => $institutionLogo];

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

        $masculino = $affiliates->where('gender', 'Masculino')->count();
        $femenino = $affiliates->where('gender', 'Femenino')->count();
        $affiliates = $affiliates->map(fn($item) => (array) $item)->toArray();



        $html = view('pdf.affiliates', compact('affiliates', 'masculino', 'femenino'))->render();


        ini_set('pcre.backtrack_limit', 10000000);
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 11,
            'default_font' => 'sans',
            'use_kwt' => true,
        ]);


        $mpdf->WriteHTML($html);
        return response($mpdf->Output('reporte.pdf', 'I'))->header('Content-Type', 'application/pdf');
    }
    public function listAffiliate($id)
    {
        $logoPath = public_path('storage/institution/logo.png');
        if (file_exists($logoPath)) {
            try {
                /* $manager = new ImageManager(new Driver());
                $image = $manager->read($logoPath)->resize(50, 50);
                $institutionLogo = base64_encode($image->toJpeg()); */
                $institutionLogo = Image::read($logoPath)->resize(50, 50)->toJpeg();
            } catch (\Exception $e) {
                \Log::error('Error procesando el logo: ' . $e->getMessage());
            }
        } else {
            $logoPath = public_path('image/logo.png');
            $institutionLogo = Image::read($logoPath)->resize(50, 50)->toJpeg();
        }
        $institutionLogo = base64_encode($institutionLogo);
        $recognition = Recognition::select('id', 'date', 'type', 'name')
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


        $data = compact('recognition', 'institutionLogo');

        $html = view('pdf.listAffliate', $data)->render();


        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_left' => 10,
            'margin_right' => 10,
            'default_font_size' => 10,
            'default_font' => 'dejavusans',
        ]);


        $mpdf->WriteHTML($html);

        $fileName = 'reporte_' . $recognition->id . '.pdf';
        return $mpdf->Output($fileName, 'I');
    }
}
