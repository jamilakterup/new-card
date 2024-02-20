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
        $request->validate([
            'csv' => ['required', 'mimes:csv'],
            'images' => ['required'],
        ]);

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $imageName =  $request->card_id . "_" . $name;
                $imagePath = public_path("storage/temp");
                $file->move($imagePath, $imageName);
            }
        }



        $file = $request->file('csv');
        $fileName = time() . '.csv';
        $file->storeAs("temp", $fileName, 'public');
        $filePath = public_path("storage/temp/$fileName");

        $csvData = csvToArray($filePath);

        File::delete($filePath);



        $cardImg = Card::find($request->card_id);
        // dd($cardImg->front_pdf);



        $cardInfo = CardInfo::where('card_id', $request->card_id)->first();
        //$cardData = json_decode($cardInfo, true);

        $frontCardConfig = json_decode($cardInfo->front_page_info, true);
        $backCardConfig = json_decode($cardInfo->back_page_info, true);



        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [54, 85.6], 10, 'lato', 0, 0, 0, 0]);
        $mpdf->SetProtection(array('print', 'print-highres'));
        $mpdf->ignore_invalid_utf8 = true;



        foreach ($csvData as $studentInfo) {
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
                    $mpdf->SetFont('lato', 'r', 6.5);
                    if (substr($value, -4) === '.jpg') {
                        $height = (int)$config['height'] * 0.265;
                        $width = (int)$config['width'] * 0.265;

                        $img_url = 'storage/temp/' . $request->card_id . '_' . $value;
                        $mpdf->Image($img_url, $x_pos, $y_pos, $width, $height, 'jpg', '', true, false);
                    } else {
                        $mpdf->WriteText($x_pos, $y_pos, $value);
                    }
                }
            }
        }

        foreach ($csvData as $studentInfo) {
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
                    $mpdf->SetFont('lato', 'r', 6.5);
                    $mpdf->WriteText($x_pos, $y_pos, $value);
                }
            }
        }


        $mpdf->Output('filename.pdf', 'I');
    }
}
