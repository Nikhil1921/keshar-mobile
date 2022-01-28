<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
  <div class="card card-dark card-outline">
    <div class="card-header">
      <h5 class="card-title m-0"><?= ucwords($operation).' Documents' ?></h5>
    </div>
    <div class="card-body">
      <div class="row">
        <?php foreach(json_decode($data['documents']) as $k => $doc): ?>
          <div class="col-md-6">
            <?= form_open_multipart('', '', ['key' => $k]) ?>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <?= form_label('Document Image', 'doc_'.$k) ?>
                  <?= form_input([
                      'class' => "form-control",
                      'type'  => 'file',
                      'id'  => 'doc_'.$k,
                      'onchange' => 'this.form.submit()',
                      'accept' => 'image/png, image/jpg, image/jpeg',
                      'name' => "document"
                  ]); ?>
                </div>
              </div>
              <div class="col-md-4">
                  <?= img(['src' => $path.$doc->image, 'height' => '80', '', 'width' => '100%']) ?>
              </div>
            </div>
            <?= form_close() ?>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="card-footer">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                <?= anchor($url, 'Go Back', 'class="btn btn-outline-danger col-md-12"'); ?>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>