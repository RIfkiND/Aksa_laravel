<?php

namespace App\Http\Controllers\Api\V1\Division;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Resources\Division\DivisonCollection;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class DivisionsController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Division\DivisonCollection
     */
    public function index(Request $request)
    {
        // logic untuk mengambil daftar divisi
        // bisa termasuk filter berdasarkan nama

        $divisons = Division::latest()
                            ->filterByName($request->name)
                            ->paginate(10)->appends($request->query());

        return new DivisonCollection($divisons);
    }
}

