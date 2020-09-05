<div class="col-md-12">
  <div class="panel panel-infos">
    <div class="tab-content panel panel-default panel-block">
      <div class="tab-pane list-group active" id="attribute_group">
        <div class="panel-body">
          <p class="errormessage text-center">
            <?php
             $message = $this->session->flashdata("message");
            ?>
            <?php if(isset($message)) { ?><div class="alert alert-success alert-dismissible">
              <?php echo $message; ?>
              </div>
            <?php } ?>
          </p>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panelss">
                <div class="x_title">
                  <h2>Add Client</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <?php
                  echo form_open_multipart('admin/client/add',array('method'=>'post','class'=>'form-horizontal form-label-left validate_form'))?>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control validate[required]" placeholder="Client Name*">
                    </div>
                    <div class="form-group">
                      <label for="client_img" class="btn btn-info">Image</label>
                        <input type="file" id="client_img" name="client_img" onchange="document.getElementById('product').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                        <img id="product" height="50px" src="#" alt="" />
                    </div>
                  </div>

                  <div class="clearfix"></div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                  <?php echo form_close();?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>