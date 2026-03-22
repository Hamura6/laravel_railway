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
            ['guard_name' => 'web', 'name' => 'Crear usuarios', 'description' => 'Puede crear nuevos usuarios'],
            ['guard_name' => 'web', 'name' => 'Editar usuarios', 'description' => 'Puede editar la información de los usuarios'],
            ['guard_name' => 'web', 'name' => 'Eliminar usuarios', 'description' => 'Puede eliminar registros de usuarios'],
            ['guard_name' => 'web', 'name' => 'Ver usuarios', 'description' => 'Puede ver la lista y los detalles de usuarios'],
            ['guard_name' => 'web', 'name' => 'Restablecer usuarios.password', 'description' => 'Puede restablecer las contraseña de los usuarios'],
            ['guard_name' => 'web', 'name' => 'Bloquear usuarios', 'description' => 'Puede bloquear el acceso al sistema a los usuarios'],
            
            //permisos de roles
            ['guard_name' => 'web', 'name' => 'Ver roles', 'description' => 'Puede ver la lista y los detalles de roles'],
            ['guard_name' => 'web', 'name' => 'Editar roles', 'description' => 'Puede editar los datos de los roles'],
            ['guard_name' => 'web', 'name' => 'Eliminar roles', 'description' => 'Puede Eliminar roles existentes'],
            ['guard_name' => 'web', 'name' => 'Crear roles', 'description' => 'Puede crear nuevos roles'],
            
            //permisos
            ['guard_name' => 'web', 'name' => 'Asignación de permisos', 'description' => 'Puede controlar los permisos de cada tipo de usuarios'],
            
            //permissions affiliate
            ['guard_name' => 'web', 'name' => 'Ver afiliados', 'description' => 'Puede ver la lista y los detalles de afiliados'],
            ['guard_name' => 'web', 'name' => 'Editar afiliados', 'description' => 'Puede editar la información de los afiliados'],
            ['guard_name' => 'web', 'name' => 'Eliminar afiliados', 'description' => 'Puede eliminar registros de afiliados'],
            ['guard_name' => 'web', 'name' => 'Crear Afiliados', 'description' => 'Puede crear nuevos afiliados'],
            ['guard_name' => 'web', 'name' => 'Restablecer afiliados.password', 'description' => 'Puede restablecer las contraseñas de los afiliados'],
            ['guard_name' => 'web', 'name' => 'Bloquear afiliados', 'description' => 'Puede bloquear el acceso al sistema a los afiliados'],

            //permissions licenses
            ['guard_name' => 'web', 'name' => 'Ver licencias', 'description' => 'Puede ver la información de los afiliados con licencia'],
            ['guard_name' => 'web', 'name' => 'Eliminar licencias', 'description' => 'Puede eliminar las licencias existentes de los afiliados'],
            ['guard_name' => 'web', 'name' => 'Crear licencias', 'description' => 'Puede crear nuevas licencias para los afiliados'],

            //permissions deceaseds
            ['guard_name' => 'web', 'name' => 'Ver fallecidos', 'description' => 'Puede ver la información de los afiliados fallecidos'],
            ['guard_name' => 'web', 'name' => 'Eliminar fallecidos', 'description' => 'Puede eliminar los registro de los afiliados fallecidos'],
            ['guard_name' => 'web', 'name' => 'Crear fallecidos', 'description' => 'Puede agregar a los afiliados a la lista de fallecidos'],

            //permissions directories
            ['guard_name' => 'web', 'name' => 'Ver directorio', 'description' => 'Puede ver la lista del directorio'],
            ['guard_name' => 'web', 'name' => 'Eliminar directorio', 'description' => 'Puede eliminar los registros del directorio'],
            ['guard_name' => 'web', 'name' => 'Crear directorio', 'description' => 'Puede crear un nuevo cargo dentro del directorio'],
            ['guard_name' => 'web', 'name' => 'Editar directorio', 'description' => 'Puede editar los registros del directorio'],
            
            //permissions directories
            ['guard_name' => 'web', 'name' => 'Ver universidades', 'description' => 'Puede ver la información de las universidades'],
            ['guard_name' => 'web', 'name' => 'Eliminar universidades', 'description' => 'Puede eliminar registros de universidades'],
            ['guard_name' => 'web', 'name' => 'Crear universidades', 'description' => 'Puede agregar nuevas universidades'],
            ['guard_name' => 'web', 'name' => 'Editar universidades', 'description' => 'Puede editar los datos de las universidades'],
            
            //permissions directories
            ['guard_name' => 'web', 'name' => 'Ver especialidades', 'description' => 'Puede ver la información de las especialidades'],
            ['guard_name' => 'web', 'name' => 'Eliminar especialidades', 'description' => 'Puede eliminar especialidades existentes'],
            ['guard_name' => 'web', 'name' => 'Crear especialidades', 'description' => 'Puede agregar nuevas especialidades'],
            ['guard_name' => 'web', 'name' => 'Editar especialidades', 'description' => 'Puede editar la información de las especialidades'],



            //permissions payments
            ['guard_name' => 'web', 'name' => 'Ver pagos', 'description' => 'Puede ver el detalle de pagos y deuda de los affiliados'],
            ['guard_name' => 'web', 'name' => 'Realizar pago', 'description' => 'Puede registrar los pagos de aportes de los afiliados'],
            ['guard_name' => 'web', 'name' => 'Ver pagos realizados', 'description' => 'Puede puede registrar todo tipo de pagos del affiliado'],
            //permission procedures
            
            ['guard_name' => 'web', 'name' => 'Ver procedimientos', 'description' => 'Puede ver la información de los trámites'],
            ['guard_name' => 'web', 'name' => 'Crear procedimientos', 'description' => 'Puede registrar trámites que un afiliado solicite'],
            ['guard_name' => 'web', 'name' => 'Editar procedimientos', 'description' => 'Puede editar la información de los trámites'],
            ['guard_name' => 'web', 'name' => 'Eliminar procedimientos', 'description' => 'Puede eliminar trámites existentes'],



            //permission procedures
            ['guard_name' => 'web', 'name' => 'Ver tarifas', 'description' => 'Puede ver la información de las tarifas de cada trámite'],
            ['guard_name' => 'web', 'name' => 'Crear tarifas', 'description' => 'Puede agregar nuevas tarifas para un trámite'],
            ['guard_name' => 'web', 'name' => 'Editar tarifas', 'description' => 'Puede editar la información de las tarifas'],
            ['guard_name' => 'web', 'name' => 'Eliminar tarifas', 'description' => 'Puede eliminar tarifas que se no se encuentren en uso'],


             //permission procedures
            ['guard_name' => 'web', 'name' => 'Ver descuentos', 'description' => 'Puede ver la información de los descuentos aplicados'],
            ['guard_name' => 'web', 'name' => 'Crear descuentos', 'description' => 'Puede registrar nuevos descuentos a los tramites'],
            ['guard_name' => 'web', 'name' => 'Editar descuentos', 'description' => 'Puede editar la información de los descuentos'],
            ['guard_name' => 'web', 'name' => 'Eliminar descuentos', 'description' => 'Puede eliminar registros de los descuentos'],



             //permission procedures
            ['guard_name' => 'web', 'name' => 'ver reconocimientos', 'description' => 'Puede ver la información de las condecoraciones'],
            ['guard_name' => 'web', 'name' => 'Crear reconocimientos', 'description' => 'Puede registrar  nuevos eventos de reconocimiento'],
            ['guard_name' => 'web', 'name' => 'Editar reconocimientos', 'description' => 'Puede editar la informacion de los eventos de reconocimiento'],
            ['guard_name' => 'web', 'name' => 'Eliminar reconocimientos', 'description' => 'Puede eliminar registros de reconocimientos'],


            //permission demands
            ['guard_name' => 'web', 'name' => 'Ver denuncias', 'description' => 'Puede ver el historial de denuncias de los afiliados'],
            ['guard_name' => 'web', 'name' => 'Crear denuncias', 'description' => 'Puede agregar nuevas denuncias a un afiliado'],
            ['guard_name' => 'web', 'name' => 'Editar denuncias', 'description' => 'Puede editar el detalles de una denuncia'],
            ['guard_name' => 'web', 'name' => 'Eliminar denuncias', 'description' => 'Puede eliminar las denuncias de un afiliado'],


             //permission demands
            ['guard_name' => 'web', 'name' => 'Ver noticias', 'description' => 'Puede ver la información de las noticias y comunicados'],
            ['guard_name' => 'web', 'name' => 'Crear noticias', 'description' => 'Puede agregar nuevas noticias y comunicados al sitio web'],
            ['guard_name' => 'web', 'name' => 'Editar noticias', 'description' => 'Puede editar los datos de las noticias y comunicados'],
            ['guard_name' => 'web', 'name' => 'Eliminar noticias', 'description' => 'Puede eliminar noticias y comunicados que ya no son vigentes'],



             //permission demands
            ['guard_name' => 'web', 'name' => 'Ver cursos', 'description' => 'Puede ver la información de los cursos'],
            ['guard_name' => 'web', 'name' => 'Crear cursos', 'description' => 'Puede registrar nuevos cursos'],
            ['guard_name' => 'web', 'name' => 'Editar cursos', 'description' => 'Puede editar la datos de los cursos'],
            ['guard_name' => 'web', 'name' => 'Eliminar cursos', 'description' => 'Puede eliminar los registros de los cursos'],

            ['guard_name' => 'web', 'name' => 'Ver artículos', 'description' => 'Puede consultar los artículos publicados en el portal'],
            ['guard_name' => 'web', 'name' => 'Crear artículos', 'description' => 'Puede publicar nuevos artículos con contenido relevante'],
            ['guard_name' => 'web', 'name' => 'Editar artículos', 'description' => 'Puede actualizar y mejorar los artículos existentes'],
            ['guard_name' => 'web', 'name' => 'Eliminar artículos', 'description' => 'Puede eliminar artículos que ya no son vigentes'],
    


            ['guard_name' => 'web', 'name' => 'Ver convenios', 'description' => 'Puede revisar los convenios activos y pasados'],
            ['guard_name' => 'web', 'name' => 'Crear convenios', 'description' => 'Puede registrar nuevos convenios y acuerdos'],
            ['guard_name' => 'web', 'name' => 'Editar convenios', 'description' => 'Puede modificar información de convenios existentes'],
            ['guard_name' => 'web', 'name' => 'Eliminar convenios', 'description' => 'Puede eliminar convenios que ya no son válidos'],



            ['guard_name' => 'web', 'name' => 'Ver directorio actual de la organización', 'description' => 'Puede acceder a la información de la estructura del directorio'],
            ['guard_name' => 'web', 'name' => 'Asignar cargo en el directorio', 'description' => 'Puede asignar cargos a un afiliados'],



            ['guard_name' => 'web', 'name' => 'Ver eventos', 'description' => 'Puede visualizar todos los eventos registrados'],
            ['guard_name' => 'web', 'name' => 'Crear eventos', 'description' => 'Puede crear nuevos eventos y actividades'],
            ['guard_name' => 'web', 'name' => 'Editar eventos', 'description' => 'Puede modificar detalles y fechas de eventos existentes'],
            ['guard_name' => 'web', 'name' => 'Eliminar eventos', 'description' => 'Puede eliminar eventos que ya no son necesarios visualizarse'],


            ['guard_name' => 'web', 'name' => 'Ver reportes', 'description' => 'Puede ver información de los reportes'],
            ['guard_name' => 'web', 'name' => 'Configuración de la institución', 'description' => 'Puede realizar las configuraciones necesarias de la institución'],

            ['guard_name' => 'web', 'name' => 'Acceso al panel administrativo', 'description' => 'Puede ver información del panel administrativo'],
            
            
        ];
        Permission::insert($permissions);
    }
}
