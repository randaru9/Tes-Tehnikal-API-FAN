<?php

namespace App\Http\Controllers\Epresence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epresence\CreateEpresenceRequest;
use App\Models\Epresence;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
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
