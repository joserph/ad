<?php

namespace App\Exports;

use App\Models\Members;
use App\Models\Positions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MemberNacionalExport implements WithHeadingRow, WithStyles, WithMapping, WithHeadings, FromQuery
{
    public function headings(): array
    {
        return [
            'CEDULA',
            'NOMBRE',
            'APELLIDO',
            'TEFEFONO',
            'CORREO',
            'FECHA DE NACIMIENTO',
            'PROFESION',
            'RED SOCIAL',
            'USUARIO RED',
            'GENERO',
            'ALCANCE',
            'TIPO CARGO',
            'CARGO',
            'BURO',
            'CARGO'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('A1:B1')->getFont()->setBold(true);
        $sheet->getStyle('A1:O1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'], 'font' => ['bold' => true, 'italic' => true, 'size' => 16]]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Members::select('id', 'cedula')->get();
    // }
    /**
    * @param Members $member
    */
    public function query()
    {
        return Members::query()->where('alcance', 'Nacional');
    }
    
    public function map($member): array
    {
        $tipo_cargo = Positions::getTypesPositions();
        $cargo = Positions::getPositions();
        $buro = Positions::getBuro();
        // dd($tipo_cargo[0]);
        return [
            $member->cedula,
            $member->nombre,
            $member->apellido,
            $member->telefono,
            $member->correo,
            $member->fecha_nacimiento,
            $member->profesion,
            $member->red_social,
            $member->usuario_red,
            $member->genero,
            $member->alcance,
            $tipo_cargo[$member->tipo_cargo],
            $member->cargo ? $cargo[$member->cargo]: '-',
            $member->buro ? $buro[$member->buro]: '-',
            $member->cargo_pub
        ];
    }
}
