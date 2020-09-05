<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>List Of Client</h2>
	    <a href="<?php echo base_url() ?>admin/client/add" class="btn btn-success pull-right">Add Client</a>
	    <div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	    	<p class="errormessage text-center">
				<?php $success = $this->session->flashdata("message");
				 if($success != "") { ?><div class="alert alert-success alert-dismissible">
				 	<?php echo $success; ?>
				 </div><?php } ?>
			</p>
	    <table class="table table-striped table-bordered ListTable">
	      <thead>
	        <tr class="mainTr">
				<th class="increae_width">No.#</th>
				<th class="increae_width">Name</th>
				<th class="increae_width">image</th>
				<th class="increae_width">Status</th>
				<th class="increae_width">Opration</th>
			</tr>
	      </thead>
				<tbody>
				<?php 
				//var_dump($clientlist);
				$count = 1;
				 foreach($clientlist as $list){
				 	?>
				<tr class="odd">
					<td class="increae_width"><?php echo $count;?></td>
					<td class="increae_width"><?php echo $list['name'];?></td>
					<td class="increae_width">
						<img src="<?php echo base_url().'uploads/client/'.$list['image_url'];?>" width="50px">
					</td>
					<td class="increae_width">
						<?php echo $list['status'] == 1 ? 'Active':'Inactive';?>
					</td>
					<td class="increae_width">
						<a href="<?php echo base_url() ?>admin/client/edit/<?php echo  $list['img_id']; ?>" class="btn btn-primary btn-xs btnPadding"><i class="fa fa-pencil-square-o"></i></a>
						<a href="<?php echo base_url() ?>admin/client/delete/<?php echo  $list['img_id']; ?>" class="btn btn-danger btn-xs btnPadding" onClick="return doconfirm();"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php $count++;	}  ?>
			</tbody>
	    </table>
	  </div>
	</div>
</div>