<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PenjelajahanController extends Controller
{
    public function index()
    {
        $listclass = [
            "Tingkatan Bahasa",
            "Kategori Kata",
            "Bentuk Kata"
        ];
        return view('penjelajahan', [
            "title" => "Penjelajahan",
            "listclass" => $listclass,
        ]);
    }
    public function class($class)
    {
        if ($class == 'TingkatanBahasa') {
            $data = ['Bahasa Bali Alus Sor', 'Bahasa Bali Alus Singgih', 'Bahasa Bali Alus Mider', 'Bahasa Bali Andap', 'Bahasa Bali Kasar'];
            $class = trim(preg_replace('/(?<=\\w)(?=[A-Z])/', " ", $class));
        } else {
            $querysub = $this->sparql->query('SELECT * WHERE { ?subclass a kbb:' . $class . ' }');
            $data = [];
            foreach ($querysub as $item) {
                array_push($data, $this->parseData($item->subclass->getUri()));
            }
            $class = trim(preg_replace('/(?<=\\w)(?=[A-Z])/', " ", $class));
        }

        return view('penjelajahan', [
            "title" => "Penjelajahan",
            "data" => $data,
            "class" => $class
        ]);
    }
    public function individual($class, $individual)
    {
        if ($class == 'TingkatanBahasa') {
            $query = $this->sparql->query('SELECT * WHERE{?tingkatan a kbb:' . $individual . '}');
            $data = [];
            foreach ($query as $item) {
                array_push($data, $this->parseData($item->tingkatan->getUri()));
            }
            asort($data);
            $class = trim(preg_replace('/(?<=\\w)(?=[A-Z])/', " ", $class));
        } else {
            $query2 = 'SELECT * WHERE {{?kata a kbb:AlusSor}UNION{?kata a kbb:AlusSinggih}UNION{?kata a kbb:AlusMider}UNION{?kata a kbb:Andap}UNION{?kata a kbb:Kasar}{?kata kbb:menggunakan' . $class . ' kbb:' . $individual . '.}}';
            $query = $this->sparql->query($query2);
            $data = [];
            foreach ($query as $item) {
                array_push($data, $this->parseData($item->kata->getUri()));
            }
            asort($data);
            $class = trim(preg_replace('/(?<=\\w)(?=[A-Z])/', " ", $class));

        }
        asort($data);
        $class2 = str_replace(' ','',$class);
        $paginationkata = $this->paginate($data)->withQueryString()->withPath('/penjelajahan/'.$class2.'/'.$individual);
        echo count($data);


        return view('penjelajahan', [
            "title" => "Penjelajahan",
            "data" => $data,
            "class" => $class,
            "individual" => $individual,
            "paginationkata" => $paginationkata
        ]);
    }

    public function paginate($items, $perPage = 30, $page = null, $options = [])
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
}
