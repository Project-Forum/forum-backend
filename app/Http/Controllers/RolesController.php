<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Database\QueryException;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::all();

        return response()->json([
            "roles"     => $roles,
            "message"   => "Daftar peran berhasil ditampilkan"
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = Roles::create($request->all());

            return response()->json([
                "roles"     => $role,
                "message"   => "Daftar peran berhasil ditambahkan"
            ], 200);
            
        } catch (QueryException $e) {
            // Tangani pengecualian (exception) yang terjadi saat mencoba menyimpan data
            return response()->json([
                "error"     => "Gagal menambahkan peran",
                "message"   => $e->getMessage() // Ini hanya contoh, Anda bisa menyusun pesan error sesuai kebutuhan
            ], 500); // Gunakan kode status HTTP 500 untuk kesalahan server
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Roles::findOrFail($id);
            $role->update($request->all());

            return response()->json([
                "roles"     => $role,
                "message"   => "Daftar peran berhasil diubah"
            ], 200);
            
        } catch (QueryException $e) {
    
            return response()->json([
                "error"     => "Daftar peran gagal diubah",
                "message"   => $e->getMessage() 
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {
            $role = Roles::findOrFail($id);
            $role->delete();
    
            return response()->json([
                "roles"     => $role,
                "message"   => "Daftar peran berhasil dihapus"
            ], 200);
            
        } catch (QueryException $e) {
            return response()->json([
                "error"     => "Daftar peran gagal dihapus",
                "message"   => $e->getMessage() 
            ], 500); 
        }
        
    }
}
