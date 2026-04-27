 <style>
     .logo img {
         position: absolute;
         top: -40px;
         left: -20px;
     }

     .header h3 {
         position: relative;
         top: 20px;
         padding-bottom: 30px;
         font-weight: 300
     }

     .profile {
         position: relative;
     }

     .profile table {
         margin: 40px;
         border-collapse: collapse;
     }

     .profile img {
         position: absolute;
         top: -20px;
         right: 60px;

     }

     h2 {
         color: rgb(2, 27, 65);
         margin-top: 5px;
         font-size: 14px;
         font-weight: bold;
         text-transform: uppercase;
         border-bottom: 1px solid #000;
     }

     .table {
         width: 100%;
         border-collapse: collapse;
         table-layout: fixed;
         margin-top: 5px;
         margin-bottom: 10px;
     }

     th,
     td {
         font-size: 12px;
         border: 1px solid #444;
         padding: 3px 3px;
         vertical-align: top;
         text-align: left;
     }

     th {
         background-color: #f2f2f2;
         font-weight: bold;
     }

     tr:nth-child(even) td {
         background-color: #fafafa;
     }
     .bg-danger{
        background: rgb(255, 210, 210) !important;
     }
     .bg-success{
        background: rgb(219, 255, 219) !important;
        i
     }
 </style>
 <div class="logo">
     <img width="120" src="{{ public_path('assets/img/escudo.png') }}" alt="">

 </div>
 <div align="center" class="header">
     <h3>FORMULARIO DE INSCRIPCION</h3>

 </div>
 <table class="table">
     <tbody>
         <tr>
             <th class="">Nombre Completo:</th>
             <td class="">{{ $affiliate->user->full_name }} </td>
             <th class="">Matricula:</th>
             <td class="">{{ $affiliate->id }}</td>
             <th class="">C.I:</th>
             <td class="">{{ $affiliate->user->ci }}</td>
         </tr>
         <tr>
             <th class="">Telefonos:</th>
             <td class="">
                 @foreach ($affiliate->user->phones as $phone)
                     {{ $phone->number }}
                 @endforeach
             </td>
             <th class="">Correo electronico:</th>
             <td class="" colspan="3">{{ $affiliate->user->email }}
             </td>

         </tr>
         <tr>
             <th class=""> Direccion de domicilio:</th>
             <td class="" colspan="5">
                 {{ $affiliate->address_home . ' No ' . $affiliate->address_number_home . ' /' . $affiliate->zone_home }}
             </td>
         </tr>
         <tr>
             <th class=""> Direccion de domicilio procesal:</th>
             <td class="" colspan="5">
                 {{ $affiliate->address_office . ' No ' . $affiliate->address_number . ' /' . $affiliate->zone }}
             </td>
         </tr>
         <tr>
             <th class=""> total:</th>
             <td class="">
                 {{ $affiliate->payments->sum('amount') }} Bs.
             </td>
             <th class=""> Pagado:</th>
             <td class="">
                 {{ $affiliate->total }} Bs.
             </td>
             <th class=""> Deuda:</th>
             <td class="">
                 {{ $affiliate->debt }} Bs.
             </td>
         </tr>
         <tr>
             <th class=""> Fecha:</th>
             <td class="" colspan="5">
                 {{ $from->isoFormat('ddd, D \d\e MMM') . ' al ' . $to->isoFormat('ddd, D \d\e MMM \d\e\l Y') }}
             </td>
         </tr>
 </table>
 <table class="table">

     <thead class="bg-gray-100">
         <tr>
             <th class="">#</th>
             <th class="">Concepto</th>
             <th class="">Fecha</th>
             <th class="">Monto</th>
             <th class="">Deuda</th>
             <th class="">Estado</th>
         </tr>
     </thead>
     <tbody>
         @forelse ($affiliate->payments as $pay)
             <tr>
                 <td>
                     {{ $loop->iteration }}
                 </td>
                 <td >
                     {{ $pay->fee->name }}

                 </td>
                 <td >
                     {{ $pay->created_at->format('Y-m-d') }}

                 </td>
                 <td >
                     {{ $pay->amount }} Bs

                 </td>
                 <td >
                     {{ $pay->debt }} Bs

                 </td>
                 <td  class=" {{ $pay->status=='Pagado'?'bg-success':'bg-danger' }}">
                     {{ $pay->status }}

                 </td>
             </tr>
         @empty
         @endforelse

     </tbody>
 </table>
