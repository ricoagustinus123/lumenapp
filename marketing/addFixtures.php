<?php 
    $br = new lsp();
    if ($_SESSION['level'] != "Marketing") {
    header("location:../index.php");
    }
    $table        = "table_fixtures";    
    $getbrand     = $br->select("table_brand");
    $getMarketing = $br->select("table_marketing");
    $getEvent     = $br->select("table_events");
    $autokode     = $br->autokode("table_fixtures","kd_fixture","FX");
   
    if (isset($_POST['getSimpan'])) {
        $kd_fixture     = $br->validateHtml($_POST['kd_fixture']);
        $id_event       = $br->validateHtml($_POST['id_event']);   
        $nama_fixture   = $br->validateHtml($_POST['nama_fixture']);
        $brand          = $br->validateHtml($_POST['brand']);
        $nama_marketing = $br->validateHtml($_POST['nama_marketing']);
        $stok           = $br->validateHtml($_POST['stok']);
        $tanggal_masuk  = $br->validateHtml($_POST['tanggal_masuk']);
        
        $keterangan     = $_POST['keterangan'];

        if ($kd_fixture == " " || $id_event == " " || $nama_fixture == " " || $brand == " " || $nama_marketing == " " || $stok == " " || $tanggal_masuk == " " || $keterangan == " " ) {
            $response = ['response'=>'negative','alert'=>'lengkapi field'];
        }else{
              
                    $value = "'$kd_fixture','$nama_fixture','$brand','$nama_marketing','$tanggal_masuk','$stok','$keterangan','$id_event'";

                    $response = $br->insert($table,$value,"?page=viewFixtures");
                
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
                            <i class="zmdi zmdi-account-calendar"></i>Data Barang</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="">kode Fixtures</label>
                                    <input type="text" style="font-weight: bold; color: red;" class="form-control" name="kd_fixture" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">nama fixtures</label>
                                    <input type="text" placeholder="nama fixtures" class="form-control" name="nama_fixture" value="<?php echo @$_POST['nama_fixture'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">brand</label>
                                    <select name="brand" class="form-control">
                                        <option value=" ">Pilih brand</option>
                                        <?php foreach($getbrand as $mr) { ?>
                                        <option value="<?= $mr['brand'] ?>"><?= $mr['brand'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">events</label>
                                    <select name="id_event" class="form-control">
                                        <option value=" ">Pilih events</option>
                                        <?php foreach($getEvent as $mr) { ?>
                                        <option value="<?= $mr['id_event'] ?>"><?= $mr['events'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Marketing</label>
                                    <select name="nama_marketing" class="form-control">
                                        <option value=" ">Pilih nama marketing</option>
                                        <?php foreach($getMarketing as $dr) { ?>
                                        <option value="<?= $dr['nama_marketing'] ?>"><?= $dr['nama_marketing'] ?></option>
                                        <?php     } ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    
                                <div class="form-group">
                                    <label for="">Stok barang</label>
                                    <input type="number" class="form-control" name="stok">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk">
                                </div>
                            
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
