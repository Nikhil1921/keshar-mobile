<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section>
   <div class="bill_heading">
      <h2>Delivery Challan</h2>
   </div>
   <div class="header_logo">
      <img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" width="100">
   </div>
   <div class="content_main">
      <div class="bill_content">
         From<br>
         <b><?= APP_NAME ?></b><br>F/8,Shilp Arcade,<br>Opp.Mahila College,<br>Station Road,
         Unjha
      </div>
      <div class="bill_content1">
         Buyer (Bill to)<br><b><?= $data['cust_name'] ?></b><br>Phone : <?= $data['mobile'] ?>
      </div>
      <div class="bill_content2">
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
   <br>
   <br>
   <div class="tbl">
      <div class="border_line"></div>
      <div class="tbl_main">
         <div class="tbl_content_row">
            <p><b>Serial #</b></p>
         </div>
         <div class="tbl_content_row1">
            <p><b>Description Of Goods</b></p>
         </div>
         <div class="tbl_content_row2">
            <p><b>Rate</b></p>
         </div>
         <div class="tbl_content_row3">
            <p><b>Quantity</b></p>
         </div>
         <div class="tbl_content_row4">
            <p><b>Per</b></p>
         </div>
         <div class="tbl_content_row5">
            <p><b>Amount</b></p>
         </div>
      </div>
      <div class="border_line"></div>
      <div class="tbl_main">
         <div class="tbl_content_row">
            <p>1</p>
         </div>
         <div class="tbl_content_row1">
            <p><?= $data['brand'] ?> - <?= $data['model'] ?> - <?= $data['imei'] ?></p>
         </div>
         <div class="tbl_content_row2">
            <p><?= $data['sell_price'] ?></p>
         </div>
         <div class="tbl_content_row3">
            <p>1</p>
         </div>
         <div class="tbl_content_row4">
            <p>nos</p>
         </div>
         <div class="tbl_content_row5">
            <p><?= $data['sell_price'] ?></p>
         </div>
      </div>
      <div class="border_line"></div>
      <div class="tbl_main">
         <div class="tbl_content_row">
            <p></p>
         </div>
         <div class="tbl_content_row1">
            <p></p>
         </div>
         <div class="tbl_content_row2">
            <p></p>
         </div>
         <div class="tbl_content_row3">
            <p></p>
         </div>
         <div class="tbl_content_row4">
            <p><b>Total</b></p>
         </div>
         <div class="tbl_content_row5">
            <p>₹ <?= $data['sell_price'] ?></p>
         </div>
      </div>
      <div class="border_line"></div>
      <div class="tbl_main">
         <div class="tbl_content_row_">
            <p>Amount Chargeable (in words) : <b><?= @getIndianCurrency($data['sell_price']) ?> ONLY</b></p>
         </div>
         <div class="tbl_content_row1_">
            <p></p>
         </div>
      </div>
      <br>
      <br>
      <br>
      <div class="bill_footer">
         <div class="left">
            Remarks:<br>
            CASH<br>
            <br>
            <br>
            <b>Declaration:</b>
            We declare that this invoice shows that actual price of the goods decribed and that all particulars are true and correct.<br>
            <br>
            <br>
            <b>For <?= strtoupper(APP_NAME) ?></b><br>
            Authorised Signatory
         </div>
         <div class="right">
            <h3>
            Company's Bank Details
            <h3>
            <div class="ftr_line"></div>
            <div class="main_ftr_content">
               <div class="ftr_con_left">
                  <span class="fnt_sz"><b>Bank Name</b></span>
               </div>
               <div class="ftr_con_right">
                  <span class="frt_sz">HDFC CURRENT A/C</span>
               </div>
            </div>
            <div class="main_ftr_content">
               <div class="ftr_con_left">
                  <span class="fnt_sz">A/C No</span>
               </div>
               <div class="ftr_con_right">
                  <span class="frt_sz">50200039563291</span>
               </div>
            </div>
            <div class="main_ftr_content">
               <div class="ftr_con_left">
                  <span class="fnt_sz">Branch & IFSC Code</span>
               </div>
               <div class="ftr_con_right">
                  <span class="frt_sz">UNJHA & HDFC0000179</span>
               </div>
            </div>
            <div class="main_ftr_content">
               <div class="ftr_con_left">
                  <span class="fnt_sz">SWIFT Code</span>
               </div>
               <div class="ftr_con_right">
                  <span class="frt_sz">G&P-PAY-9033412320</span>
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