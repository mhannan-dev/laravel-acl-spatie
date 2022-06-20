<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('myPDF', $data);
        dd($pdf);
        return $pdf->download('myPDF.pdf');
    }


    public function loop(Request  $request)
    {
        if($request->limit >270)
        {
            echo "You can not generate more than 270 barcode";
        }
        $data['user'] = User::where('id', 2)->first();
        $data['limit'] = $request->limit ?? 4;
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('barcode', $data);
        return $pdf->stream();

    }
}
