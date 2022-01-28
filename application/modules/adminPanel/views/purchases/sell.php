<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-dark card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($title) ?></h5>
    </div>
    <?= form_open() ?>
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Brand Name', 'brand_id') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "brand",
                'name' => "brand",
                'maxlength' => 50,
                'disabled' => "",
                'value' => $data['brand']
            ]); ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Model Name', 'model_id') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "model",
                'name' => "model",
                'maxlength' => 50,
                'disabled' => "",
                'value' => $data['model']
            ]); ?>
            <?= form_error('model_id') ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('IMEI No', 'imei') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "imei",
                'name' => "imei",
                'maxlength' => 50,
                'disabled' => "",
                'value' => $data['imei']
            ]); ?>
            <?= form_error('imei') ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Purchase price', 'price') ?>
            <?= form_input([
                'class' => "form-control",
                'type' => 'text',
                'id' => "price",
                'name' => "price",
                'maxlength' => 10,
                'disabled' => "",
                'value' => set_value('price') ? set_value('price') : (isset($data['price']) ? $data['price'] : '')
            ]); ?>
            <?= form_error('price') ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Customer Name', 'cust_name') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "cust_name",
                'name' => "cust_name",
                'maxlength' => 50,
                'required' => "",
                'value' => set_value('cust_name') ? set_value('cust_name') : (isset($data['cust_name']) ? $data['cust_name'] : '')
            ]); ?>
            <?= form_error('cust_name') ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Customer Mobile No.', 'mobile') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "mobile",
                'name' => "mobile",
                'maxlength' => 10,
                'required' => "",
                'value' => set_value('mobile') ? set_value('mobile') : (isset($data['mobile']) ? $data['mobile'] : '')
            ]); ?>
            <?= form_error('mobile') ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Sell price', 'price') ?>
            <?= form_input([
                'class' => "form-control",
                'type' => 'text',
                'id' => "price",
                'name' => "price",
                'maxlength' => 10,
                'required' => "",
                'value' => set_value('sell_price') ? set_value('sell_price') : (isset($data['sell_price']) ? $data['sell_price'] : '')
            ]); ?>
            <?= form_error('price') ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <?= form_label('Sell date', 'op_date') ?>
            <?= form_input([
                'class' => "form-control",
                'type' => 'date',
                'id' => "op_date",
                'name' => "op_date",
                'maxlength' => 10,
                'required' => "",
                'value' => set_value('op_date') ? set_value('op_date') : (isset($data['create_date']) ? $data['create_date'] : date('Y-m-d'))
            ]); ?>
            <?= form_error('op_date') ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                <?= form_button([ 'content' => 'Save',
                'type'  => 'submit',
                'class' => 'btn btn-outline-primary col-md-12']) ?>
                </div>
                <div class="col-md-6">
                <?= anchor($url, 'Cancel', 'class="btn btn-outline-danger col-md-12"'); ?>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>
  </div>
</div>