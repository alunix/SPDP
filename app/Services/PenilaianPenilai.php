<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use SPDP\Services\KemajuanPermohonanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianPenilai
{
    
    public function create(Request $request,$permohonan)
    {   
        
        $role =auth()->user()->role;
        $user_id = auth()->user()->id;

        $penilaian = new Penilaian();
        $penilaian->dokumen_id= $permohonan->id;

        switch ($role) {
            case 'pjk':
            $penilaian->penilaian_pjk= $user_id;
            break;
            case 'jppa':
            $penilaian->penilaian_jppa=$user_id;
                break; 
            default:
                    return null;
                break;
        }
        $penilaian->save();

        return $penilaian;

    }
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function show(A $a)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function edit(A $a)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function uploadLaporanPenilai(Request $request,$id)
    {   
        
        // $laporan = new LaporanClass();
        // $laporan->createLaporan($request,$id);
        $attached= 'laporan_panel_penilai';

        $permohonan = Permohonan::find($id);
        $penilaian_id= $permohonan->penilaian->id;

        $penilaian= Penilaian::find($penilaian_id);
       // $laporan_id= Laporan::where('penilaian_id_laporan',$penilaian_id)->value('laporan_id');

       $lc= new LaporanClass();
       $lc->createLaporan($request,$penilaian,$attached);
        

        // $operator_id = Operator::where('user_id_operators', '=', $user_id)->value('operator_id');
 
             //Add laporan panel penilai to the penilaian table
 
            
             /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
             $penilaian = $permohonan->penilaian;
 
             /* Status semakan permohonan telah dikemaskini berdasarkan progress */
             $permohonan -> status_permohonan = 'Diluluskan oleh Panel Penilai(Laporan telah dikeluarkan dan akan dilampirkan oleh PJK)';
             $permohonan ->save();

             $kj= new KemajuanPermohonanClass();
             $kj->create($permohonan);

             $msg = [
                'message' => 'Lampiran berjaya dimuatnaik',
               ];  
            
            return redirect('/')->with($msg);
    }

   
    

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function destroy(A $a)
    {
        //
    }
}
