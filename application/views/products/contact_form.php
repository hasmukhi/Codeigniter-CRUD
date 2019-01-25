<?php $this->load->view('includes/header'); ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        <?php echo validation_errors(); ?>

      <form action="<?php echo base_url('contactSend') ?>" method="post">
        <div class="form-group">
          <label>Name:</label>
          <input type="text" name="name" class="form-control" placeholder="Name">
        </div>

        <div class="form-group">
          <strong>Email:</strong>
          <input type="text" name="email" class="form-control" placeholder="Email">
        </div>

        <div class="form-group">
          <strong>Message:</strong>
          <textarea class="form-control" name="message" placeholder="Message"></textarea>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary btn-block btn-submit">
        </div>
      </form>
    </div>
    </div>
  </div>
<?php $this->load->view('includes/footer'); ?>
