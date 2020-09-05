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
                  <h2>Update Category</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <?php
                  echo form_open_multipart('admin/category/edit/'.$data['category_id'],array('method'=>'post','class'=>'form-horizontal form-label-left validate_form'))?>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12 validate[required]" placeholder="Category Name*" value="<?php echo $data['name'];?>">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="status">
                       <option value="1" <?php echo $data['status'] == 1?'selected="selected"':''; ?>>Active</option>
                       <option value="0" <?php echo $data['status'] == 0?'selected="selected"':''; ?>>Inactive</option>
                     </select>
                    </div>
                  </div>
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