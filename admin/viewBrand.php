<?php 
    $me       = new lsp();
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    $table    = "table_brand";
    $databrand  = $me->select($table);
    $autokode = $me->autokode($table,"kd_brand","ME");

    if (isset($_GET['delete'])) {
        $id       = $_GET['id'];
        $cek      = $me->selectCountWhere("table_fixtures","kd_fixture","kd_brand='$id'");
        // echo $cek['count'];
        if ($cek['count'] > 0) {
            $response = ['response'=>'negative','alert'=>'brand ini sudah di pakai di barang tidak dapat di hapus'];
        }else{
        $where    = "kd_brand";
        $response = $me->delete($table,$where,$id,"?page=viewBrand");
        }
    }

    if (isset($_POST['getSave'])) {
        $kode_brand = $me->validateHtml($_POST['kode_brand']);
        $brand      = $me->validateHtml($_POST['brand']);
        $foto = $_FILES['foto'];

        if ($kode_brand == "" || $brand == "") {
            $response = ['response'=>'negative','alert'=>'lengkapi field'];
        }else{
            $response = $me->validateImage();
            if ($response['types'] == "true") {
                $value    = "'$kode_brand','$brand','$response[image]'";
                $response = $me->insert($table,$value,"?page=viewBrand");
            }
            
        }
    }

    if (isset($_POST['getUpdate'])) {
        $kode_brand = $me->validateHtml($_POST['kode_brand']);
        $brand      = $me->validateHtml($_POST['brand']);

        if ($_FILES['foto']['name'] == "") {
             $value    = "kd_brand='$kode_brand',brand='$brand'";
             $response = $me->update($table,$value,"kd_brand",$_GET['id'],"?page=viewBrand");
        }else{
            $response = $me->validateImage();
            if ($response['types'] == "true") {
                $value = "kd_brand='$kode_brand',brand='$brand', foto_brand='$response[image]'";
                $response = $me->update($table,$value,"kd_brand",$_GET['id'],"?page=viewBrand");
            }else{
                $response = ['response'=>'negative','alert'=>'Error Gambar'];
            }
        }
    }

    if (isset($_GET['edit'])) {
        $editData = $me->selectWhere($table,"kd_brand",$_GET['id']);
    }
    
 ?>
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                       <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Data Brand</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: -60px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" >
                            <strong class="card-title mb-3">input brand</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">kode brand</label>
                                    <?php if(!isset($_GET['edit'])) : ?>
                                    <input type="text" class="form-control form-control-sm" name="kode_brand" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                    <?php endif ?>
                                    <?php if(isset($_GET['edit'])) : ?>
                                    <input type="text" class="form-control form-control-sm" name="kode_brand" style="font-weight: bold; color: red;" value="<?php echo @$editData['kd_brand']; ?>" readonly>
                                    <?php endif ?>

                                </div>
                                <div class="form-group">
                                    <label for="">Nama brand</label>
                                    <input type="text" class="form-control form-control-sm" name="brand" value="<?php echo @$editData['brand'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="foto" id="gambar" class="form-control-file">
                                    <div style="padding-bottom: 15px;">
                                        <img alt="" src="img/<?= @$editData['foto_brand'] ?>" width="120" class="img-responsive" id="pict">
                                    </div>
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewBrand" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])): ?>    
                                <button type="submit" name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                                <?php endif ?>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Brand</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                   <thead>
                                       <tr>
                                            <th>kode brand</th>
                                            <th>Nama</th>
                                            <th>Logo</th>
                                            <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($databrand as $ds){
                                         ?>
                                       <tr>
                                            <td><?= $ds['kd_brand'] ?></td>
                                            <td><?= $ds['brand'] ?></td>
                                            <td><img width="60" src="img/<?= $ds['foto_brand'] ?>" alt=""></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=viewBrand&edit&id=<?= $ds['kd_brand'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Delete" href="#" class="btn btn-danger"><i class="fa fa-trash" id="btnDelete<?php echo $no; ?>" ></i></a>
                                                </div>
                                            </td>
                                       </tr>
                                       <script src="vendor/jquery-3.2.1.min.js"></script>
                                       <script>
                                        $('#btnDelete<?php echo $no; ?>').click(function(e){
                                                      e.preventDefault();
                                                        swal({
                                                        title: "Hapus",
                                                        text: "Yakin Ingin menghapus?",
                                                        type: "error",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes",
                                                        cancelButtonText: "Cancel",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                      }, function(isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href="?page=viewBrand&delete&id=<?php echo $ds['kd_brand'] ?>";
                                                        }
                                                      });
                                                    });
                                        </script>
                                       <?php $no++; } ?>
                                   </tbody>
                               </table>
                           </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
