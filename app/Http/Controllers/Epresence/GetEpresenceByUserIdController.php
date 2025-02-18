<?php

namespace App\Http\Controllers\Epresence;

use App\Http\Controllers\Controller;
use App\Models\Epresence;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use Illuminate\Support\Carbon;

class GetEpresenceByUserIdController extends Controller
{
    public function action(): JsonResponse
    {
        $epresence = Epresence::with('user')->where('id_users', auth(guard: 'api')->id())->orderBy('waktu', 'desc')->get();
        
        $grouped = $epresence->groupBy(function ($item) {
            return Carbon::parse($item->waktu)->toDateString();
        });

        $data = $grouped->map(function ($presences, $date) {
            
            $IN = $presences->where('type', 'IN')->first();
            $OUT = $presences->where('type', 'OUT')->first();

            return [
                "id_user" => $IN?->id_users ?? $OUT?->id_users,
                "nama_user" => $IN?->user->nama ?? $OUT?->user->nama,
                "tanggal" => $date,
                "waktu_masuk" => $IN ? Carbon::parse($IN->waktu)->format('H:i:s') : null,
                "waktu_pulang" => $OUT ? Carbon::parse($OUT->waktu)->format('H:i:s') : null,
                "status_masuk" => $IN ? ($IN->is_approve ? "APPROVE" : "REJECT") : null,
                "status_pulang" => $OUT ? ($OUT->is_approve ? "APPROVE" : "REJECT") : null,
            ];

        })->values();

        if($epresence->isEmpty()){
            return Response::SetAndGet(message: 'Anda belum pernah absen', data: []);
        }

        return Response::SetAndGet(message: 'Berhasil get data absen', data: $data);

    }
}
