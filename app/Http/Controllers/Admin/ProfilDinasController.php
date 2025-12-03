<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDinasController extends Controller
{
    public function index()
    {
        $profil = ProfilDinas::first();
        return view('admin.profil-dinas', compact('profil'));
    }

    public function edit()
    {
        $profil = ProfilDinas::first();
        return view('admin.profil-dinas-edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_dinas' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'social_media_links' => 'nullable|array',
            'logo_tanpa_text' => 'nullable|image|max:2048',
            'logo_dengan_text' => 'nullable|image|max:2048',
        ]);

        $profil = ProfilDinas::first();
        if (!$profil) {
            $profil = new ProfilDinas();
        }

        $data = $request->except(['logo_tanpa_text', 'logo_dengan_text']);

        if ($request->hasFile('logo_tanpa_text')) {
            if ($profil->logo_tanpa_text) {
                Storage::disk('public')->delete($profil->logo_tanpa_text);
            }
            $data['logo_tanpa_text'] = $request->file('logo_tanpa_text')->store('logos', 'public');
        }

        if ($request->hasFile('logo_dengan_text')) {
            if ($profil->logo_dengan_text) {
                Storage::disk('public')->delete($profil->logo_dengan_text);
            }
            $data['logo_dengan_text'] = $request->file('logo_dengan_text')->store('logos', 'public');
        }

        $profil->fill($data);
        $profil->save();

        return redirect()->route('admin.profil-dinas')->with('success', 'Profil Dinas updated successfully.');
    }
}
