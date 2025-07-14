<?php

namespace App\Http\Controllers\Api\v1\Nilai;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NilaiStController extends Controller
{
    public function index()
    {
        $results = DB::select("
        SELECT
            nisn,
            nama,
            SUM(CASE WHEN pelajaran_id = 44 THEN skor * 41.67 ELSE 0 END) AS verbal,
            SUM(CASE WHEN pelajaran_id = 45 THEN skor * 29.67 ELSE 0 END) AS kuantitatif,
            SUM(CASE WHEN pelajaran_id = 46 THEN skor * 100 ELSE 0 END) AS penalaran,
            SUM(CASE WHEN pelajaran_id = 47 THEN skor * 23.81 ELSE 0 END) AS figural,
            (
                SUM(CASE WHEN pelajaran_id = 44 THEN skor * 41.67 ELSE 0 END) +
                SUM(CASE WHEN pelajaran_id = 45 THEN skor * 29.67 ELSE 0 END) +
                SUM(CASE WHEN pelajaran_id = 46 THEN skor * 100 ELSE 0 END) +
                SUM(CASE WHEN pelajaran_id = 47 THEN skor * 23.81 ELSE 0 END)
            ) AS total
        FROM nilai
        WHERE materi_uji_id = 4
        GROUP BY nisn, nama
        ORDER BY total DESC
    ");

        $output = collect($results)->map(function ($row) {
            return [
                'nama' => $row->nama,
                'nisn' => $row->nisn,
                'listNilai' => [
                    'verbal' => round($row->verbal, 2),
                    'kuantitatif' => round($row->kuantitatif, 2),
                    'penalaran' => round($row->penalaran, 2),
                    'figural' => round($row->figural, 2),
                ],
                'total' => round($row->total, 2),
            ];
        });

        return response()->json($output);
    }
}
