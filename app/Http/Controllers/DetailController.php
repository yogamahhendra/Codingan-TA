<?php

namespace App\Http\Controllers;


class DetailController extends Controller
{
    public function detail($katabali)
    {
        $detail = $this->sparql->query('SELECT * WHERE
        {VALUES ?Kata{kbb:' . $katabali . '}.
            OPTIONAL {?Kata kbb:memilikiBahasaIndonesia ?Indonesia.}.
            OPTIONAL {?Kata kbb:memilikiBahasaBaliAlusMider ?Mider.}.
            OPTIONAL {?Kata kbb:memilikiBahasaBaliAlusSor ?Sor.}.
            OPTIONAL {?Kata kbb:memilikiBahasaBaliAlusSinggih ?Singgih.}.
            OPTIONAL {?Kata kbb:memilikiBahasaBaliAndap ?Andap.}.
            OPTIONAL {?Kata kbb:memilikiBahasaBaliKasar ?Kasar.}.
            OPTIONAL {?Kata kbb:memilikiDialekBuleleng ?Buleleng.}.
            OPTIONAL {?Kata kbb:memilikiKataDasar ?Dasar.}.
            OPTIONAL {?Kata kbb:memilikiKataTurunan ?Turunan.}.
            OPTIONAL {?Kata kbb:memilikiLawanKata ?Lawan.}.
            OPTIONAL {?Kata kbb:menggunakanBentukKata ?Bentuk.}.
            OPTIONAL {?Kata kbb:menggunakanKategoriKata ?Kategori.}.
            OPTIONAL {?Kata kbb:menggunakanAwalan ?Awalan.}.
            OPTIONAL {?Kata kbb:menggunakanSisipan ?Sisipan.}.
            OPTIONAL {?Kata kbb:menggunakanAkhiran ?Akhiran.}.
            OPTIONAL {?Kata kbb:memilikiAksaraBali ?Aksara.}.
            OPTIONAL {?Kata kbb:memilikiContohKalimat ?Kalimat.}.
        }');
        // dd($detail['0']->Mider->getUri());

        // if(isset($detail['0']->Mider))
        // {
        //     echo "variabel dibuat";
        // 
        // coba ambil data
        // $detail[0]->Indonesia = "ss";
        $default = "http://www.dpch.oss.web.id/Bali/BalineseLanguange.owl#-";
        
        // memberi variable default jika data kosong
        foreach ($detail as $dtl) {
            if (isset($dtl->Indonesia) === false) {
                $dtl->Indonesia = $default;
            }
            if (isset($dtl->Mider) === false) {
                $dtl->Mider = $default;
            }
            if (isset($dtl->Sor) === false) {
                $dtl->Sor = $default;
            }
            if (isset($dtl->Singgih) === false) {
                $dtl->Singgih = $default;
            }
            if (isset($dtl->Andap) === false) {
                $dtl->Andap = $default;
            }
            if (isset($dtl->Kasar) === false) {
                $dtl->Kasar = $default;
            }
            if (isset($dtl->Buleleng) === false) {
                $dtl->Buleleng = $default;
            }
            if (isset($dtl->Aksara) === false) {
                $dtl->Aksara = $default;
            }
            if (isset($dtl->Dasar) === false) {
                $dtl->Dasar = $default;
            }
            if (isset($dtl->Turunan) === false) {
                $dtl->Turunan = $default;
            }
            if (isset($dtl->Lawan) === false) {
                $dtl->Lawan = $default;
            }
            if (isset($dtl->Bentuk) === false) {
                $dtl->Bentuk = $default;
            }
            if (isset($dtl->Kategori) === false) {
                $dtl->Kategori = $default;
            }
            if (isset($dtl->Awalan) === false) {
                $dtl->Awalan = $default;
            }
            if (isset($dtl->Sisipan) === false) {
                $dtl->Sisipan = $default;
            }
            if (isset($dtl->Akhiran) === false) {
                $dtl->Akhiran = $default;
            }
            if (isset($dtl->Kalimat) === false) {
                $dtl->Kalimat = $default;
            }
        }
        $result = [];
        foreach ($detail as $dtl) {
            array_push($result, [
                'ext' => pathinfo($dtl->Kata, PATHINFO_EXTENSION),
                'katautama' => $this->parseData($dtl->Kata),
                'indonesia' => $this->parseData($dtl->Indonesia),
                'mider' => $this->parseData($dtl->Mider),
                'sor' => $this->parseData($dtl->Sor),
                'singgih' => $this->parseData($dtl->Singgih),
                'andap' => $this->parseData($dtl->Andap),
                'kasar' => $this->parseData($dtl->Kasar),
                'buleleng' => $this->parseData($dtl->Buleleng),
                'aksara' => $this->parseData($dtl->Aksara),
                'dasar' => $this->parseData($dtl->Dasar),
                'turunan' => $this->parseData($dtl->Turunan),
                'lawan' => $this->parseData($dtl->Lawan),
                'bentuk' => $this->parseData($dtl->Bentuk),
                'kategori' => $this->parseData($dtl->Kategori),
                'awalan' => $this->parseData($dtl->Awalan),
                'sisipan' => $this->parseData($dtl->Sisipan),
                'akhiran' => $this->parseData($dtl->Akhiran),
                'kalimat' => $this->parseData($dtl->Kalimat),
            ]);
        }
        $title = ucfirst(str_replace('.'.$result[0]['ext'], '', $result[0]['katautama']));
        
        return view('detail', [
            "title" => "Detail | ".$title." ( ".(ucfirst($result[0]['ext']))." )",
            "detail" => $result
        ]);
    }
    public static function sameData($new,$kata)
    {
        $i = 0;
        foreach ($new as $new2) {
            // if ($i == 0) {
            //     $temp[$i] = $new2[$kata];
            //     $print[$i]= $new2[$kata];
            //     $i++;
            // } else {
            //     if ($new2[$kata] != $temp[$i-1]) {
            //         $temp[$i] = $new2[$kata];
            //         $print[$i] = $new2[$kata];
            //         $i++;
            //     }
            // }

            $print[$i] = $new2[$kata];
            $i++;
        }   
        $print=array_unique($print);

        
        return $print;
    }
}
