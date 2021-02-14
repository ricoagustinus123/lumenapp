<?php 
    $br = new lsp();
    if ($_SESSION['level'] != "Marketing") {
    header("location:../index.php");
    }
    $table = "table_events";    
    $getbrand = $br->select("table_brand");
    $getDistr = $br->select("table_marketing");
    $autokode = $br->autokode("table_events","id_event","EV");
    $waktu    = date("Y-m-d");
    if (isset($_POST['getSimpan'])) {
        $id_event             = $br->validateHtml($_POST['id_event']);
        $events         = $br->validateHtml($_POST['events']);
        $brand   = $br->validateHtml($_POST['brand']);
        $tanggal_mulai  = $br->validateHtml($_POST['tanggal_mulai']);
        $tanggal_akhir  = $br->validateHtml($_POST['tanggal_akhir']);
       

        if ($id_event == " " || $events == " " || $brand == " " || $tanggal_mulai == " " || $tanggal_akhir == " " ) {
            $response = ['response'=>'negative','alert'=>'lengkapi field'];
        }else{
                    $value = "'$id_event','$events','$brand','$tanggal_mulai','$tanggal_akhir'";

                    $response = $br->insert($table,$value,"?page=viewEvents");
                
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="">kode Events</label>
                                    <input type="text" style="font-weight: bold; color: red;" class="form-control" name="id_event" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">nama events</label>
                                    <input type="text" placeholder="nama events" class="form-control" name="events" value="<?php echo @$_POST['events'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">brands</label>
                                    <select name="brand" class="form-control">
                                        <option value=" ">Pilih brand</option>
                                        <?php foreach($getbrand as $mr) { ?>
                                        <option><?= $mr['brand'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="">tanggal mulai</label>
                                    <input type="date" class="form-control" name="tanggal_mulai">
                                </div>
                                <div class="form-group">
                                    <label for="">tanggal akhir</label>
                                    <input type="date" class="form-control" name="tanggal_akhir">
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
