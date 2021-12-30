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
            <?= form_label('Brand Name', 'brand_id') ?>
            <select name="brand_id" id="brand_id" class="form-control" required>
              <option value="" selected disabled>Select Brand</option>
              <?php foreach($brands as $brand): ?>
                <option value="<?= e_id($brand['id']) ?>" <?= set_value('brand_id') ? set_select('brand_id', e_id($brand['id'])) : (isset($data['brand_id']) && $brand['id'] == $data['brand_id'] ? 'selected' : '') ?>><?= $brand['b_name'] ?></option>
              <?php endforeach ?>
            </select>
            <?= form_error('brand_id') ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= form_label('Model Name', 'm_name') ?>
            <?= form_input([
                'class' => "form-control",
                'id' => "m_name",
                'name' => "m_name",
                'maxlength' => 50,
                'required' => "",
                'value' => set_value('m_name') ? set_value('m_name') : (isset($data['m_name']) ? $data['m_name'] : '')
            ]); ?>
            <?= form_error('m_name') ?>
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