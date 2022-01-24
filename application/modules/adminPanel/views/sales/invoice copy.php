<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('invoice/css/bootstrap.css') ?>" />
    <!-- Font Awosome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('invoice/font-awosome/font-awosome.css') ?>" />
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('invoice/css/style.css') ?>" />
    <title><?= APP_NAME ?></title>
</head>
<body>
    <section class="bill_section">
        <div class="container">
            <div class="bill_heading">
                <h2>Delivery Challan</h2>
            </div>
            <div class="row bill_main">
                <div class="col-lg-6 bill_left left_border_logo_sec">
                    <div class="bill_logo_section">
                        <div class="row logo_section">
                            <div class="col-lg-4 logo_sec_left bdr_logo_left">
                                <div class="logo">
                                    <?= img("assets/images/logo.png") ?>
                                </div>
                            </div>
                            <div class="col-lg-8 logo_sec_right bdr_logo_left">
                                <div class="logo_sec_content">
                                    <h2><?= strtoupper(APP_NAME) ?></h2>
                                    <p>F/8,Shilp Arcade,<br>Opp.Mahila College,Station
                                        Road,<br>Unjha<br>Mo.9033412320<br>Mo.9909758100<br>E-Mail :
                                        kesharmobileunjha01@gmail.com</p>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bill_logo_sec_1 padd_sec  ">
                        <p>Buyer (Bill to)</p>
                        <h5>APURV PATEL</h5>
                        <h6>UNJHA</h6>
                    </div>
                </div>
                <div class="col-lg-6 bill_right">
                    <div class="row bill_right_main">
                        <div class="col-lg-6 right_bill_">
                            <p>Invoce No.</p>
                            <h6>1443</h6>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Dated</p>
                            <h6>28-Dec-2021</h6>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Delivery Note</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Mode/Terms of Payment</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Reference No. & Date</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Other References</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Buyer's Order No.</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Dated</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Dispatch Doc No.</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Dilivery Notr Date</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Dispatched Through</p>
                        </div>
                        <div class="col-lg-6 right_bill_">
                            <p>Destination</p>
                        </div>
                        <div class="col-12 right_bill_ right_bill_height">
                            <p>Terms of Delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="decription_section">
        <div class="container">
            <div class="row des_sect_main">
                <div class="col-lg-1 dec_sec_border side_border">
                    <h6>Sr.No</h6>
                </div>
                <div class="col-lg-4 dec_sec_border">
                    <h6>Description Of Goods</h6>
                </div>
                <div class="col-lg-2 dec_sec_border">
                    <h6>Quantity</h6>
                </div>
                <div class="col-lg-2 dec_sec_border">
                    <h6>Rate</h6>
                </div>
                <div class="col-lg-1 dec_sec_border">
                    <h6>Per</h6>
                </div>
                <div class="col-lg-2 dec_sec_border right_border_dec_">
                    <h6>Amount</h6>
                </div>
            </div>
            <div class="row des_sect_main des_sect_main_height ">
                <div class="col-lg-1 dec_sec_border side_border">
                    <h6>1</h6>
                </div>
                <div class="col-lg-4 dec_sec_border">
                    <h6>URBAN FIT SMARTWATCH</h6>
                </div>
                <div class="col-lg-2 dec_sec_border">
                    <h6>1 nos</h6>
                </div>
                <div class="col-lg-2 dec_sec_border">
                    <h6>4,800.00</h6>
                </div>
                <div class="col-lg-1 dec_sec_border">
                    <h6>nos</h6>
                </div>
                <div class="col-lg-2 dec_sec_border right_border_dec_">
                    <h6>4,800.00</h6>
                </div>
            </div>

            <div class="row des_sect_main">
                <div class="col-lg-1 dec_sec_border side_border">
                    <h6></h6>
                </div>
                <div class="col-lg-4 dec_sec_border">
                    <h6>Total</h6>
                </div>
                <div class="col-lg-2 dec_sec_border">
                    <h6>1 nos</h6>
                </div>
                <div class="col-lg-2 dec_sec_border">
                    <h6>Rate</h6>
                </div>
                <div class="col-lg-1 dec_sec_border">
                    <h6>Per</h6>
                </div>
                <div class="col-lg-2 dec_sec_border right_border_dec_">
                    <h5><span><i class="fa fa-inr" aria-hidden="true"></i> 4,800.00</span></h5>
                </div>
            </div>
        </div>
    </section>

    <section class="bill_footer">
        <div class="container">
            <div class="row bill_footer_main bill_ftr_main_border">
                <div class="col-lg-6 bill_footer_left">
                    <p>Amount Chargeable (in words)</p>
                    <h6>INR Four Thousand Eight Hundred Only</h6>
                </div>
                <div class="col-lg-6 right_bill_ftr">
                    <p>E. & O.E</p>
                </div>
                <div class="col-lg-6 bill_footer_right">
                    <p class="ftr_content_p">Remarks:<br>CASH</p>
                </div>
                <div class="col-lg-6 bill_footer_right">
                    <h6 class="content_company">Company's Bank Details<br>Bank Name : HDFC CURRENT A/C<br>A/C No. :
                        50200039563291<br>Branch & IFSC Code : UNJHA & HDFC0000179<br>SWIFT Code : G&P-PAY-9033412320
                    </h6>
                </div>
                <div class="col-lg-6 bill_footer_right">
                    <h6>Declaration</h6>
                    <p> We declare that this invoice shows that actual price of the goods decribed and that all
                        particulars are true and correct.</p>
                </div>
                <div class="col-lg-6 bill_footer_right right_ftr_border border_ftr_right_">
                    <p>For KESHAR MOBILE</p>
                    <br>
                    <br>
                    <br>
                    <p>Authorised Signatory</p>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>