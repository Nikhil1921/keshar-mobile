<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content col-md-12" id="print-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h2 class="text-center">
                                Delivery Challan
                            </h2>
                            <img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" width="100">
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?= APP_NAME ?></strong><br>
                                F/8,Shilp Arcade,<br />
                                Opp.Mahila College,Station Road,<br />
                                Unjha
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            Buyer (Bill to)
                            <address>
                                <strong><?= $data['cust_name'] ?></strong>
                                <br>
                                <div class="row">
                                    <span class="col-sm-12">Phone : <?= $data['mobile'] ?></span>
                                </div>
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice No. : #
                                <?php for ($i=0; $i < (4 - strlen($data['id'])) ; $i++) { echo 0; } echo $data['id']; ?></b><br>
                            <br>
                            <b>Dated :</b> <?= date('d-m-Y', strtotime($data['create_date'])) ?><br>
                            <b>Delivery Note :</b> Mode/Terms of Payment<br />
                            <b>Reference No. & Date :</b> Other References<br />
                            <b>Dispatch Doc No. :</b> Delivery Note Date<br />
                            <b>Dispatched Through :</b> Destination<br />
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial #</th>
                                        <th>Description Of Goods</th>
                                        <th>Rate</th>
                                        <th>Quantity</th>
                                        <th>Per</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $data['brand'] ?> - <?= $data['model'] ?> - <?= $data['imei'] ?></td>
                                        <td><?= $data['sell_price'] ?></td>
                                        <td>1</td>
                                        <td>nos</td>
                                        <td><?= $data['sell_price'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><b>Total</b></td>
                                        <td>₹ <?= $data['sell_price'] ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">Amount Chargeable (in words) : 
                                        <b><?= getIndianCurrency($data['sell_price']) ?> Only</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-7">
                            Remarks:<br />
                            CASH<br /><br />
                            <b>Declaration:</b> <br />
                            We declare that this invoice shows that actual price of the goods decribed and that all
                            particulars are true and correct. <br /><br />
                            <b>For <?= strtoupper(APP_NAME) ?></b> <br />
                            Authorised Signatory
                        </div>
                        <br />
                        <div class="col-5">
                            <p class="lead">Company's Bank Details</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Bank Name</th>
                                            <td>HDFC CURRENT A/C</td>
                                        </tr>
                                        <tr>
                                            <th>A/C No.</th>
                                            <td>50200039563291</td>
                                        </tr>
                                        <tr>
                                            <th>Branch & IFSC Code</th>
                                            <td>UNJHA & HDFC0000179</td>
                                        </tr>
                                        <tr>
                                            <th>SWIFT Code</th>
                                            <td>G&P-PAY-9033412320</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="<?= base_url($url) ?>" class="btn btn-outline-danger float-right col-sm-2"> Go Back
                            </a>
                            <button type="button" onclick="window.print()" class="btn btn-default col-sm-2 float-right"
                                style="margin-right: 5px;">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 

function getIndianCurrency(float $num)
{
    $ones = array(
        0 =>"ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );

    $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    ); /*limit t quadrillion */

    $num = number_format($num,2,".",",");
    $num_arr = explode(".",$num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",",$wholenum));
    krsort($whole_arr,1);
    $rettxt = "";
    foreach($whole_arr as $key => $i){

    while(substr($i,0,1)=="0")
    $i=substr($i,1,5);
    if($i < 20){ $rettxt .=$ones[$i]; }elseif($i < 100){ if(substr($i,0,1)!="0" ) $rettxt
        .=$tens[substr($i,0,1)]; if(substr($i,1,1)!="0" ) $rettxt .=" " .$ones[substr($i,1,1)]; }else{
        if(substr($i,0,1)!="0" ) $rettxt .=$ones[substr($i,0,1)]." ".$hundreds[0]; 
            if(substr($i,1,1)!=" 0")$rettxt .=" " .$tens[substr($i,1,1)]; if(substr($i,2,1)!="0" )$rettxt .=" "
            .$ones[substr($i,2,1)]; } if($key> 0)
            {
                $rettxt .= " ".$hundreds[$key]." ";
            }
        }
        if($decnum > 0){
        $rettxt .= " and ";
        if($decnum < 20){ $rettxt .=$ones[$decnum]; }elseif($decnum < 100){ $rettxt .=$tens[substr($decnum,0,1)];
            $rettxt .=" " .$ones[substr($decnum,1,1)]; } } return $rettxt; } extract($_POST); if(isset($convert)) {
            return numberTowords("$num");
}