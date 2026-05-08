<?php

namespace App\Services;

class OrdinalNamesService
{
    protected array $ordinalNumbers = [
        1 => 'primer',
        2 => 'segundo',
        3 => 'tercero',
        4 => 'cuarto',
        5 => 'quinto',
        6 => 'sexto',
        7 => 'séptimo',
        8 => 'octavo',
        9 => 'noveno',
        10 => 'décimo',
        11 => 'décimo primero',
        12 => 'décimo segundo',
        13 => 'décimo tercero',
        14 => 'décimo cuarto',
        15 => 'décimo quinto',
        16 => 'décimo sexto',
        17 => 'décimo séptimo',
        18 => 'décimo octavo',
        19 => 'décimo noveno',
        20 => 'vigésimo',
        21 => 'vigésimo primero',
        22 => 'vigésimo segundo',
        23 => 'vigésimo tercero',
        24 => 'vigésimo cuarto',
        25 => 'vigésimo quinto',
        26 => 'vigésimo sexto',
        27 => 'vigésimo séptimo',
        28 => 'vigésimo octavo',
        29 => 'vigésimo noveno',
        30 => 'trigésimo',
        31 => 'trigésimo primero',
        32 => 'trigésimo segundo',
        33 => 'trigésimo tercero',
        34 => 'trigésimo cuarto',
        35 => 'trigésimo quinto',
        36 => 'trigésimo sexto',
        37 => 'trigésimo séptimo',
        38 => 'trigésimo octavo',
        39 => 'trigésimo noveno',
        40 => 'cuadragésimo',
        41 => 'cuadragésimo primero',
        42 => 'cuadragésimo segundo',
        43 => 'cuadragésimo tercero',
        44 => 'cuadragésimo cuarto',
        45 => 'cuadragésimo quinto',
        46 => 'cuadragésimo sexto',
        47 => 'cuadragésimo séptimo',
        48 => 'cuadragésimo octavo',
        49 => 'cuadragésimo noveno',
        50 => 'quincuagésimo'
    ];

    public function getOrdinalName(int $number): ?string
    {
        return $this->ordinalNumbers[$number] ?? $number . '°';
    }
}
