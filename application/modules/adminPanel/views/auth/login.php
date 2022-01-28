<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?= form_open() ?>
    <div class="form-group">
      <div class="input-group">
      <?= form_input([
      'name' => 'mobile',
      'class' => 'form-control',
      'placeholder' => 'Enter Mobile No.',
      'maxlength' => '10'
      ]) ?>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-phone"></span>
        </div>
      </div>
    </div>
    <?= form_error('mobile') ?>
    </div>
    <div class="row">
      <div class="col-12">
        <?= form_button([ 'content' => 'Send OTP',
        'type'    => 'submit',
        'class'   => 'btn btn-primary btn-block']) ?>
      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>