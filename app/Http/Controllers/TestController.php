<?php

namespace App\Http\Controllers;

use App\Models\CardInfo;
use Illuminate\Http\Request;
use Mpdf;


class TestController extends Controller
{


    public function generatePdf()
    {
        $cardInfo = CardInfo::all();
        $cardData = json_decode($cardInfo[0]->front_page_info, true);
        // dd($cardData);




        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [54, 85.6], 10, 'lato', 0, 0, 0, 0]);
        $pagecount = $mpdf->SetSourceFile(public_path() . '/assets/template/NGDC.pdf');
        $tplIdx    = $mpdf->ImportPage($pagecount);
        $mpdf->UseTemplate($tplIdx);
        $mpdf->img_dpi = 96;
        //$mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->SetFont('lato', 'r', 6.5);

        foreach ($cardData as $key => $value) {
            $mpdf->WriteText(intval($value['x_pos']) * 0.265, intval($value['y_pos']) * 0.265, $value['field_value']);
        }
        // $mpdf->WriteText(21.5, 51.8, "Eleven");
        // $mpdf->WriteText(21.5, 56.4, "Science");
        // $mpdf->WriteText(21.5, 61.1, "201294");
        $mpdf->WriteText(21.5, 65.5, "2018-19");
        $mpdf->WriteText(21.5, 70, "Physics");
        $mpdf->Output();
    }
}
