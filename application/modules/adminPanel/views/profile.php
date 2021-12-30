<div class="row">
  <div class="col-md-4">
    <div class="card card-success card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <?= img(['src' => 'assets/images/user.png', 'alt' => '', 'class' => 'profile-user-img img-fluid img-circle']) ?>
        </div>
        <h3 class="profile-username text-center">Update Profile</h3>
        <p class="text-muted text-center"></p>
        <?= form_open() ?>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Profile Name</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'name',
            'class' => 'form-control',
            'placeholder' => 'Enter Profile Name',
            'value' => $this->user->name
            ]) ?>
            <?= form_error('name') ?>
          </li>
          <li class="list-group-item">
            <b>Mobile No.</b>
            <?= form_input([
            'type' => 'text',
            'name' => 'mobile',
            'class' => 'form-control',
            'placeholder' => 'Enter Mobile No.',
            'value' => $this->user->mobile,
            'maxlength' => '10'
            ]) ?>
            <?= form_error('mobile') ?>
          </li>
          <li class="list-group-item">
            <b>Email Address</b>
            <?= form_input([
            'type' => 'email',
            'name' => 'email',
            'class' => 'form-control',
            'placeholder' => 'Enter Email Address',
            'value' => $this->user->email
            ]) ?>
            <?= form_error('email') ?>
          </li>
        </ul>
        <?= form_button([ 'content' => '<b>Update Profile</b>',
        'type'  => 'submit',
        'class' => 'btn btn-outline-primary btn-block']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>