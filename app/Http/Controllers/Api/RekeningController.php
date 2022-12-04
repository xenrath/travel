<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function list()
    {
        $rekenings = Rekening::get();

        if ($rekenings) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil membuat Peminjaman',
                'rekenings' => $rekenings
            ]);
        } else {
            $this->error('Gagal membuat Peminjaman!');
        }
    }

    public function error($message)
    {
        return response()->json([
            'status' => FALSE,
            'message' => $message,
        ]);
    }
}
