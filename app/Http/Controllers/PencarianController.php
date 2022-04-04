<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function searching(Request $request)
    {
        $tingkatan = array("AlusSor", "AlusSinggih", "AlusMider", "Andap", "Kasar");
        $tingkatan2 = array("Bahasa Bali Alus Sor", "Bahasa Bali Alus Singgih", "Bahasa Bali Alus Mider", "Bahasa Bali Andap", "Bahasa Bali Kasar");
        $bentuk = $this->sparql->query('SELECT * WHERE{?bentuk a kbb:BentukKata}');
        $kategori = $this->sparql->query('SELECT * WHERE{?kategori a kbb:KategoriKata}');
        $awalan = $this->sparql->query('SELECT * WHERE{?awalan a kbb:Awalan}');
        $sisipan = $this->sparql->query('SELECT * WHERE{?sisipan a kbb:Sisipan}');
        $akhiran = $this->sparql->query('SELECT * WHERE{?akhiran a kbb:Akhiran}');

        $resulttingkatan = [];
        $resulttingkatan2 = [];
        $resultbentuk = [];
        $resultkategori = [];
        $resultawalan = [];
        $resultsisipan = [];
        $resultakhiran = [];

        foreach ($tingkatan as $item) {
            array_push($resulttingkatan, [
                'tingkatan' => $item
            ]);
        }
        foreach ($tingkatan2 as $item) {
            array_push($resulttingkatan2, [
                'tingkatan2' => $item
            ]);
        }

        foreach ($bentuk as $item) {
            array_push($resultbentuk, [
                'bentuk' => $this->parseData($item->bentuk->getUri())
            ]);
        }

        foreach ($kategori as $item) {
            array_push($resultkategori, [
                'kategori' => $this->parseData($item->kategori->getUri())
            ]);
        }

        foreach ($awalan as $item) {
            array_push($resultawalan, [
                'awalan' => $this->parseData($item->awalan->getUri())
            ]);
        }

        foreach ($sisipan as $item) {
            array_push($resultsisipan, [
                'sisipan' => $this->parseData($item->sisipan->getUri())
            ]);
        }

        foreach ($akhiran as $item) {
            array_push($resultakhiran, [
                'akhiran' => $this->parseData($item->akhiran->getUri())
            ]);
        }
        $resultkata = [];
        $kondisi = 0;
        $sql=NULL;
        $jumlahdata=0;

        if ($request->cari == "cari") {
            $cari = true;
            $sql = 'SELECT * WHERE {
                ';
            if ($request->caribentuk === NULL && $request->caritingkatan === NULL && $request->carikategori === NULL && $request->cariawalan === NULL && $request->carisisipan === NULL && $request->cariakhiran === NULL) {
                $kondisi=0;
            } elseif ($request->caritingkatan === NULL) {
                $kondisi++;
                $sql = $sql . '{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:AlusSor}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}{';
                if ($request->caribentuk !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanBentukKata kbb:' . $request->caribentuk. '.';
                }
                if ($request->carikategori !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanKategoriKata kbb:' . $request->carikategori. '.';
                }
                if ($request->cariawalan !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanAwalan kbb:' . $request->cariawalan. '.';
                }
                if ($request->carisisipan !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanSisipan kbb:' . $request->carisisipan. '.';
                }
                if ($request->cariakhiran !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanAkhiran kbb:' . $request->cariakhiran. '.';
                }
                $sql = $sql. '}';
            }
            elseif ($request->caritingkatan !== NULL) {
                $kondisi++;
                $jumlahtingkatan=count($request->caritingkatan);
                if($jumlahtingkatan === 1){
                    $sql = $sql . '{?kata a kbb:'.$request->caritingkatan[0].'}{';
                    // $sql = $sql . '{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:Andap}{';
                } elseif ($jumlahtingkatan >= 2){
                    $sql = $sql . '{?kata a kbb:'.$request->caritingkatan[0].'}';
                    for ($i=1;$i<$jumlahtingkatan;$i++)
                    {
                        $sql = $sql.'UNION{?kata a kbb:'.$request->caritingkatan[$i].'}';
                    }
                    $sql = $sql . '{';
                }
                if ($request->caribentuk !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanBentukKata kbb:' . $request->caribentuk. '.';
                }
                if ($request->carikategori !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanKategoriKata kbb:' . $request->carikategori. '.';
                }
                if ($request->cariawalan !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanAwalan kbb:' . $request->cariawalan. '.';
                }
                if ($request->carisisipan !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanSisipan kbb:' . $request->carisisipan. '.';
                }
                if ($request->cariakhiran !== NULL) {
                    $sql = $sql . '?kata kbb:menggunakanAkhiran kbb:' . $request->cariakhiran. '.';
                }
                $sql = $sql. '}';
            }
            $sql = $sql . '}';
            $querydata = $this->sparql->query($sql);
            if ($kondisi > 0) {
                foreach ($querydata as $item) {
                    array_push($resultkata, [
                        'namakata' => $this->parseData($item->kata->getUri())
                    ]);
                }
               $jumlah = count($resultkata);

                for($i=0;$i<$jumlah;$i++)
                {
                    if(pathinfo($this->parseData($querydata[$i]->kata->getUri()), PATHINFO_EXTENSION) == 'asi')
                    {
                        $resultkata[$i]['tingkatankata']="Bahasa Bali Alus Singgih";
                    }
                    elseif(pathinfo($this->parseData($querydata[$i]->kata->getUri()), PATHINFO_EXTENSION) == 'asor')
                    {
                        $resultkata[$i]['tingkatankata']="Bahasa Bali Alus Sor";
                    }
                    elseif(pathinfo($this->parseData($querydata[$i]->kata->getUri()), PATHINFO_EXTENSION) == 'ami')
                    {
                        $resultkata[$i]['tingkatankata']="Bahasa Bali Alus Mider";
                    }
                    elseif(pathinfo($this->parseData($querydata[$i]->kata->getUri()), PATHINFO_EXTENSION) == 'andap')
                    {
                        $resultkata[$i]['tingkatankata']="Bahasa Bali Andap";
                    }
                    elseif(pathinfo($this->parseData($querydata[$i]->kata->getUri()), PATHINFO_EXTENSION) == 'kasar')
                    {
                        $resultkata[$i]['tingkatankata']="Bahasa Bali Kasar";
                    }
                    
                }

                $jumlahdata=(count($querydata));

            }
        } else if ($request->reset == "reset") {
            $cari = null;
            header("Location: /pencarian");
            $jumlahdata=NULL;
        } else {
            $cari = null;
        }

        $data = [
            "listtingkatan" => $resulttingkatan,
            "listtingkatan2" => $resulttingkatan2,
            "listbentuk" => $resultbentuk,
            "listkategori" => $resultkategori,
            "listawalan" => $resultawalan,
            "listsisipan" => $resultsisipan,
            "listakhiran" => $resultakhiran,
            "pencarian" => $resultkata,
            "cari" => $cari,
            "kondisi" => $kondisi,
            "query" => $sql,
            "jumlahdata" => $jumlahdata
        ];

        return view('pencarian', [
            "title" => "Pencarian",
            "data" => $data,
        ]);
    }
}
