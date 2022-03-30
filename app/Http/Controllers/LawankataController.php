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

        $resulttingkatan = [];
        $resulttingkatan2 = [];
        $resulttingkatan3 = [];

        $cari=NULL;
        $kondisi=0;
        $sql = NULL;
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
                if($jumlahdata == 0 ){
                    
                }
            }
        }

        $data = [
            "listtingkatan" => $tingkatan,
            "listtingkatan2" => $tingkatan2,
            "listtingkatan3" => $tingkatan3,
            "listkata" => $resultkata,
            "kondisi" => $kondisi,
            "jumlahdata" => $jumlahdata,
            "cari" => $cari
        ];
        return view('lawankata', [
            "title" => "Lawan Kata",
            "data" => $data,
        ]);
    }
}
