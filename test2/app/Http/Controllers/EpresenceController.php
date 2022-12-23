<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpresenceStoreRequest;
use App\Http\Requests\EpresenceUpdateRequest;
use App\Http\Resources\EpresenceResource;
use App\Models\Epresence;
use App\Models\User;
use Illuminate\Http\Request;

class EpresenceController extends Controller
{

    /*
        Get data presences
        Keterangan:
        1. Menampilkan data absen users yang login

        endpoint : http://127.0.0.1:8000/api/epresences/store
        method : Get
    */

    public function index(Request $request, Epresence $epresence)
    {
        $user_epresences = $epresence->where('user_id', $request->user()->id)->where('type', 'in')->get();
        $new_epresences = [];

        foreach($user_epresences as $user_epresence){
            $user_epresence_out = $epresence->where('user_id', $request->user()->id)->whereDate('waktu', $user_epresence->waktu)->where('type', 'out')->first();
            array_push($new_epresences,[
                'id_user' => $user_epresence->user_id,
                'nama_user' => $user_epresence->user->name,
                'tanggal' => date('Y-m-d', strtotime($user_epresence->waktu)),
                'waktu_masuk' => date('H:i:s', strtotime($user_epresence->waktu)),
                'waktu_keluar' => date('H:i:s', strtotime($user_epresence_out->waktu)),
                'status_masuk' => $user_epresence->is_approve ? 'APPROVE' : 'REJECT',
                'status_pulang' => $user_epresence_out->is_approve ? 'APPROVE' : 'REJECT',
            ]);
        }

        return response()->json($new_epresences);
        
        return new EpresenceResource($new_epresences);
    }

    /*
        Insert data to presences
        Data akan masuk jika :
        1. User belum melakukan absen masuk hari ini.
        2. User belum melakukan absen keluar hari ini.
        3. User tidak bisa melakukan absen keluar sebelum absen masuk.

        endpoint : http://127.0.0.1:8000/api/epresences/store
        method : Post
        raw : {
            "type" : in atau out
            "waktu" : 2022-12-23 08:00:00
        }
    */

    public function store(EpresenceStoreRequest $request, Epresence $epresence)
    {
        $epresence_data = $epresence->where('user_id', $request->user()->id)
                                    ->where('type', $request->type)
                                    ->whereDate('waktu', date('Y-m-d'))
                                    ->first();

        if($epresence_data){
            return response()->json([
                'message' => "you've done absent {$request->type}",
            ]);
        }

        if($request->type == 'out'){
            if(!$epresence->where('user_id', $request->user()->id)->where('type', 'in')->whereDate('waktu', date('Y-m-d'))->first()){
                return response()->json([
                    'message' => "you haven't done a check-in yet",
                ]);
            }
        }

        $epresence->create($request->validated() + ['user_id' => $request->user()->id]);

        return response()->json([
            'message' => 'successfully recorded data', 
        ]);
    }

    /*
        Approve presence
        Data akan diupdate jika :
        1. User adalah Suvervisour
        2. User (Pengaju) dibawah Suvervisour

        endpoint : http://127.0.0.1:8000/api/epresences/approve/:epresence_id
        method : Post
        raw : {
            "is_approve" : true atau false
        }
    */

    public function approve(EpresenceUpdateRequest $request, Epresence $epresence, User $user)
    {
        $get_epresence = $epresence->where('id', $request->id)->firstOrFail();

        $user_epresence = $user->where('id', $get_epresence->user_id)->where('npp_supervisor', $request->user()->npp)->first();
        
        if(!$user_epresence || is_null($request->user()->npp_supervisor)){
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }
        
        $get_epresence->update($request->validated());

        return response()->json([
            'message' => 'successfully updated data',
        ]);
    }
}
