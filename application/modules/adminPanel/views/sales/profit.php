<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content col-md-12" id="print-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <!-- <div class="row mb-3">
                        <div class="col-12">
                            <h2 class="text-center">
                                Profit
                            </h2>
                            <img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" width="100">
                        </div>
                    </div> -->
                    <div class="row invoice-info">
                        <!-- <div class="col-sm-3 invoice-col">
                            From
                            <address>
                                <strong><?= APP_NAME ?></strong><br>
                                F/8,Shilp Arcade,<br />
                                Opp.Mahila College,Station Road,<br />
                                Unjha
                            </address>
                        </div> -->
                        <div class="col-sm-3 invoice-col">
                            <b>Invoice No. : # <?php for ($i=0; $i < (4 - strlen($data['id'])) ; $i++) { echo 0; } echo $data['id']; ?></b>
                        </div>
                        <div class="col-sm-3 invoice-col">
                            Buyer
                            <address>
                                <strong><?= $data['buyer'] ?></strong>
                                <br>
                                <div class="row">
                                    <span class="col-sm-12">Phone No.: <?= $data['b_mobile'] ?></span>
                                    <span class="col-sm-12">Date : <?= date('d-m-Y', strtotime($data['sell_date'])) ?></span>
                                </div>
                            </address>
                        </div>
                        <div class="col-sm-3 invoice-col">
                            Seller
                            <address>
                                <strong><?= $data['seller'] ?></strong>
                                <br>
                                <div class="row">
                                    <span class="col-sm-12">Phone No.: <?= $data['s_mobile'] ?></span>
                                    <span class="col-sm-12">Date : <?= date('d-m-Y', strtotime($data['b_date'])) ?></span>
                                </div>
                            </address>
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
                                        <th>Buy Price</th>
                                        <th>Sell Price</th>
                                        <th>Difference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php  $profit = $data['sell_price'] - $data['b_price']; ?>
                                        <td>1</td>
                                        <td><?= $data['b_name'] ?> - <?= $data['model'] ?> - <?= $data['imei'] ?></td>
                                        <td><?= $data['b_price'] ?></td>
                                        <td><?= $data['sell_price'] ?></td>
                                        <td><?= $profit ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="<?= base_url($url) ?>" class="btn btn-outline-danger float-right col-sm-2"> Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>