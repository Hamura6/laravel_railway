<?php

namespace App\Http\Controllers;

use App\Exports\AffiliatesBySpecialityExcel;
use App\Exports\AgeAffiliateExport;
use App\Exports\ContributionExport;
use App\Exports\listAffiliatesExport;
use App\Exports\StatusAffiliatesExport;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{
    public function exportarAfiliadosExcel(Request $request)
    {
        $statusTotal = $request->input('statusTotal', []);

        return Excel::download(new StatusAffiliatesExport($statusTotal), 'reporte_afiliados_estado.xlsx');
    }
    public function exportAgeAffiliateToExcel($minor, $maximum, $status = '')
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
            ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE())'), [$minor, $maximum])
            ->groupBy('affiliates.id', 'users.name', 'users.last_name', 'users.email', 'users.gender', 'users.birthdate')
            ->orderBy('age', 'asc')
            ->get();

        $masculino = $affiliates->where('gender', 'Masculino')->count();
        $femenino = $affiliates->where('gender', 'Femenino')->count();

        return Excel::download(new AgeAffiliateExport($affiliates, $minor, $maximum, $status, $masculino, $femenino), 'reporte_afiliados_edad.xlsx');
    }
    public function listAffiliates($id)
    {
        return Excel::download(new listAffiliatesExport($id), 'reconocimiento_' . $id . '.xlsx');
    }
    public function exportarAffiliatesSpecialityExcel(Request $request)
    {
        $specialities = $request->input('specialities', []);

        return Excel::download(
            new AffiliatesBySpecialityExcel($specialities),
            'reporte_afiliados.xlsx'
        );
    }
    public function exportarContributionExcel($from, $to)
    {

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\ContributionExport($from, $to),
            'Reporte_Afiliados.xlsx'
        );
    }
    public function exportContributionAffiliateExcel($id, $from, $to){
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\ContributionAffiliateExport($id,$from, $to),
            'Reporte_cuotas_afiliados.xlsx'
        );
    }
    public function exportDeceasedExcel(){
         return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\DeceasedExport(),
            'Deceased_afiliados.xlsx'
        );
    }
}
