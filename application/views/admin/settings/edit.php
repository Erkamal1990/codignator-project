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
                  <h2>Update Client</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <?php
                  echo form_open_multipart('admin/setting/edit/'.$data['id'],array('method'=>'post','class'=>'form-horizontal form-label-left validate_form'))?>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <input type="text" id="name" disabled="disabled" name="name" class="form-control validate[required]" placeholder="Setting Name*" value="<?php echo $data['name'];?>">
                    </div>
                    <div class="form-group">
                        <input type="text" id="value" name="value" class="form-control validate[required]" placeholder="Setting value*" value="<?php echo $data['value'];?>">
                    </div>
                    <div class="form-group">
                      <label for="setting_img" class="btn btn-info">Image</label>
                        <input type="file" id="setting_img" name="setting_img" onchange="document.getElementById('product').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                        <img id="product" height="50px" src="<?php echo base_url().'uploads/client/'.$data['image'];?>" alt="" />
                    </div>
                     <div class="form-group">
                        <select class="form-control" name="status">
                          <option <?php echo $data['status'] == 1?'selected="selected"':''; ?> value="1">Active</option>
                          <option <?php echo $data['status'] == 0?'selected="selected"':''; ?> value="0">Inactive</option>
                        </select>
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