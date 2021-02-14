<?php 
    $qb = new lsp();
    $dataB = $qb->select("detailfixtures");
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    if (isset($_GET['delete'])) {
        $response = $qb->delete("table_fixtures","kd_fixture",$_GET['id'],"?page=viewFixtures");
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
                                <li class="list-inline-item">Data Fixtures</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                            <div class="bg-overlay bg-overlay--blue"></div>
                            <h3>
                            <i class="zmdi zmdi-account-calendar"></i>Data Fixtures</h3>
                        </div>
                        <div class="card-body">
                            <a href="?page=addFixtures" class="btn btn-primary"><i class="fa fa-plus"></i> tambah fixtures</a>
                           </button>
                           <br>
                           <br>
                           <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>kode Fixtures</th>
                                            <th>id event</th>
                                            <th>nama fixtures</th>
                                            <th>brand</th>
                                            <th>kd_Marketing</th></th>
                                            <th>Tanggal Masuk</th>
                                            <th>Stok</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($dataB as $ds) { 
                                         ?>
                                        <tr>
                                            <td><?= $ds['kd_fixture'] ?></td>
                                            <td><?= $ds['id_event'] ?></td>
                                            <td><?= $ds['nama_fixture'] ?></td>
                                            <td><?= $ds['brand'] ?></td>
                                            <td><?= $ds['nama_marketing'] ?></td>
                                            <td><?= $ds['tanggal_masuk'] ?></td>
                                            <td><?= $ds['stok'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="?page=viewFixturesEdit&edit&id=<?= $ds['kd_fixture'] ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger">
                                                        <i class="fa fa-trash" id="btdelete<?php echo $no; ?>" ></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <script src="vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $('#btdelete<?php echo $no; ?>').click(function(e){
                                                  e.preventDefault();
                                                    swal({
                                                    title: "Hapus",
                                                    text: "Yakin Hapus?",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Yes",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                  }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href="?page=viewFixtures&delete&id=<?php echo $ds['kd_fixture'] ?>";
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
