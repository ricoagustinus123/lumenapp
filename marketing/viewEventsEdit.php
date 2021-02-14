<?php 
	$br = new lsp();
	if ($_SESSION['level'] != "Marketing") {
    header("location:../index.php");
  	}
	$table    = "table_events";
	$data     = $br->selectWhere($table,"id_event",$_GET['id']);
	$getbrand = $br->select("table_brand");
	$getDistr = $br->select("table_marketing");
	$waktu    = date("Y-m-d");
	if (isset($_POST['getSimpan'])) {
        $id_event       = $br->validateHtml($_POST['id_event']);
        $events         = $br->validateHtml($_POST['events']);
        $brand    = $br->validateHtml($_POST['brand']);
        $tanggal_mulai  = $br->validateHtml($_POST['tanggal_mulai']);
        $tanggal_akhir  = $br->validateHtml($_POST['tanggal_akhir']);
		

		if ($id_event == " " || $events == " " || $brand == " " || $tanggal_mulai == " " || $tanggal_akhir == " " ) {
			$response = ['response'=>'negative','alert'=>'lengkapi field'];
		}else{
					
			$value = "id_event='$id_event',events='$events',brand='$brand',tanggal_mulai='$tanggal_mulai',tanggal_akhir='$tanggal_akhir'";
			$response = $br->update($table,$value,"id_event",$_GET['id'],"?page=viewEvents");
					
		
					
				
			} 
    }
	
 ?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<form method="post" enctype="multipart/form-data">
            			<div class="card">
            				<div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
	                            <div class="bg-overlay bg-overlay--blue"></div>
	                            <h3>
	                            <i class="zmdi zmdi-account-calendar"></i>Data Events</h3>
                        	</div>
                        	<div class="card-body">
                        		<div class="col-12">
                        			<div class="row">
                        				<div class="col-md-6">
                        					<div class="form-group">
												<label for="">Kode events</label>
												<input type="text" class="form-control" name="id_event" value="<?php echo $data['id_event']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="">Nama Events</label>
												<input type="text" class="form-control" name="events" value="<?php echo @$data['events'] ?>">
											</div>
											<div class="form-group">
												<label for="">Brand</label>
												<select name="brand" class="form-control">
													<option value=" ">Pilih brand</option>
													<?php foreach($getbrand as $mr) { ?>
													<?php if ($mr['brand'] == $data['brand']){ ?>
														<option value="<?= $mr['brand'] ?>" selected><?= $mr['brand'] ?></option>
													<?php }else{ ?>
													<option value="<?= $mr['brand'] ?>"><?= $mr['brand'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">tanggal mulai</label>
												<input type="date" class="form-control" name="tanggal_mulai" value="<?php echo $data['tanggal_mulai'] ?>">
											</div>
											<div class="form-group">
												<label for="">tanggal akhir</label>
												<input type="date" class="form-control" name="tanggal_akhir" value="<?php echo $data['tanggal_akhir'] ?>">
											</div>
											
											</div>
										</div>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="card-footer">
                        		<button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
                        		<a href="?page=viewEvents" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
                        	</div>
            			</div>
            		</form>
            	</div>
            </div>
        </div>
    </div>
</div>