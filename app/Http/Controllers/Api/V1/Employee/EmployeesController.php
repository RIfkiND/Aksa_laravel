<?php

namespace App\Http\Controllers\Api\V1\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Employee\EmployeeCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class EmployeesController extends Controller implements HasMiddleware
{
    /**
     * Apply middleware to the controller.
     *
     * @return array
     */
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }


    /**
     * Logic untuk mengambil daftar pegawai
     * Bisa termasuk filter berdasarkan divisi dan nama
     * Menggunakan pagination untuk hasil yang lebih terstruktur
     *
     * @param Request $request
     * @return EmployeeCollection
     */
    public function index(Request $request)
    {
        $employees = Employee::with(['Divisions'])
            ->latest()
            ->filterByDivision($request->division_id)
            ->filterByName($request->name)
            ->paginate(10)
            ->appends($request->query());

        return new EmployeeCollection($employees);
    }


    /**
     * Logic untuk menyimpan pegawai baru
     * Validasi dan simpan data pegawai
     *
     * @param StoreEmployeeRequest $request
     * @return EmployeeResource
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->extension();
            $file->storeAs('uploads', $fileName, 'public');
            $employee->image = 'uploads/' . $fileName;
            $employee->save();
        }

        return (new EmployeeResource($employee))
            ->additional([
                'status' => 'success',
                'message' => 'Pegawai berhasil ditambahkan',
            ]);
    }

    /**
     * Logic untuk memperbarui data pegawai
     * Validasi dan update data pegawai
     *
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
        {
    $employee->update($request->validated());

    if ($request->hasFile('image')) {
        
        if ($employee->image && Storage::disk('public')->exists($employee->image)) {
            Storage::disk('public')->delete($employee->image);
        }
        $file = $request->file('image');
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('uploads', $fileName, 'public');
        $employee->image = 'uploads/' . $fileName;
        $employee->save();
    }

    return (new EmployeeResource($employee))
        ->additional([
            'status' => 'success',
            'message' => 'Pegawai berhasil diperbarui',
        ]);
    }

    /**
     * Logic untuk menghapus pegawai
     *
     * @param Employee $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Employee $employee)
    {

        if ($employee->image && Storage::exists($employee->image)) {
            Storage::delete($employee->image);
        }

        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pegawai berhasil dihapus',
        ]);
    }
}
