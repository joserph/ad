<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;

    public static function getTypesPositions()
    {
        return [
            0 => __('Secretario General'),
            1 => __('Secretario de Organización'),
            2 => __('Sub-Secretario General'),
            3 => __('Sub-Secretario Organización'),
            4 => __('Secretario Político'),
            5 => __('Secretaría Administrativa'),
        ];
    }

    public static function getPositions()
    {
        return [
            0 => __('Secretaría Agraria'),
            1 => __('Secretaría Asuntos Municipales'),
            2 => __('Secretaría de Cultura'),
            3 => __('Secretaría de Educación'),
            4 => __('Secretaría Femenina'),
            5 => __('Secretaría Juvenil'),
            6 => __('Secretaría Sindical'),
            7 => __('Secretaría Profesionales y Tecnicos'),
        ];
    }

    public static function getBuro()
    {
        return [
            2 => __('Miembro principal'),
            3 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecAgraria()
    {
        return [
            0 => __('Secretario Agrario'),
            1 => __('Miembro principal'),
            2 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecAsuntosMunicipales()
    {
        return [
            3 => __('Secretario Asuntos Municipales'),
            4 => __('Miembro principal'),
            5 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecCultura()
    {
        return [
            6 => __('Secretario Cultura'),
            7 => __('Miembro principal'),
            8 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecEducacion()
    {
        return [
            9 => __('Secretario de Educación'),
            10 => __('Miembro principal'),
            11 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecFemenina()
    {
        return [
            12 => __('Secretaría Femenina'),
            13 => __('Miembro principal'),
            14 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecJuvenil()
    {
        return [
            15 => __('Sec. Juvenil'),
            16 => __('Sub. Secretario Juvenil'),
            17 => __('Sec. Org. Juvenil'),
            18 => __('Mujer Joven'),
            19 => __('Joven Trabajador'),
            20 => __('Joven Profesional'),
            21 => __('Joven Comunal'),
            22 => __('Joven Agrario'),
            23 => __('Sec. Educ. Media y Superior'),
            24 => __('Sec. Capacitación y Doctrina'),
            25 => __('Sec. Cultura'),
            26 => __('Sec. Medios y Activismo'),
            27 => __('Sec. Eventos Especiales'),
            28 => __('Sec. Diversidad Sexual'),
            29 => __('Sec. Político Juvenil'),
        ];
    }

    public static function getBuroSecSindical()
    {
        return [
            30 => __('Secretario Sindical'),
            31 => __('Miembro principal'),
            32 => __('Miembro suplente'),
        ];
    }

    public static function getBuroSecProfesionalesYTecnicos()
    {
        return [
            33 => __('Secretario Profesionales y Tecnicos'),
            34 => __('Miembro principal'),
            35 => __('Miembro suplente'),
        ];
    }
}
