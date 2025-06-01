<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    // GET /api/biodata
    public function index()
    {
        return Biodata::all();
        return response()->json(['message' => 'Biodata index']);
    
    }

    // POST /api/biodata
    public function store(Request $request)
    {
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $cleanedName = time() . '_' . preg_replace('/[^A-Za-z0-9.\-_]/', '_', $originalName);
            $path = $request->file('foto')->storeAs('documentations', $cleanedName, 'public');
            $data['foto'] = 'documentations/' . $cleanedName;
        }

        // Decode JSON fields if needed
        $jsonFields = [
            'link_tautan',
            'organizational_experience',
            'volunteer_experience',
            'education',
            'achievement'
        ];
        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = json_decode($data[$field], true);
            }
        }

        $biodata = Biodata::create($data);
        return response()->json($biodata, 201);
    }

    // GET /api/biodata/{id}
    public function show($id)
    {
        $biodata = Biodata::findOrFail($id);
        return response()->json($biodata);
    }

    // PUT /api/biodata/{id}
    public function update(Request $request, $id)
    {
        $biodata = Biodata::findOrFail($id);
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($biodata->foto && Storage::exists('public/' . $biodata->foto)) {
                Storage::delete('public/' . $biodata->foto);
            }
            $originalName = $request->file('foto')->getClientOriginalName();
            $cleanedName = time() . '_' . preg_replace('/[^A-Za-z0-9.\-_]/', '_', $originalName);
            $path = $request->file('foto')->storeAs('documentations', $cleanedName, 'public');
            $data['foto'] = 'documentations/' . $cleanedName;
        } else {
            // Jangan update foto jika tidak ada file baru
            unset($data['foto']);
        }

        // Decode JSON fields if needed
        $jsonFields = [
            'link_tautan',
            'organizational_experience',
            'volunteer_experience',
            'education',
            'achievement'
        ];
        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = json_decode($data[$field], true);
            }
        }

        $biodata->update($data);
        return response()->json($biodata);
    }

    // DELETE /api/biodata/{id}
    public function destroy($id)
    {
        $biodata = Biodata::findOrFail($id);
        // Hapus foto jika ada
        if ($biodata->foto && Storage::exists('public/' . $biodata->foto)) {
            Storage::delete('public/' . $biodata->foto);
        }
        $biodata->delete();
        return response()->json(['message' => 'Biodata deleted']);
    }
}
