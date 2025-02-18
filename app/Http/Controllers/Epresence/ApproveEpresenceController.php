<?php

namespace App\Http\Controllers\Epresence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epresence\ApproveEpresenceRequest;
use App\Models\Epresence;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class ApproveEpresenceController extends Controller
{
    public function action(ApproveEpresenceRequest $request): JsonResponse
    {

        [
            'epresence_id' => $epresence_id,
        ] = $request;
            

        $response = new Response(Response::CREATED, 'Approve Presensi Berhasil');
        $epresence = Epresence::firstWhere('id', $epresence_id);
        $supervisor = User::firstWhere('id', auth(guard: 'api')->id());
        
        DB::beginTransaction();
        
        if($epresence->npp_supervisor == $supervisor->npp) {
            try {

                $epresence->is_approve = true;
                $epresence->save();
    
                DB::commit();
    
            } catch (Exception $e) {
                DB::rollBack();
                $response->set(Response::INTERNAL_SERVER_ERROR, 'Approve Presensi Gagal', $e);
            }    

        }else{
            $response->set(Response::UNAUTHORIZED, 'Anda bukan supervisor terkait',);
        }

        return $response->get();

    }
}
