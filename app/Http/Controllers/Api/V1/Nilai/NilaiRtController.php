<?php

namespace App\Http\Controllers\Api\v1\Nilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class NilaiRtController extends Controller
{
    /**
     * Summary of index
     *
     * *@description Method ini digunakan untuk mengambil nilai Realistic, Investigative, Artistic, Social, Enterprising, dan Conventional
     * dari materi uji dengan ID 7. Data diambil dari tabel nilai dan d
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //Perhitungan wajib menggunakan sql, penggunaan collection hanya diperbolehkan untuk melakukan pengolahan data terakhir (grouping)


        $rtMap = DB::table('nilai')
            ->select('pelajaran_id', 'nama_pelajaran')
            ->where('materi_uji_id', 7)
            ->where('nama_pelajaran', '!=', 'Pelajaran Khusus')
            ->whereIn('nama_pelajaran', [
                'REALISTIC',
                'INVESTIGATIVE',
                'ARTISTIC',
                'SOCIAL',
                'ENTERPRISING',
                'CONVENTIONAL'
            ])
            ->distinct()
            ->pluck('nama_pelajaran', 'pelajaran_id')
            ->toArray();


        $results = DB::select("
        SELECT
            nisn,
            nama,
            pelajaran_id,
            SUM(skor) as total_skor
        FROM nilai
        WHERE materi_uji_id = 7
        AND nama_pelajaran IN ('REALISTIC','INVESTIGATIVE','ARTISTIC','SOCIAL','ENTERPRISING','CONVENTIONAL')
        GROUP BY nisn, nama, pelajaran_id
    ");



        $grouped = collect($results)
            ->groupBy('nisn')
            ->map(function ($rows) use ($rtMap) {
                $first = $rows->first();
                $nilaiRt = [];
                foreach ($rtMap as $pid => $rtName) {
                    $nilaiRt[strtolower($rtName)] = (int) ($rows->firstWhere('pelajaran_id', $pid)->total_skor ?? 0);
                }
                return [
                    'nama' => $first->nama,
                    'nisn' => $first->nisn,
                    'nilaiRt' => $nilaiRt,
                ];
            })
            ->values();

        return response()->json($grouped);
    }
}
