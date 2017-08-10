<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mpdf\Mpdf;

class TimesheetController extends Controller
{

	public function preview(Request $request)
	{
	    $data = $request->input();

		return view('timesheet', $data);
	}

	public function download(Request $request)
	{
        $data = $request->input();

		$html = view('timesheet', $data);

		$mpdf = new Mpdf(['format' => 'Letter-L', 'margin_top' => 10, 'margin_bottom' => 10]);
		$mpdf->WriteHTML($html);
		$mpdf->Output('timesheet.pdf', 'D');
	}

}
