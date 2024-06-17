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

    public static function getBuroSecFemenina()
    {
        return [
            0 => __('Secretaría Femenina'),
        ];
    }

    public static function getBuroSecCultura()
    {
        return [
            1 => __('Secretario Cultura'),
        ];
    }
}
