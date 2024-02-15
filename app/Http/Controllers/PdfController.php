<?php

namespace App\Http\Controllers;

use Mpdf;
use App\Models\Card;
use App\Models\CardInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\TextUI\XmlConfiguration\RemoveEmptyFilter;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        $file = $request->file('csv');
        $fileName = time() . '.csv';
        $file->storeAs("temp", $fileName, 'public');
        $filePath = public_path("storage/temp/$fileName");

        $data = csvToArray($filePath);

        File::delete($filePath);



        $cardImg = Card::find($request->card_id);
        // dd($cardImg->front_pdf);


        $cardInfo = CardInfo::find($request->card_id);
        $cardData = json_decode($cardInfo, true);

        $frontCardConfig = json_decode($cardData['front_page_info'], true);
        $backCardConfig = json_decode($cardData['back_page_info'], true);



        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [54, 85.6], 10, 'lato', 0, 0, 0, 0]);
        $mpdf->SetProtection(array('print', 'print-highres'));
        $mpdf->ignore_invalid_utf8 = true;



        foreach ($data as $studentInfo) {
            $mpdf->AddPage();
            $pagecount = $mpdf->SetSourceFile(public_path() . '/storage/' . $cardImg->front_pdf);
            $tplId = $mpdf->ImportPage($pagecount);
            $mpdf->UseTemplate($tplId);
            $mpdf->img_dpi = 96;

            // $mpdf1->img_dpi = 96;

            foreach ($frontCardConfig as $config) {
                $x_pos = (int)$config['x_pos'] * 0.265;
                $y_pos = (int)$config['y_pos'] * 0.265;

                if (array_key_exists($config['field_name'], $studentInfo)) {
                    $value = $studentInfo[$config['field_name']];
                }
                $mpdf->SetFont('lato', 'r', 6.5);
                $mpdf->WriteText($x_pos, $y_pos, $value);
            }
        }

        foreach ($data as $studentInfo) {
            $mpdf->AddPage();
            $pagecount = $mpdf->SetSourceFile(public_path() . '/storage/' . $cardImg->back_pdf);
            $tplId = $mpdf->ImportPage($pagecount);
            $mpdf->UseTemplate($tplId);
            $mpdf->img_dpi = 96;

            foreach ($backCardConfig as $config) {
                $x_pos = (int)$config['x_pos'] * 0.265;
                $y_pos = (int)$config['y_pos'] * 0.265;

                if (array_key_exists($config['field_name'], $studentInfo)) {
                    $value = $studentInfo[$config['field_name']];
                }
                $mpdf->SetFont('lato', 'r', 6.5);
                $mpdf->WriteText($x_pos, $y_pos, $value);
            }
        }


        $mpdf->Output('filename.pdf', 'I');
    }
}
