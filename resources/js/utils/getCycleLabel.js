// utils/getCycleLabel.js

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

    const visibleCycles = meta.settings.aoData
        .map(item => item._aData)
        .filter(item => !item.deleted_at);

    const cycleNumber = visibleCycles.findIndex(
        item => item.id === data.id
    ) + 1;

    return ordinalNames[cycleNumber]
        ? `${ordinalNames[cycleNumber]} ciclo`
        : `${cycleNumber}° Ciclo`;
}

const ordinalNames = {
    1: 'Primer',
    2: 'Segundo',
    3: 'Tercer',
    4: 'Cuarto',
    5: 'Quinto',
    6: 'Sexto',
    7: 'Séptimo',
    8: 'Octavo',
    9: 'Noveno',
    10: 'Décimo',
    11: 'Undécimo',
    12: 'Duodécimo',
    13: 'Decimotercer',
    14: 'Decimocuarto',
    15: 'Decimoquinto',
    16: 'Decimosexto',
    17: 'Decimoséptimo',
    18: 'Decimoctavo',
    19: 'Decimonoveno',
    20: 'Vigésimo'
};
