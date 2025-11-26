<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['guard_name' => 'web', 'name' => 'users.create', 'description' => 'Puede crear nuevos usuarios'],
            ['guard_name' => 'web', 'name' => 'users.edit', 'description' => 'Puede editar la información de los usuarios'],
            ['guard_name' => 'web', 'name' => 'users.delete', 'description' => 'Puede eliminar registros de usuarios'],
            ['guard_name' => 'web', 'name' => 'users.view', 'description' => 'Puede ver la lista y los detalles de usuarios'],
            ['guard_name' => 'web', 'name' => 'users.reset.password', 'description' => 'Puede restablecer las contraseña de los usuarios'],
            ['guard_name' => 'web', 'name' => 'users.block', 'description' => 'Puede bloquear el acceso al sistema a los usuarios'],
            
            //permisos de roles
            ['guard_name' => 'web', 'name' => 'roles.view', 'description' => 'Puede ver la lista y los detalles de roles'],
            ['guard_name' => 'web', 'name' => 'roles.edit', 'description' => 'Puede editar los datos de los roles'],
            ['guard_name' => 'web', 'name' => 'roles.delete', 'description' => 'Puede eliminar roles existentes'],
            ['guard_name' => 'web', 'name' => 'roles.create', 'description' => 'Puede crear nuevos roles'],
            
            //permisos
            ['guard_name' => 'web', 'name' => 'permissions.assign', 'description' => 'Puede controlar los permisos de cada tipo de usuarios'],
            
            //permissions affiliate
            ['guard_name' => 'web', 'name' => 'affiliates.view', 'description' => 'Puede ver la lista y los detalles de afiliados'],
            ['guard_name' => 'web', 'name' => 'affiliates.edit', 'description' => 'Puede editar la información de los afiliados'],
            ['guard_name' => 'web', 'name' => 'affiliates.delete', 'description' => 'Puede eliminar registros de afiliados'],
            ['guard_name' => 'web', 'name' => 'affiliates.create', 'description' => 'Puede crear nuevos afiliados'],
            ['guard_name' => 'web', 'name' => 'affiliates.reset.password', 'description' => 'Puede restablecer las contraseñas de los afiliados'],
            ['guard_name' => 'web', 'name' => 'affiliates.block', 'description' => 'Puede bloquear el acceso al sistema a los afiliados'],

            //permissions licenses
            ['guard_name' => 'web', 'name' => 'licenses.view', 'description' => 'Puede ver la información de los afiliados con licencia'],
            ['guard_name' => 'web', 'name' => 'licenses.delete', 'description' => 'Puede eliminar las licencias existentes de los afiliados'],
            ['guard_name' => 'web', 'name' => 'licenses.create', 'description' => 'Puede crear nuevas licencias para los afiliados'],

            //permissions deceaseds
            ['guard_name' => 'web', 'name' => 'deceaseds.view', 'description' => 'Puede ver la información de los afiliados fallecidos'],
            ['guard_name' => 'web', 'name' => 'deceaseds.delete', 'description' => 'Puede eliminar los registro de los afiliados fallecidos'],
            ['guard_name' => 'web', 'name' => 'deceaseds.create', 'description' => 'Puede agregar a los afiliados a la lista de fallecidos'],

            //permissions directories
            ['guard_name' => 'web', 'name' => 'directories.view', 'description' => 'Puede ver la lista del directorio'],
            ['guard_name' => 'web', 'name' => 'directories.delete', 'description' => 'Puede eliminar los registros del directorio'],
            ['guard_name' => 'web', 'name' => 'directories.create', 'description' => 'Puede crear un nuevo cargo dentro del directorio'],
            ['guard_name' => 'web', 'name' => 'directories.edit', 'description' => 'Puede editar los registros del directorio'],
            
            //permissions directories
            ['guard_name' => 'web', 'name' => 'universities.view', 'description' => 'Puede ver la información de las universidades'],
            ['guard_name' => 'web', 'name' => 'universities.delete', 'description' => 'Puede eliminar registros de universidades'],
            ['guard_name' => 'web', 'name' => 'universities.create', 'description' => 'Puede agregar nuevas universidades'],
            ['guard_name' => 'web', 'name' => 'universities.edit', 'description' => 'Puede editar los datos de las universidades'],
            
            //permissions directories
            ['guard_name' => 'web', 'name' => 'specialties.view', 'description' => 'Puede ver la información de las especialidades'],
            ['guard_name' => 'web', 'name' => 'specialties.delete', 'description' => 'Puede eliminar especialidades existentes'],
            ['guard_name' => 'web', 'name' => 'specialties.create', 'description' => 'Puede agregar nuevas especialidades'],
            ['guard_name' => 'web', 'name' => 'specialties.edit', 'description' => 'Puede editar la información de las especialidades'],



            //permissions payments
            ['guard_name' => 'web', 'name' => 'payments.view', 'description' => 'Puede ver el detalle de pagos y deuda de los affiliados'],
            ['guard_name' => 'web', 'name' => 'payments.pay', 'description' => 'Puede registrar los pagos de aportes de los afiliados'],
            ['guard_name' => 'web', 'name' => 'payments.pays', 'description' => 'Puede puede registrar todo tipo de pagos del affiliado'],
            //permission procedures
            
            ['guard_name' => 'web', 'name' => 'procedures.view', 'description' => 'Puede ver la información de los trámites'],
            ['guard_name' => 'web', 'name' => 'procedures.create', 'description' => 'Puede registrar trámites que un afiliado solicite'],
            ['guard_name' => 'web', 'name' => 'procedures.edit', 'description' => 'Puede editar la información de los trámites'],
            ['guard_name' => 'web', 'name' => 'procedures.delete', 'description' => 'Puede eliminar trámites existentes'],



            //permission procedures
            ['guard_name' => 'web', 'name' => 'fees.view', 'description' => 'Puede ver la información de las tarifas de cada trámite'],
            ['guard_name' => 'web', 'name' => 'fees.create', 'description' => 'Puede agregar nuevas tarifas para un trámite'],
            ['guard_name' => 'web', 'name' => 'fees.edit', 'description' => 'Puede editar la información de las tarifas'],
            ['guard_name' => 'web', 'name' => 'fees.delete', 'description' => 'Puede eliminar tarifas que se no se encuentren en uso'],


             //permission procedures
            ['guard_name' => 'web', 'name' => 'discount.view', 'description' => 'Puede ver la información de los descuentos aplicados'],
            ['guard_name' => 'web', 'name' => 'discount.create', 'description' => 'Puede registrar nuevos descuentos a los tramites'],
            ['guard_name' => 'web', 'name' => 'discount.edit', 'description' => 'Puede editar la información de los descuentos'],
            ['guard_name' => 'web', 'name' => 'discount.delete', 'description' => 'Puede eliminar registros de los descuentos'],



             //permission procedures
            ['guard_name' => 'web', 'name' => 'recognitions.view', 'description' => 'Puede ver la información de las condecoraciones'],
            ['guard_name' => 'web', 'name' => 'recognitions.create', 'description' => 'Puede registrar  nuevos eventos de reconocimiento'],
            ['guard_name' => 'web', 'name' => 'recognitions.edit', 'description' => 'Puede editar la informacion de los eventos de reconocimiento'],
            ['guard_name' => 'web', 'name' => 'recognitions.delete', 'description' => 'Puede eliminar registros de reconocimientos'],


            //permission demands
            ['guard_name' => 'web', 'name' => 'demands.view', 'description' => 'Puede ver el historial de denuncias de los afiliados'],
            ['guard_name' => 'web', 'name' => 'demands.create', 'description' => 'Puede agregar nuevas denuncias a un afiliado'],
            ['guard_name' => 'web', 'name' => 'demands.edit', 'description' => 'Puede editar el detalles de una denuncia'],
            ['guard_name' => 'web', 'name' => 'demands.delete', 'description' => 'Puede eliminar las denuncias de un afiliado'],


             //permission demands
            ['guard_name' => 'web', 'name' => 'notice.view', 'description' => 'Puede ver la información de las noticias y comunicados'],
            ['guard_name' => 'web', 'name' => 'notice.create', 'description' => 'Puede agregar nuevas noticias y comunicados al sitio web'],
            ['guard_name' => 'web', 'name' => 'notice.edit', 'description' => 'Puede editar los datos de las noticias y comunicados'],
            ['guard_name' => 'web', 'name' => 'notice.delete', 'description' => 'Puede eliminar noticias y comunicados que ya no son vigentes'],



             //permission demands
            ['guard_name' => 'web', 'name' => 'courses.view', 'description' => 'Puede ver la información de los cursos'],
            ['guard_name' => 'web', 'name' => 'courses.create', 'description' => 'Puede registrar nuevos cursos'],
            ['guard_name' => 'web', 'name' => 'courses.edit', 'description' => 'Puede editar la datos de los cursos'],
            ['guard_name' => 'web', 'name' => 'courses.delete', 'description' => 'Puede eliminar los registros de los cursos'],

            ['guard_name' => 'web', 'name' => 'articles.view', 'description' => 'Puede consultar los artículos publicados en el portal'],
            ['guard_name' => 'web', 'name' => 'articles.create', 'description' => 'Puede publicar nuevos artículos con contenido relevante'],
            ['guard_name' => 'web', 'name' => 'articles.edit', 'description' => 'Puede actualizar y mejorar los artículos existentes'],
            ['guard_name' => 'web', 'name' => 'articles.delete', 'description' => 'Puede eliminar artículos que ya no son vigentes'],
    


            ['guard_name' => 'web', 'name' => 'agreements.view', 'description' => 'Puede revisar los convenios activos y pasados'],
            ['guard_name' => 'web', 'name' => 'agreements.create', 'description' => 'Puede registrar nuevos convenios y acuerdos'],
            ['guard_name' => 'web', 'name' => 'agreements.edit', 'description' => 'Puede modificar información de convenios existentes'],
            ['guard_name' => 'web', 'name' => 'agreements.delete', 'description' => 'Puede eliminar convenios que ya no son válidos'],



            ['guard_name' => 'web', 'name' => 'directories.view.organization', 'description' => 'Puede acceder a la información de la estructura del directorio'],
            ['guard_name' => 'web', 'name' => 'directories.assign', 'description' => 'Puede asignar cargos a un afiliados'],



            ['guard_name' => 'web', 'name' => 'events.view', 'description' => 'Puede visualizar todos los eventos registrados'],
            ['guard_name' => 'web', 'name' => 'events.create', 'description' => 'Puede crear nuevos eventos y actividades'],
            ['guard_name' => 'web', 'name' => 'events.edit', 'description' => 'Puede modificar detalles y fechas de eventos existentes'],
            ['guard_name' => 'web', 'name' => 'events.delete', 'description' => 'Puede eliminar eventos que ya no son necesarios visualizarse'],


            ['guard_name' => 'web', 'name' => 'reports', 'description' => 'Puede ver información de los reportes'],
            ['guard_name' => 'web', 'name' => 'configuration', 'description' => 'Puede realizar las configuraciones necesarias de la institución'],

            ['guard_name' => 'web', 'name' => 'manager', 'description' => 'Puede ver información del panel administrativo'],
            
            
        ];
        Permission::insert($permissions);
    }
}
