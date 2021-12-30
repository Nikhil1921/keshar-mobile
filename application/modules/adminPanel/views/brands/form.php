<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-dark card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' '.ucwords($title) ?></h5>
    </div>
    <?= form_open() ?>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Brand Name', 'b_name') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "b_name",
                'name' => "b_name",
                'maxlength' => 50,
                'required' => "",
                'value' => set_value('b_name') ? set_value('b_name') : (isset($data['b_name']) ? $data['b_name'] : '')
            ]); ?>
            <?= form_error('b_name') ?>
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