<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // 2. Simpan ke Database
        Contact::create($request->all());

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        // Kita gunakan fragment #contact agar scroll otomatis turun ke form
        return redirect()->to(url()->previous() . '#contact')->with('success', 'Pesan Anda berhasil dikirim! Terima kasih.');
    }
}