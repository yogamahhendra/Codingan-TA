<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PencarianTextController extends Controller
{
    public function searching(Request $request)
    {
        $resultkata = $cari = $jumlah = $sql = $hasilkata = $paginationkata = NULL;
        $kondisi = 0;
        if ($request->cari == 'cari') {
            $cari = true;
            $kondisi = 1;
            $sql = "SELECT * WHERE { {?bali a kbb:Andap} UNION {?bali a kbb:AlusSor} UNION {?bali a kbb:AlusSinggih} UNION {?bali a kbb:AlusMider} UNION {?bali a kbb:Kasar}";
            if ($request->cariText !== '') {
                $sql = $sql . "FILTER(REGEX(STR(?bali),'" . $request->cariText . "','i'))}";
            } else {
                $sql = $sql . "}";
            }
            $querydata = $this->sparql->query($sql);
            $resultkata = [];
            foreach ($querydata as $item) {
                $tingkatan = $this->parsedata($item->bali->getUri());
                if (pathinfo($tingkatan, PATHINFO_EXTENSION) == 'asi') {
                    $tingkatan = "Bahasa Bali Alus Singgih";
                } elseif (pathinfo($tingkatan, PATHINFO_EXTENSION) == 'asor') {
                    $tingkatan = "Bahasa Bali Alus Sor";
                } elseif (pathinfo($tingkatan, PATHINFO_EXTENSION) == 'ami') {
                    $tingkatan = "Bahasa Bali Alus Mider";
                } elseif (pathinfo($tingkatan, PATHINFO_EXTENSION) == 'andap') {
                    $tingkatan = "Bahasa Bali Andap";
                } elseif (pathinfo($tingkatan, PATHINFO_EXTENSION) == 'kasar') {
                    $tingkatan = "Bahasa Bali Kasar";
                }
                array_push($resultkata, [
                    'kata' => $this->parsedata($item->bali->getUri()),
                    'tingkatan' => $tingkatan
                ]);
            }
            $jumlah = count($resultkata);
            if ($jumlah == 0) {
                $listcarikata = [];
                $query2 = 'SELECT * WHERE {{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:AlusSor}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}}';
                $querydata2 = $this->sparql->query($query2);
                foreach ($querydata2 as $item) {
                    array_push($listcarikata, $this->parseData($item->kata->getUri()));
                }
                foreach ($listcarikata as $item) {
                    $item2 = pathinfo($item, PATHINFO_FILENAME);
                    $perbandingan = self::levenshteinAlgorithm($request->cariText, $item2);
                    if ($perbandingan === 1) {
                        $kata1 = $item;
                    } elseif ($perbandingan === 2) {
                        $kata2 = $item;
                    }
                }
                if(isset($kata1)){
                    $hasilkata = $kata1;
                    
                }
                elseif(isset($kata2)){
                    $hasilkata = $kata2;
                }
            }
            array_multisort(array_column($resultkata, 'kata'), SORT_ASC, $resultkata);
            $paginationkata = $this->paginate($resultkata)->withQueryString()->withPath('/pencariantext');
        }
        return view('pencariantext', [
            "title" => "Pencarian Text",
            "hasil" => $resultkata,
            "cari" => $cari,
            "kondisi" => $kondisi,
            "jumlah" => $jumlah,
            "query" => $sql,
            "hasilkata" => $hasilkata,
            "paginationkata" => $paginationkata
        ]);
    }

    public function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );
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

    
}
