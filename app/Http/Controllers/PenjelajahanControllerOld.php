<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class PenjelajahanController extends Controller
{
    public function index(Request $request)
    {

        $value = $cari = $kondisi =  NULL;
        $penjelajahan = [];
        if ($request->cari == 'cari') {
            $cari = true;
            if ($request->penjelajahan === NULL) {
                $kondisi = 0;
            } elseif ($request->penjelajahan == 'tingkatan') {
                $value = 'tingkatan';
                // Alus Sor
                $sor = $this->sparql->query('SELECT * WHERE{?AlusSor a kbb:AlusSor}');
                $result1 = array();
                foreach ($sor as $AlusSor) {
                    array_push($result1, $this->parseData($AlusSor->AlusSor->getUri()));
                }
                asort($result1);

                // Alus Singgih
                $singgih = $this->sparql->query('SELECT * WHERE{?AlusSinggih a kbb:AlusSinggih}');
                $result2 = [];
                foreach ($singgih as $AlusSinggih) {
                    array_push($result2, $this->parseData($AlusSinggih->AlusSinggih->getUri()));
                }
                asort($result2);

                // Alus Mider
                $mider = $this->sparql->query('SELECT * WHERE{?AlusMider a kbb:AlusMider}');
                $result3 = [];
                foreach ($mider as $AlusMider) {
                    array_push($result3, $this->parseData($AlusMider->AlusMider->getUri()));
                }
                asort($result3);

                //Andap
                $andap = $this->sparql->query('SELECT * WHERE{?BaliAndap a kbb:Andap}');
                $result4 = [];
                foreach ($andap as $BaliAndap) {
                    array_push($result4, $this->parseData($BaliAndap->BaliAndap->getUri()));
                }
                asort($result4);

                //Kasar
                $kasar = $this->sparql->query('SELECT * WHERE{?BaliKasar a kbb:Kasar}');
                $result5 = [];
                foreach ($kasar as $BaliKasar) {
                    array_push($result5, $this->parseData($BaliKasar->BaliKasar->getUri()));
                }
                asort($result5);

                $penjelajahan = [
                    "Bahasa Bali Alus Sor" => $result1,
                    "Bahasa Bali Alus Singgih" => $result2,
                    "Bahasa Bali Alus Mider" => $result3,
                    "Bahasa Bali Andap" => $result4,
                    "Bahasa Bali Kasar" => $result5
                ];

                // foreach ($penjelajahan as $item => $babi){
                //     echo "Nama Kelas = $item <br><br><br>";
                //     foreach ($babi as $item2)
                //     echo "$item2 <br>";
                // }

                // dd($penjelajahan);
            } elseif ($request->penjelajahan == 'bentuk') {
                $value = "bentuk";
                $dasar = $this->sparql->query('SELECT * WHERE {{?kata a kbb:AlusSor}UNION{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}{?kata kbb:menggunakanBentukKata kbb:kata_dasar.}}');
                $result1 = [];
                foreach ($dasar as $BaliDasar) {
                    array_push($result1, $this->parseData($BaliDasar->kata->getUri()));
                }
                asort($result1);

                $turunan = $this->sparql->query('SELECT * WHERE {{?kata a kbb:AlusSor}UNION{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}{?kata kbb:menggunakanBentukKata kbb:kata_turunan.}}');
                $result2 = [];
                foreach ($turunan as $BaliDasar) {
                    array_push($result2, $this->parseData($BaliDasar->kata->getUri()));
                }
                asort($result2);


                $penjelajahan = [
                    "Kata Dasar" => $result1,
                    "Kata Turunan" => $result2
                ];
            } elseif ($request->penjelajahan == 'kategori') {
                $value = "kategori";
                $querysub = $this->sparql->query('SELECT * WHERE { ?subclass a kbb:KategoriKata }');
                $result1 = [];
                foreach ($querysub as $item) {
                    array_push($result1, $this->parseData($item->subclass->getUri()));
                }

                $i = 1;
                foreach ($result1 as $item) {
                    $sql = 'SELECT * WHERE {{?kata a kbb:AlusSor}UNION{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}{?kata kbb:menggunakanKategoriKata kbb:' . $item . '.}}';
                    $query = $this->sparql->query($sql);
                    ${'data' . $i} = [];
                    foreach ($query as $KategoriKata) {
                        array_push(${'data' . $i}, $this->parseData($KategoriKata->kata->getUri()));
                    }
                    asort(${'data' . $i});
                    $i++;
                }
                $i = 1;
                foreach ($result1 as $item) {
                    $item = ucwords(str_replace('_',' ',$item),' ');
                    $penjelajahan[$item] = ${'data' . $i};
                    $i++;
                }

                // $penjelajahan = [
                //     "Kata Dasar" => $result1,
                //     "Kata Turunan" =>$result2
                // ];
            }
        } else {
            $cari = NULL;
        }


        return view('penjelajahan', [
            "title" => "Penjelajahan",
            "penjelajahan" => $penjelajahan,
            "value" => $value
        ]);
    }
}
