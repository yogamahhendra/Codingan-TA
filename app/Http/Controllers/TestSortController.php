<?php

namespace App\Http\Controllers;

class TestSortController extends Controller
{
    public function quickSort()
    {
        // Alus Sor
        $sor = $this->sparql->query('SELECT * WHERE{?AlusSor a kbb:AlusSor}');
        $result1= array();
        foreach ($sor as $AlusSor) {
            array_push($result1, $this->parseData($AlusSor->AlusSor->getUri()));
        }

        // Alus Singgih
        $singgih = $this->sparql->query('SELECT * WHERE{?AlusSinggih a kbb:AlusSinggih}');
        $result2 = [];
        foreach ($singgih as $AlusSinggih) {
            array_push($result2, [
                'kataalussinggih' => $this->parseData($AlusSinggih->AlusSinggih->getUri())
            ]);
        }
        var_dump($result1);
        sort($result1);
        for ($i=0;$i<count($result1);$i++) {
            echo $result1[$i];
            echo "<br>";
        }
        echo "<br>";
        $result3=[];
        asort($result2);
        foreach ($result2 as $result3) {
            echo $result3['kataalussinggih'];
            echo "<br>";
        }
        // return view('penjelajahan',[
        //     "title" => "Penjelajahan",
        //     "asor" => $result1,
        //     "asi" => $result2
        // ]);
    }
}
