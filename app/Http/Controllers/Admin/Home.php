<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Str;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Home extends Controller
{

    public function index(Request $request)
    {
        // Save only number to database if provided
        if ($request->has('number')) {
            DB::table('config')->where('id', 1)->update([
                'filter_number' => $request->number,
            ]);
        }
        
        // Redirect with saved number if no parameters
        if (!$request->has('number')) {
            $config = DB::table('config')->where('id', 1)->first();
            $number = $config->filter_number ?? 27;
            return redirect()->to('/admin?number=' . $number . '&from_date=&to_date=');
        }
        
        return view("admin.pages.home");
    }

    // public function pdf()
    // {
    //     $mpdf = new \Mpdf\Mpdf();
    //     $mpdf->baseScript = 1;
    //     $mpdf->autoScriptToLang = true;
    //     $mpdf->autoLangToFont = true;
    //     $mpdf->autoArabic = true;
    //     $pdf = view('admin.pages.pdf');
    //     $mpdf->WriteHTML($pdf);
    //     return $mpdf->Output();
    // }
public function pdf()
{
    $mpdf = new \Mpdf\Mpdf([
        'default_font' => 'dejavusans', // Ensure a font that supports Arabic is set
    ]);

    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->autoArabic = true;

    // Get dynamic data
    $number = request('number') ? request('number') : 26;
    $from_date = request('from_date');
    $to_date = request('to_date');
    
    // Render the Blade view into HTML
    $html = view('admin.pages.pdf', compact('number', 'from_date', 'to_date'))->render();

    // Write HTML to PDF
    $mpdf->WriteHTML($html);

    // Output the PDF for download
    return $mpdf->Output('Report.pdf', \Mpdf\Output\Destination::INLINE);
}

    public function excel()
    {
        $spreadsheet = IOFactory::load(__DIR__ . '/../../../../../1.xlsx');
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        foreach ($sheetData as $key => $val) {
            if ($key > 1) {
                /* \App\Region::insert([
                    'name_ar' => $val['B'],
                    'name_en' => $val['C'],
                    'city_id' => $val['A'],
                    'active' => 'active',
                ]); */
            }
        }
        return 'done';
    }
}
