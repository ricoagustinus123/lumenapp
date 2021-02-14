<?php 
	$br = new lsp();
	if ($_SESSION['level'] != "Marketing") {
    header("location:../index.php");
  	}
	$table    = "table_fixtures";
	$data     = $br->selectWhere($table,"kd_fixture",$_GET['id']);
	$getbrand = $br->select("table_brand");
	$getDistr = $br->select("table_marketing");  
	if (isset($_POST['getSimpan'])) {
		$kd_fixture  = $br->validateHtml($_POST['kd_fixture']);
		$nama_fixture  = $br->validateHtml($_POST['nama_fixture']);
		$brand = $br->validateHtml($_POST['brand']);
		$nama_marketing  = $br->validateHtml($_POST['nama_marketing']);
		$stok         = $br->validateHtml($_POST['stok']);
		$keterangan          = $_POST['keterangan'];

		if ($kd_fixture == " " || $nama_fixture == " " || $brand == " " || $nama_marketing == " " || $stok == " " || $keterangan == " " ) {
			$response = ['response'=>'negative','alert'=>'lengkapi field'];
		}else{
			$value = "nama_fixture='$nama_fixture',brand='$brand',nama_marketing='$nama_marketing',stok='$stok',keterangan='$keterangan'";
			$response = $br->update($table,$value,"kd_fixture",$_GET['id'],"?page=viewFixtures");
				
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
	                            <i class="zmdi zmdi-account-calendar"></i>Data Fixtures</h3>
                        	</div>
                        	<div class="card-body">
                        		<div class="col-12">
                        			<div class="row">
                        				<div class="col-md-6">
                        					<div class="form-group">
												<label for="">Kode barang</label>
												<input type="text" class="form-control" name="kd_fixture" value="<?php echo $data['kd_fixture']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="">Nama barang</label>
												<input type="text" class="form-control" name="nama_fixture" value="<?php echo @$data['nama_fixture'] ?>">
											</div>
											<div class="form-group">
												<label for="">brand</label>
												<select name="brand" class="form-control">
													<?php foreach($getbrand as $mr) { ?>
													<?php if ($mr['brand'] == $data['brand']){ ?>
														<option value="<?= $mr['brand'] ?>" selected><?= $mr['brand'] ?></option>
													<?php }else{ ?>
													<option value="<?= $mr['brand'] ?>"><?= $mr['brand'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Distributor</label>
												<select name="nama_marketing" class="form-control">
													<?php foreach($getDistr as $dr) { ?>
													<?php if ($dr['nama_marketing'] == $data['nama_marketing']){ ?>
													<option value="<?= $dr['nama_marketing'] ?>" selected><?= $dr['nama_marketing'] ?></option>
													<?php }else{ ?>
													<option value="<?= $dr['nama_marketing'] ?>"><?= $dr['nama_marketing'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Stok barang</label>
												<input type="number" class="form-control" name="stok" value="<?php echo $data['stok'] ?>">
											</div>
											<div class="form-group">
												<label for="">Keterangan</label>
												<input type="text" class="form-control" name="keterangan" value="<?php echo $data['keterangan'] ?>">
											</div>
											
										</div>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="card-footer">
                        		<button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
                        		<a href="?page=viewFixtures" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
                        	</div>
            			</div>
            		</form>
            	</div>
            </div>
        </div>
    </div>
</div>