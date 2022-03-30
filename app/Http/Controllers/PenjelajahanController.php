<?php

namespace App\Http\Controllers;

class PenjelajahanController extends Controller
{
    public function index()
    {
        // Alus Sor
        $sor = $this->sparql->query('SELECT * WHERE{?AlusSor a kbb:AlusSor}');
        $result1= array();
        foreach ($sor as $AlusSor) {
            array_push($result1,['kataalussor' => $this->parseData($AlusSor->AlusSor->getUri())] );
        }
        asort($result1);

        // Alus Singgih
        $singgih = $this->sparql->query('SELECT * WHERE{?AlusSinggih a kbb:AlusSinggih}');
        $result2 = [];
        foreach ($singgih as $AlusSinggih) {
            array_push($result2, [
                'kataalussinggih' => $this->parseData($AlusSinggih->AlusSinggih->getUri())
            ]);
        }
        asort($result2);

        // Alus Mider
        $mider = $this->sparql->query('SELECT * WHERE{?AlusMider a kbb:AlusMider}');
        $result3 = [];
        foreach ($mider as $AlusMider) {
            array_push($result3, [
                'kataalusmider' => $this->parseData($AlusMider->AlusMider->getUri())
            ]);
        }
        asort($result3);

        //Andap
        $andap = $this->sparql->query('SELECT * WHERE{?BaliAndap a kbb:Andap}');
        $result4 = [];
        foreach ($andap as $BaliAndap) {
            array_push($result4, [
                'katabaliandap' => $this->parseData($BaliAndap->BaliAndap->getUri())
            ]);
        }
        asort($result4);

        //Kasar
        $kasar = $this->sparql->query('SELECT * WHERE{?BaliKasar a kbb:Kasar}');
        $result5 = [];
        foreach ($kasar as $BaliKasar) {
            array_push($result5, [
                'katabalikasar' => $this->parseData($BaliKasar->BaliKasar->getUri())
            ]);
        }
        asort($result5);

        return view('penjelajahan',[
            "title" => "Penjelajahan",
            "asor" => $result1,
            "asi" => $result2,
            "ami" => $result3,
            "andap" => $result4,
            "kasar" => $result5
        ]);
    }
}
