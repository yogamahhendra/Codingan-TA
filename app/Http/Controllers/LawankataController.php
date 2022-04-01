<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LawankataController extends Controller
{
    public function lawankata(Request $request)
    {
        
        $tingkatan = array("AlusSor", "AlusSinggih", "AlusMider", "Andap", "Kasar");
        $tingkatan2 = array(".asor", ".asi", ".ami", ".andap", ".kasar");
        $tingkatan3 = array("Bahasa Bali Alus Sor", "Bahasa Bali Alus Singgih", "Bahasa Bali Alus Mider", "Bahasa Bali Andap", "Bahasa Bali Kasar");

        $hasilkata = $kata1 = $kata2 = $cari = $sql = $listdistance = $listlawankata = $carilawan =$resultlvn = NULL;
        $kondisi=0;
        $jumlahdata = 0;
        $resultkata=(array) NULL;
        if ($request->cari === "cari"){
            $cari = true;
            if($request->caritingkatan === NULL && $request->carilawan === NULL){
                $kondisi=0;
            }
            elseif ($request->caritingkatan=== NULL){
                $kondisi = 1;
                $carilawan = strtolower(str_replace(" ","",$request->carilawan));
                $sql = 'SELECT * WHERE {
                    {
                        {{?Kata a kbb:AlusSor}{ VALUES ?Kata { kbb:'.$carilawan.'.asor}.{?Kata kbb:memilikiLawanKata ?Lawan}.{?Lawan kbb:memilikiBahasaIndonesia ?Indo}}}
                    } UNION {
                        {{?Kata a kbb:AlusSinggih}{ VALUES ?Kata { kbb:'.$carilawan.'.asi}.{?Kata kbb:memilikiLawanKata ?Lawan}.{?Lawan kbb:memilikiBahasaIndonesia ?Indo}}}
                    } UNION {
                        {{?Kata a kbb:AlusMider}{ VALUES ?Kata { kbb:'.$carilawan.'.ami}.{?Kata kbb:memilikiLawanKata ?Lawan}.{?Lawan kbb:memilikiBahasaIndonesia ?Indo}}}
                    } UNION {
                        {{?Kata a kbb:Andap}{ VALUES ?Kata { kbb:'.$carilawan.'.andap}.{?Kata kbb:memilikiLawanKata ?Lawan}.{?Lawan kbb:memilikiBahasaIndonesia ?Indo}}}
                    } UNION {
                        {{?Kata a kbb:Kasar}{ VALUES ?Kata { kbb:'.$carilawan.'.kasar}.{?Kata kbb:memilikiLawanKata ?Lawan}.{?Lawan kbb:memilikiBahasaIndonesia ?Indo}}}
                    }

                  }';
                  $querydata = $this->sparql->query($sql);
            }
            if ($kondisi > 0) {
                foreach ($querydata as $item) {
                    array_push($resultkata, [
                        "namakata" => $this->parseData($item->Kata->getUri()),
                        "lawankata" => $this->parseData($item->Lawan->getUri()),
                        "terjemahankata" => $this->parseData($item->Indo->getUri())
                    ]);
                }
                $jumlahdata = count($resultkata);
                // Menampilkan Rekomendasi kata terdekat
                if($jumlahdata == 0 ){
                    $listlawankata=[];
                    $listdistance=[];
                    $query2 = 'SELECT * WHERE {{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:AlusSor}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}{?kata kbb:memilikiLawanKata ?lawan}}';
                    $querydata2 = $this->sparql->query($query2);
                    foreach ($querydata2 as $item) {
                        array_push($listlawankata, $this->parseData($item->kata->getUri()));
                    }
                    $i=0;
                    foreach ($listlawankata as $item) {
                        $perbandingan=levenshtein($carilawan,pathinfo($item,PATHINFO_FILENAME));
                        array_push($listdistance, levenshtein($carilawan,pathinfo($item,PATHINFO_FILENAME)));
                        if($perbandingan === 1){
                            $kata1=$item;
                        }
                        elseif($perbandingan === 2){
                            $kata2=$item;
                        }
                    }
                    $carilawan = strtolower(str_replace(" ","",$request->carilawan));

                    if($kata1 !== NULL){
                        $hasilkata = $kata1;
                        
                    }
                    elseif($kata2 !== NULL){
                        $hasilkata = $kata2;
                    }
                    $resultlvn = Controller::staticCalculate(
                        $carilawan, // new string
                        pathinfo($hasilkata, PATHINFO_FILENAME), // old string
                        true, // calculate edit progresses?
                        Controller::PROGRESS_OP_AS_STRING | Controller::PROGRESS_PATCH_MODE
                    );
                }
            }
        }

        $data = [
            "listtingkatan" => $tingkatan,
            "listtingkatan2" => $tingkatan2,
            "listtingkatan3" => $tingkatan3,
            "listdistance" => $listdistance,
            "listlawankata" => $listlawankata,
            "listkata" => $resultkata,
            "kondisi" => $kondisi,
            "jumlahdata" => $jumlahdata,
            "carilawan" => $carilawan,
            "cari" => $cari,
            "hasilkata" => $hasilkata,
            "resultlvn" => $resultlvn
        ];
        return view('lawankata', [
            "title" => "Lawan Kata",
            "data" => $data,
        ]);
    }

    // Levenshtein Algorithm
    
}
