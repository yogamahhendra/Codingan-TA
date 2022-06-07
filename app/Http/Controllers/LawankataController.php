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
                    $listlawankata=array_unique($listlawankata);
                    $c=0;
                    foreach ($listlawankata as $item){
                        $listlawankata2[$c] = $item;
                        $c++;
                    }
                    $listlawankata=$listlawankata2;
                    $i=0;
                    foreach ($listlawankata as $item) {
                        $item2=pathinfo($item,PATHINFO_FILENAME);
                        $perbandingan=self::levenshteinAlgorithm($carilawan,$item2);
                        array_push($listdistance, self::levenshteinAlgorithm($carilawan,$item2));
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
                    if(isset($hasilkata)){
                        $resultlvn = self::lsdata(
                            $carilawan, // new string
                            pathinfo($hasilkata, PATHINFO_FILENAME), // old string
                        );
                    }
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
    public static function levenshteinAlgorithm(
        string $str2,
        string $str1,
        int $costIns = 1,
        int $costRep = 1,
        int $costDel = 1
    ) {
        $matrix = [];
        $str1Array = str_split($str1);
        $str2Array = str_split($str2);
        $str1Length = count($str1Array);
        $str2Length = count($str2Array);

        // string(Baris (kesamping) x kolom (atas bawah))
        // untuk baris
        for ($i = 1; $i <= $str1Length; $i++) {
            $matrix[$i][0] = $i * $costDel;
        }
        // untuk kolom
        for ($j = 0; $j <= $str2Length; $j++) {
            $matrix[0][$j] = $j * $costIns;
        }
        $status = [];
        $k = 0;
        $l = $m = $n = $o = 0;

        for ($i = 1; $i <= $str1Length; $i++) {
            for ($j = 1; $j <= $str2Length; $j++) {
                // Data Sama (Disalin)
                if ($str1Array[$i - 1] === $str2Array[$j - 1]) {
                    $matrix[$i][$j] = $matrix[$i - 1][$j - 1];
                    //copy
                }
                // Data berbeda +1 (insert,replace,delete)
                elseif ($str1Array[$i - 1] !== $str2Array[$j - 1]) {
                    $matrix[$i][$j] = min($matrix[$i - 1][$j] + $costIns, $matrix[$i][$j - 1] + $costDel, $matrix[$i - 1][$j - 1] + $costRep);
                }
            }
        }

        return $matrix[$str1Length][$str2Length];
    }

    public static function lsdata(
        string $str2,
        string $str1,
        int $costIns = 1,
        int $costRep = 1,
        int $costDel = 1
    ) {
        $matrix = [];
        $str1Array = str_split($str1);
        $str2Array = str_split($str2);
        $str1Length = count($str1Array);
        $str2Length = count($str2Array);

        // string(Baris (kesamping) x kolom (atas bawah))
        // untuk baris
        for ($i = 1; $i <= $str1Length; $i++) {
            $matrix[$i][0] = $i * $costDel;
        }
        // untuk kolom
        for ($j = 0; $j <= $str2Length; $j++) {
            $matrix[0][$j] = $j * $costIns;
        }
        $status = [];
        $k = 0;
        $l = $m = $n = $o = 0;

        for ($i = 1; $i <= $str1Length; $i++) {
            for ($j = 1; $j <= $str2Length; $j++) {
                // Data Sama (Disalin)
                if ($str1Array[$i - 1] === $str2Array[$j - 1]) {
                    $matrix[$i][$j] = $matrix[$i - 1][$j - 1];
                    //copy
                }
                // Data berbeda +1 (insert,replace,delete)
                elseif ($str1Array[$i - 1] !== $str2Array[$j - 1]) {
                    $matrix[$i][$j] = min($matrix[$i - 1][$j] + $costIns, $matrix[$i][$j - 1] + $costDel, $matrix[$i - 1][$j - 1] + $costRep);
                }
            }
        }
        $distance=$matrix[$str1Length][$str2Length];

        // Mengecek Jalur
        $i = $str1Length;
        $j = $str2Length;

        while ( $i >= 1) {
            while ( $j >= 1) {
                // Data Sama (Disalin)
                if ($str1Array[$i - 1] === $str2Array[$j - 1]) {
                    //copy
                    // echo "i = $i, j = $j <br>";
                    $status[$k][0] = $str2Array[$j - 1];
                    $status[$k][1] = "Copy";
                    $status[$k][2] = $str1Array[$i - 1];

                    // echo $str2Array [$j-1];
                    $i = $i - 1;
                    $j = $j - 1;
                    $k++;
                }
                // Data berbeda +1 (insert,replace,delete)
                elseif ($str1Array[$i - 1] !== $str2Array[$j - 1]) {
                    // remove
                    if ($matrix[$i - 1][$j] < $matrix[$i - 1][$j - 1] && $matrix[$i - 1][$j] < $matrix[$i][$j - 1]) {
                        // sebelah kanan
                        $status[$k][0] = " ";
                        $status[$k][1] = "Insert";
                        // sebelah kiri
                        $status[$k][2] = $str1Array[$i - 1];
                        $i = $i - 1;
                        $j = $j;
                        $k++;
                    }
                    // insert
                    elseif ($matrix[$i][$j - 1] < $matrix[$i - 1][$j] && $matrix[$i][$j - 1] < $matrix[$i - 1][$j - 1]) {
                        $status[$k][0] = $str2Array[$j - 1];
                        $status[$k][1] = "Delete";
                        $status[$k][2] = " ";
                        $i = $i;
                        $j = $j - 1;
                        $k++;
                    }
                    //replace
                    elseif ($matrix[$i - 1][$j - 1] < $matrix[$i][$j - 1] && $matrix[$i - 1][$j-1]<$matrix[$i-1][$j]) {
                        $status[$k][0] = $str2Array[$j - 1];
                        $status[$k][1] = "Replace";
                        $status[$k][2] = $str1Array[$i-1];
                        $i = $i - 1;
                        $j = $j - 1;
                        $k++;
                    }
                    else {
                        $status[$k][0] = $str2Array[$j - 1];
                        $status[$k][1] = "Replace";
                        $status[$k][2] = $str1Array[$i-1];
                        $i = $i - 1;
                        $j = $j - 1;
                        $k++;
                    }
                }
            }
        }

        // menampilkan matrix
        // for ($i = 0; $i <= $str1Length; $i++) {
        //     for ($j = 0; $j <= $str2Length; $j++) {
        //         if (isset($matrix[$i][$j])) {
        //             echo $matrix[$i][$j];
        //         }
        //     }
        //     echo "<br>";
        // }
        // dd($matrix, $status, $str1Length,$str1Length, $str1Array, $str2Array);

        $data2=[
            "distance" => $distance,
            "matrix" => $matrix,
            "status" => $status,
        ];

        return $data2;
    }
    
}
