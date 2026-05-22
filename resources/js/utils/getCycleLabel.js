// utils/getCycleLabel.js

import { ordinalNumbersNames as ordinalNames } from './ordinalNumbers.js';

/*
|--------------------------------------------------------------------------
| getCycleLabel
| Función para obtener la etiqueta de un ciclo en formato ordinal
|--------------------------------------------------------------------------
*/
export function getCycleLabel(data, meta) {

    if (data.deleted_at) {
        return '<span class="text-muted">Ciclo eliminado</span>';
    }

    const cycleNumber = data.cycle_number;

    return ordinalNames[cycleNumber]
        ? `${ordinalNames[cycleNumber]} ciclo`
        : `${cycleNumber}° Ciclo`;
}
