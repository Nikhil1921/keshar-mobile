<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12">
    <div class="card card-dark card-outline">
        <div class="card-header">
            <h5 class="card-title m-0"><?= ucwords($operation).' Documents' ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach(json_decode($data['documents']) as $k => $doc): if ($doc->image): ?>
                <div class="col-md-4">
                    <?= img(['src' => $path.$doc->image, 'height' => '100', 'width' => '50%']) ?>
                </div>
                <div class="col-md-2">
                    <?= anchor($path.$doc->image, 'Download', 'class="btn btn-outline-primary col-md-12 mt-5" download'); ?>
                </div>
                <?php endif; endforeach ?>
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