<?php

use Illuminate\Support\Facades\Route;

// ======= [Pagrindinis sistemos puslapis.]==========
Route::get('/', function () {
    return view('dashboard');
});
// =================================================

// ======== [Kliento posistemis.]==========
// 1. Visu konferenciju atvaizdavimas.
// 2. Konkrecios konferencijos perziura.
// 3. Kliento registracija (patektos HTML formos apdorojimas).
// =================================================

// ======== [Darbuotojo posistemis.]================
// 1. Visų konferencijų atvaizdavimas;
// 2. Konkrecios konferencijos perziura;
// =================================================

// ======== [Sistemos administratoriaus posistemis.]==========
// 1. Pagrindinis puslapis su administratoriaus funkcionalumais;

// * [Sistemos naudotojų valdymas]
// 2. Visų sistemos naudotojų sąrašas;
// 3. Konkretaus naudotojo redagavimo formos atvaizdavimas;
// 4. Konkretaus naudotojo redagavimo formos duomenų apdorojimas;

// * [Konferencijų valdymas]
// 5. Puslapio, su konferencijų sąrašų, atvaizdavimas;
// 6. Konferencijų kūrimo formos atvaizdavimas;
// 7. Konferencijos kūrimo formos duomenų apdorojimas;
// 8. Konferencijos redagavimo formos atvaizdavimas;
// 9. Konferencijos redagavimo formos duomenų apdorojimas;
// 10. Konferencijos šalinimo operacijos apdorojimas.
// =================================================
