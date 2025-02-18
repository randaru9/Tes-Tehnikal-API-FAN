<?php

namespace App\Http\Controllers\Epresence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epresence\CreateEpresenceRequest;
use App\Models\Epresence;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateEpresenceController extends Controller
{
    public function action(CreateEpresenceRequest $request): JsonResponse
    {

        [
            'type' => $type,
            'waktu' => $waktu,
        ] = $request;
            

        $response = new Response(Response::CREATED, 'Buat Presensi Berhasil');

        $check = Epresence::where('id_users', auth(guard: 'api')->id())->where('type', $type)->whereDate('waktu', $waktu)->first();
            
        if ($check) {
            $response->set(Response::BAD_REQUEST, 'Anda sudah pernah absen ' . $type . ' pada tanggal ' . Carbon::parse($waktu)->toDateString());
            return $response->get();
        }

        DB::beginTransaction();

		try {
            $epresence = new Epresence([
                'id_users' => auth(guard: 'api')->id(),
                'type' => $type,
                'waktu' => $waktu
			]);

			$epresence->save();

			DB::commit();

		} catch (Exception $e) {
			DB::rollBack();
            $response->set(Response::INTERNAL_SERVER_ERROR, 'Buat Presensi Gagal', $e);
		}

        return $response->get();

    }
}
