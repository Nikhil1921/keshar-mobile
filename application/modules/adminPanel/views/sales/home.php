<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-dark card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-9">
          <h5 class="card-title m-0"><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" class="date_filter form-control float-right">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-striped table-hover datatable">
        <thead>
          <tr>
            <th class="target">Sr. No.</th>
            <th>Customer Name</th>
            <th>Customer Mobile</th>
            <th>Price</th>
            <th>IMEI</th>
            <th>Date</th>
            <th>Model Name</th>
            <th>Brand Name</th>
            <th class="target">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<input type="hidden" id="start-date" />
<input type="hidden" id="end-date" />