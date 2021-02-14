<?php 
    $dis = new lsp();
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    $table = "table_marketing";
    $dataDis = $dis->select($table);
    $autokode = $dis->autokode($table,"kd_marketing","MG");

    if (isset($_GET['delete'])) {
        $where = "kd_marketing";
        $whereValues = $_GET['id'];
        $redirect = "?page=viewMarketing";
        $response = $dis->delete($table,$where,$whereValues,$redirect);
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['id'];
        $editData = $dis->selectWhere($table,"kd_marketing",$id);
        $autokode = $editData['kd_marketing'];
    }
    if (isset($_POST['getSave'])) {
        $kd_marketing   = $dis->validateHtml($_POST['kode_distributor']);
        $nama_marketing = $dis->validateHtml($_POST['nama_marketing']);
        $username         = $dis->validateHtml($_POST['username']);
        $password         = $dis->validateHtml($_POST['password']);
        $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
        $alamat           = $dis->validateHtml($_POST['alamat']);
        $level            = $dis->validateHtml($_POST['level']);

        if ($kd_marketing == " " || empty($kd_marketing) || $nama_marketing == " " || empty($nama_marketing) || $username == " " || empty($username) || $password == " " || empty($password) || $nohp_distributor == " " || empty($nohp_distributor) || $alamat == " " || empty($alamat) || $level == " " || empty($level)) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
            $validno = substr($nohp_distributor, 0,2);
            if ($validno != "08") {
                $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
            }else{
                if (strlen($nohp_distributor) < 11) {
                    $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
                }else{
                    $value = "'$kd_marketing','$nama_marketing','$alamat','$nohp_distributor','$password','$level','$username'";
                    $response = $dis->insert($table,$value,"?page=viewMarketing");
                }
            }
        }
    }

    if (isset($_POST['getUpdate'])) {
        $kd_marketing   = $dis->validateHtml($_POST['kode_distributor']);
        $nama_marketing = $dis->validateHtml($_POST['nama_marketing']);
        $username         = $dis->validateHtml($_POST['username']);
        $password         = $dis->validateHtml($_POST['password']);
        $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
        $alamat           = $dis->validateHtml($_POST['alamat']);
        $level            = $dis->validateHtml($_POST['level']);

        if ($kd_marketing == " " || empty($kd_marketing) || $nama_marketing == " " || empty($nama_marketing) || $username == " " || empty($username) || $password == " " || empty($password) || $nohp_distributor == " " || empty($nohp_distributor) || $alamat == " " || empty($alamat) || $level == " " || empty($level)) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
            $validno = substr($nohp_distributor, 0,2);
            if ($validno != "08") {
                $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
            }else{
                if (strlen($nohp_distributor) < 11) {
                    $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
                }else{
                    $value = "kd_marketing='$kd_marketing',nama_marketing='$nama_marketing',username='$username',password='$password',no_telp='$nohp_distributor',alamat='$alamat',level='$level'";
                    $response = $dis->update($table,$value,"kd_marketing",$_GET['id'],"?page=viewMarketing");
                }
            }
        }
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
                                <li class="list-inline-item">Data Marketing</li>
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
                            <strong class="card-title mb-3">Input Marketing</strong>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Kode Marketing</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_distributor" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama marketing</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_marketing" value="<?php echo @$editData['nama_marketing'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control form-control-sm" name="username" value="<?php echo @$editData['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control form-control-sm" name="password" value="<?php echo @$editData['password'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nohp marketingr</label>
                                    <input type="text" class="form-control form-control-sm" name="nohp_distributor" value="<?php echo @$editData['no_telp']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" rows="5" class="form-control"><?php echo @$editData['alamat'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">level</label>
                                   <input type="text" class="form-control form-control-sm" name="level" id="level" value="<?php echo @$editData['level']; ?>">
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewMarketing" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])): ?>    
                                <button type="submit" name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Marketing</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                   <thead>
                                       <tr>
                                            <th>Kode marketing</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Nohp</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($dataDis as $ds){
                                         ?>
                                       <tr>
                                            <td><?= $ds['kd_marketing'] ?></td>
                                            <td><?= $ds['nama_marketing'] ?></td>
                                            <td><?= $ds['username'] ?></td>
                                            <td><?= $ds['password'] ?></td>
                                            <td><?= $ds['no_telp'] ?></td>
                                            <td><?= $ds['alamat'] ?></td>
                                            <td><?= $ds['level'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=viewMarketing&edit&id=<?= $ds['kd_marketing'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
                                                            window.location.href="?page=viewMarketing&delete&id=<?php echo $ds['kd_marketing'] ?>";
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