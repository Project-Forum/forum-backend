<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

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
        $role = Roles::create($request->all());

        return response()->json([
                "roles"     => $role,
                "message"   => "Daftar peran berhasil ditambahkan"
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Roles::findOrFail($id);
        $role->update($request->all());

        return response()->json(  [
            "roles"     => $role,
            "message"   => "Daftar peran berhasil diubah"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Roles::findOrFail($id);
        $role->delete();

        return response()->json(  [
            "roles"     => $role,
            "message"   => "Daftar peran berhasil dihapus"
        ], 200);
    }
}
