<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Inertia\Inertia;

require_once app_path('Libraries/fpdf.php');

class VoucherPrintController extends Controller
{
    public function print(Voucher $voucher)
    {
        return Inertia::render('print/Voucher',[
            'voucher'=>$voucher->load('sales')
        ]);
    }
}
