<?php

namespace Database\Seeders;

use App\Models\Deceased;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeceasedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
  [
    'affiliate_id' => '3',
    'date' => '2025-11-21',
    'description' => 'DEBE APORTES DESDE LA FECHA DE INSCRIPCION 
FALLECIO Y NO ESTA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '5',
    'date' => '2025-11-21',
    'description' => 'DEBE APORTES DESDE LA FECHA DE INSCRIPCION 
FALLECIO Y NO ESTA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '10',
    'date' => '2004-08-16',
    'description' => 'FALLECIO Y NO ESTA EN EL MAUSOLEO DEL ICAP, DEBE HASTA LA FECHA DE SU FALLECIMIENTO 1.260.-',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '12',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP, Y DEBE APORTES DESDE JUNIO 1999 HASTA LA FECHA DE SU FALLECIMIENTO ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '15',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, DEBE APORTES DESDE LA FECHA DE SU INSCRIPCION HASTA LA FECHA DE SU FALLECIMIENTO Y NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '16',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN ELMAUSOLEO Y DEBE APORTES DESDE LA FECHA DE SU INSCRIPCION HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '19',
    'date' => '2009-02-09',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y ES EXENTO DE APORTES MENSUALES DESDE MAYO DE 2002, NO TIENE CUENTAS PENDIENTES CON EL ICAP HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '20',
    'date' => '2025-11-21',
    'description' => 'FALLECIO Y NO ESTA EN EL MAUSOLEO DEL ICAP
Y DEBE APORTES DESDE LA FECHA DE INSCRIPCION',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '21',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP
Y DEBE APORTES DESDE LA FECHA DE INSCRIPCION DEBE HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '26',
    'date' => '2004-08-02',
    'description' => ' FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES DESDE ENERO 1997 A AGOSTO 2004 Bs 1.820.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '28',
    'date' => '2022-06-15',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y ES EXENTO DE APORTES DESDE AGOSTO 2008, NO TIENE CUENTAS PENDIENTES DE APORTES HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '31',
    'date' => '1998-10-11',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y TIENE CANCELADOS SUS APORTES HASTA SU FALLECIMIENTO Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '32',
    'date' => '2021-12-24',
    'description' => 'FELLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y ES EXCENTO DESDE OCTUBRE DE 2003 . NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '33',
    'date' => '2014-08-23',
    'description' => 'FELLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE DE APORTES DESDE SEPTIEMBRE 1997 A AGOSTO 2014 Bs 3.580.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '36',
    'date' => '2006-08-20',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAY Y DEBE DE APORTES  HASTA A LA FECHA DE SU FALLECIMIENTO Bs. 560.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '37',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP  Y DEBE APORTES DESDE LA FECHA DE INSCRIPCIONY DEBE HASTA LA FECHA DESU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '40',
    'date' => '2015-08-01',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE DE SUS APORTES DESDE OCTUBRE 2004  HASTA SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '48',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP DEBE APORTES DESDE LA FECHA DE INSCRIPCION, DEBE DE APORTES DESDE SU INSCRIPCION HASTA LA FECHA DE SU FALLECIMIENTIO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '52',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, DEBE HASTA LA FECHA DE SU FALLECIMIENTO Y NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '53',
    'date' => '1999-08-19',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS. 40.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '55',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, DEBE APORTES DESDE LA FECHA DE SU INSCRIPCION 
HASTALA FECHA DE SU FALLECIMIENTO Y NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '56',
    'date' => '1977-08-01',
    'description' => 'FALLECIO, NO SE
ENCUENTRA EN ELMAUSOLEO Y DEBE APORTES DESDE LA FECHA DE SU INSCRIPCION HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '58',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN ELMAUSOLEO Y DEBE APORTES DESDE LA FECHA DE SU INSCRIPCION HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '59',
    'date' => '2025-11-21',
    'description' => 'FALLECIO Y NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP. DEBE APORTES DESDE LA FECHA DE INSCRIPCION HASTA SU FALLECIMENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '60',
    'date' => '2025-11-21',
    'description' => 'FALLECIO Y NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP. NO  APORTO DESDE 
SU INSCRIPCION HASTA SU FALLECIMENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '68',
    'date' => '2021-12-25',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES, HASTA EXENCION DE APORTES OCTUBRE DE 2014 Bs. 720.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '70',
    'date' => '2020-07-25',
    'description' => 'FALLECIO, SE LE OTORGO EL MUSOLEO DEL ICAP Y TIENE CANCELADO TODOS SUS APORTES HASTA SU FALLECIMIENTO.
NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '72',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES DESDE LA FECHA DE INSCRIPCION HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '79',
    'date' => '2015-11-17',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES DESDE JUNIO 1999 HASTA SU FALLECIMIENTO NOVIEMBRE 2015 Bs 3.960.- Y EN EN MISMO NICHO SE ENCUENTRA SU ESPOSA AMELIA LAURA DE MONTOYA  fallecio el 23 de junio de 1999',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '84',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '87',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '88',
    'date' => '1990-11-30',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y APORTO HASTA EL DIA DE SU FALLECIMIENTO, NO TIENE CUENTAS PENDIENTES CON EL ICAP.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '90',
    'date' => '1993-07-01',
    'description' => 'FALLECIO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES DESDE LA FECHA DE INSCRIPCION HASTA SU FALLECIMIENTO Bs 1.660.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '93',
    'date' => '1998-08-01',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP Y CANCELO HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '94',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP, DEBE APORTES DESDE LA FECHA DE INSCRIPCION Y DEBE APORTES DESDE JULIO DE 1983 HASTA SU 
FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '95',
    'date' => '1995-09-05',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '96',
    'date' => '2007-01-01',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE DESDE MARZO DE 2005 HASTA LA FECHA DE SU FALLECIMIENTO Bs. 460.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '100',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP,  ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '101',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '103',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCIENTRA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '104',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP,',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '105',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '110',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '111',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP. ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '113',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '120',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '122',
    'date' => '2024-03-22',
    'description' => 'FALLECIO, SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y SE ENCUENTRA TODOS SUS APORTES CANCELADOS HASTA LA FECHA DE SU FALLECIMIENTO, NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '123',
    'date' => '2006-06-17',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP. Y NO TIENE CUENTAS PENDIENTES CON EL ICAP  HASTA LA FECHA DE SU FALLECIMIENTO.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '126',
    'date' => '1985-10-03',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP HASTA SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '129',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '130',
    'date' => '1982-07-30',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP Y TIENE LICENCIA DESDE MAYO 1982',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '131',
    'date' => '2025-11-21',
    'description' => 'FFALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP. Y TIENE SUS APORTES CANCELADOS HASTA 
DICIEMBRE 1997',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '133',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '135',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '137',
    'date' => '2006-09-27',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, TIENE CONDONACION DE APORTES  DE JUNIO 1982 HASTA JULIO DEL 2000, TIENE APORTES CANCELADOS HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '138',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '140',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '143',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '145',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '146',
    'date' => '1999-07-31',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO BS. 580.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '148',
    'date' => '1999-12-01',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '149',
    'date' => '1999-12-01',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '152',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '154',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '155',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '156',
    'date' => '2011-03-07',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO BS. 5600.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '157',
    'date' => '2019-07-27',
    'description' => 'SE ENCUENTRA EN EL MAUSOLEO DEL ICAP, Y TIENE LICENCIA DESDE
MAYO 2001 A MAYO 2002.DEBE DESDE JUNIO 2002 HASTA LA FECHA DE SU FALLECIMIENTO Bs. 4120.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '160',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '163',
    'date' => '2004-05-22',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO BS 1,000.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '164',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '166',
    'date' => '2022-07-18',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE DE APORTES HASTA LA FECHA DE SU FALLECIMIENTO Bs. 3.300',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '169',
    'date' => '1997-12-31',
    'description' => 'FALLECIO ESTA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '170',
    'date' => '2013-01-31',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS. 1220.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '174',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '175',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '178',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '179',
    'date' => '2001-03-05',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO Bs 480.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '180',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO ESTA EN EL
 MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '187',
    'date' => '2015-10-06',
    'description' => 'TIENE LICENCIA DESDE ENERO DE 2006, FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP. Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '192',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '196',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '198',
    'date' => '2007-12-31',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO BS 860.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '201',
    'date' => '2020-09-21',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, DEBE DE APORTES MENSUALES HASTA LA FECHA DE EMISIÓN FE SU RESOLUCION DE EXSENCION DE APORTES Bs. 2.260',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '203',
    'date' => '2019-02-07',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y NO TIENE DEUDAS CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '206',
    'date' => '2025-11-21',
    'description' => 'FALLECIO Y NO SE
 ENCUENTRA EN ELMAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '207',
    'date' => '2019-02-02',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO Bs 2400',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '214',
    'date' => '2002-10-01',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '227',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '239',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '273',
    'date' => '2003-02-15',
    'description' => ' FALLECIO, ESTA EN EL MASOLEO DEL ICAP, DEBE HASTA LA FECHA DE SU FALLECIMIENTO Bs 1.240.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '274',
    'date' => '2002-07-20',
    'description' => 'FALLECIO NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO Bs 820.-',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '289',
    'date' => '2006-04-04',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO BS 1.840.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '300',
    'date' => '2012-03-25',
    'description' => 'TIENE LICENCIA DESDE MAYO 2002 A MAYO 2003, FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES HASTA SU FALLECIMIENTO Bs. 2.160.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '311',
    'date' => '2025-11-21',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOELEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '315',
    'date' => '2010-03-23',
    'description' => 'FALLECIO. ESTA EN EL 
MAUSOLEO DEL ICAP Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO 1.400.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '318',
    'date' => '2025-11-21',
    'description' => 'FALLLECIO, NO SE ESCUENTRA EN EL MAUSOLEO DEL ICAP Y NO APORTO NADA DESDE SU INSCRIPCION HASTA
 LA FECHA DE SU FALLECIMIENTO.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '319',
    'date' => '2020-07-31',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, Y TIENE TODOS SUS APORTES CANCELADOS HASTA LA FECHA DE SU FALLECIMIENTO.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '361',
    'date' => '2012-03-05',
    'description' => 'FALLECIO, SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO 1040',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '369',
    'date' => '2021-01-16',
    'description' => 'FALLECIO, ESTA EN EL MASUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '372',
    'date' => '2001-03-01',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP Y DEBE  HASTA LA FECBHA DE SU FALLECIMIENTO Bs. 420',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '379',
    'date' => '2021-01-28',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP, Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '391',
    'date' => '2001-07-25',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, APORTO HASTA A FECHA DE SU FALLECIMIENTO Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '397',
    'date' => '2021-01-19',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '399',
    'date' => '2022-01-30',
    'description' => 'FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '408',
    'date' => '1998-01-01',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '480',
    'date' => '2022-04-08',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y SU HIJA INGRESO APLAN DE PAGOS DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO su Saldo es Bs 1.300.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '488',
    'date' => '2020-08-30',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, TIENE SUS APORTES CANCELADOS HASTA LA FECHA DE SU FALLECIMIENTO, Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '509',
    'date' => '2013-01-11',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP,  Y NO TIENE CUENTAS PENDIENTES HASTA LA FECHA DE SU FALLECIMIENTO.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '543',
    'date' => '2020-07-24',
    'description' => 'FALLECIO ESTA EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '638',
    'date' => '2007-01-30',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS 480.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '720',
    'date' => '2011-10-29',
    'description' => 'FALLECIO, SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '741',
    'date' => '2011-06-27',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, TIENE SUS
APORTES CANCELADOS HASTA LA FECHA DE SU FALLECIMIENTO, Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '777',
    'date' => '2020-08-27',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '793',
    'date' => '2018-05-14',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO DESDE ABRIL 2011 A MAYO 2018 BS. 1720.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '797',
    'date' => '2015-04-12',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '832',
    'date' => '2004-04-09',
    'description' => ' FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '839',
    'date' => '2024-04-29',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP, DEBE APORTES Bs. 5.240.- DE SEPTIEMBRE 2002 A ABRIL 2024',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '850',
    'date' => '2015-12-01',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP ',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '883',
    'date' => '2021-06-25',
    'description' => 'FALLECIO, ESTA EN EL
 MAUSOLEO ICAP, TIENE TODOS SUS APORTES CANCELADOS HASTA EL DIA DE SU FALLECIMIENTO Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '915',
    'date' => '2017-09-30',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '955',
    'date' => '2018-09-28',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '961',
    'date' => '2005-10-15',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO Bs. 240.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '965',
    'date' => '2020-07-24',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP ',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '968',
    'date' => '2015-10-08',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE DE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS 2180.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '980',
    'date' => '2017-02-22',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE DE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS 60.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1002',
    'date' => '2022-01-22',
    'description' => 'FALLECIO, ESTA EN EL 
MAUSOLEO ICAP, TIENE TODOS SUS APORTES CANCELADOS HASTA EL DIA DE SU FALLECIMIENTO Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1007',
    'date' => '2008-12-19',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO Bs. 1.440.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1019',
    'date' => '2008-07-16',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP ',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1039',
    'date' => '2024-01-19',
    'description' => 'FALLECIO, NO SE ENCUENTRA
 EN EL MAUSOLEO DEL ICAP Y DEBE APORTES DESDE MARZO 2003 HASTA LA FECHA DE SU FALLECIMIENTO. 5.030.-',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '1052',
    'date' => '2002-11-01',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP.',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '1154',
    'date' => '2021-11-22',
    'description' => 'FALLECIO , SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y TIENE SALDO PENDIENTE DE SUS APORTES Bs. 500.-, SE ENCUENTRA EN PLAN DE PAGOS',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1165',
    'date' => '2017-08-28',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE DEUDAS CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1226',
    'date' => '2021-01-01',
    'description' => 'FALLECIO,NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y TIENE CUENTAS PENDIENTES DE APORTES HASTA SU FALLECIMIENTO Bs. 3240 ESTABA EN EL MAUSOLEO DEL ICAP Y POR NO CANCELAR SU DEUDA SUS FMILIARES SE LO SACARON DEL MAUSOLEO DEL ICAP SIN NINGUNA AUTORIZACION DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '1252',
    'date' => '2021-08-11',
    'description' => 'FALLECIO, ESTA EN EL
MAUSOLEO DEL ICAP Y DEBE APORTES HASTA SU FALLECIMIENTO Bs 1.700.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1316',
    'date' => '2023-02-01',
    'description' => 'FALLECIO, SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y  NO TIENE CUENTAS PENDIENTES CON EL ICAP HASTA SU FALLECIMIENTO ',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1323',
    'date' => '2015-01-25',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO ICAP, TIENE TODOS SUS APORTES CANCELADOS HASTA EL DIA DE SU FALLECIMIENTO Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1337',
    'date' => '2019-07-27',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO ICAP, TIENE TODOS SUS APORTES CANCELADOS HASTA EL DIA DE SU FALLECIMIENTO Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1397',
    'date' => '2020-01-09',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO ICAP, TIENE CUENTAS PENDIENTES CON EL ICAP HASTA SU FALLECIMIENTO BS. 1140.- INGRESO A PLAN DE PAGOS SU ESPOSO Y NO ESTA CUMPLIENDO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1499',
    'date' => '2010-04-05',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO ICAP, NO CUENTA CON TODOS SUS APORTES CANCELADOS HASTA EL DIA DE SU FALLECIMIENTO Y  TIENE CUENTAS PENDIENTES CON EL ICAP BS. 880',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1563',
    'date' => '2007-06-26',
    'description' => 'FALLECIO,  ESTA EN EL
MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES HASTA SU  FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1580',
    'date' => '2023-07-18',
    'description' => 'FALLECIO, SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y SE ENCUENTRA  EN PLAN DE PAGOS POR CONCEPTO DE APORTES SU HERMANO ',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1587',
    'date' => '2015-04-02',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y  DEBE APORTES HASTA LA FECHA DE SU FALLEMICIEMTO BS, 220.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1638',
    'date' => '2007-03-20',
    'description' => 'FALLECIO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE APORTES DESDE LA FECHA DE INSCRIPCION HASTA SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1660',
    'date' => '2018-09-20',
    'description' => 'FALLECIO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP, Y NO TIENE CUENTAS PENDIENTES HASTA LA FECHA DE SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1726',
    'date' => '2020-08-02',
    'description' => 'FALLECIO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP, Y TIENE SUS APORTES ALDIA, NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1732',
    'date' => '2021-02-02',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y  DEBE APORTES HASTA LA FECHA DE SU FALLEMICIEMTO BS, 2960.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1750',
    'date' => '2013-03-05',
    'description' => 'FALLECIO, ESTA EN MAUSOLEO DEL ICAP, Y TIENE SUS APORTES ALDIA',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1752',
    'date' => '2012-06-14',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y TIENE SUS APORTES AL DIA.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1821',
    'date' => '2022-06-18',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE DE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS. 3540.-',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '1959',
    'date' => '2019-11-26',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOEO DEL ICAP Y DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO BS. 240.- ',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1960',
    'date' => '2023-10-29',
    'description' => 'FALLECIO, NO SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y NO APORTO AL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '1978',
    'date' => '2018-07-08',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO ICAP, DEBE APORTES HASTA LA FECHA DE SU FALLECIMIENTO  140 BS.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '1984',
    'date' => '2015-01-28',
    'description' => 'FALLECIO, SE ENCUENTRA EN EL MAUSOLEO DEL ICAP Y DEBE HASTA LA FECHA DE SU FALLECIMIENTO 1380',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '2024',
    'date' => '2024-05-17',
    'description' => 'Fallecio, se encuentra en el Mausoleo del ICAP, y no tiene cuentas pendientes hasta la fecha de su fallecimiento',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '2032',
    'date' => '2003-07-29',
    'description' => 'FALLECIO, ESTA EN EL MAUSOLEO DEL ICAP, TIENE SUS
APORTES CANCELADOS HASTA LA FECHA DE SU FALLECIMIENTO, Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '2035',
    'date' => '2021-07-01',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP DEBE DE APORTES BS 120.- HASTA SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '2214',
    'date' => '2020-04-04',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '2228',
    'date' => '2021-03-07',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y DEBE APORTES BS. 1.600.-',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '2253',
    'date' => '2020-08-28',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '702',
    'date' => '2024-06-09',
    'description' => 'Fallecio,se encuentra en el mausoleo 
del ICAP, y debe aportes hasta la fecha de su fallecimiento Bs. 1.760.- y su hijo Alvaro Gamboa ingreso en plan de pagos en junio 2024',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '913',
    'date' => '2024-06-11',
    'description' => 'Fallecio, se encuentra en el
mausoleo del ICAP, y no tiene cuentas pendientes hasta la fecha de su fallecimiento.',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '216',
    'date' => '2024-12-06',
    'description' => 'LICENCIA DESDE 
SEPTIEMBRE 2004, FALLECIO, NO ESTA EN EL MAUSOLEO DEL ICAP',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '556',
    'date' => '2024-11-09',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP DEBE DE APORTES BS 2.910.- HASTA SU FALLECIMIENTO',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '764',
    'date' => '2024-12-11',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '345',
    'date' => '2025-02-17',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y  TIENE CUENTAS PENDIENTES CON EL ICAP
Bs. 3230',
    'mausoleum' => 'si',
  ],
  [
    'affiliate_id' => '2085',
    'date' => '2025-04-28',
    'description' => 'FALLECIO, SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP Y NO TIENE CUENTAS PENDIENTES CON EL ICAP',
    'mausoleum' => 'SI',
  ],
  [
    'affiliate_id' => '734',
    'date' => '2025-07-08',
    'description' => 'FALLECIO, NO SE ENCUENTRA
EN EL MAUSOLEO DEL ICAP DEBE DE APORTES BS 5.550.- HASTA SU FALLECIMIENTO',
    'mausoleum' => 'NO',
  ],
  [
    'affiliate_id' => '539',
    'date' => '2025-07-25',
    'description' => 'SUS RESTOS SE ENCUENTRAN EN EL MAOSOLEO DEL I.C.A.P.A HASTA LA FECHA DE SU FALLECIMIENTO DEBIA Bs. 5950, CANCELO UNA CUOTA INIC. Bs. 4000, saldo pendiente Bs. 1950 el cual se comprometio a pagar cada mes Bs. 300 hasta terminar de cancelar toda su deuda.',
    'mausoleum' => 'SI',
  ],
];


Deceased::insert($data);
    }
}
