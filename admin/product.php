<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <!-- Modal -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProduct">
                <i class="bi bi-plus-lg"></i> Tambah Barang
            </button>
            <div class="modal fade" id="addProduct" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input id="nama_barang" type="text" class="form-control" name="nama_barang">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" cols="30" rows="2"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="stok">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="create">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <h4 class="fw-bold">List Barang</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Image</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT b.*, dp.id_barang 'dependensi' FROM barang b LEFT JOIN detail_penjualan dp ON b.id_barang = dp.id_barang";
                    $data = $mysqli->query($query);
                    foreach ($data as $key) { ?>
                        <tr>
                            <td class="col"><?php echo $key['id_barang'] ?></td>
                            <td class="col"><?php echo $key['nama_barang'] ?></td>
                            <td class="col-2"><img class="w-100" src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $key['id_barang'] ?>"></td>
                            <td class="col"><?php echo $key['deskripsi'] ?></td>
                            <td class="col">Rp.<?php echo $key['harga'] ?></td>
                            <td class="col"><?php echo $key['stok'] ?></td>
                            <td class="col">
                                <a href="<?php $_SERVER['PHP_SELF'] ?>?deleteid=<?php echo $key['id_barang'] ?>" class="btn btn-transparent text-danger border-0 <?php $key['dependensi'] > 0 && print "disabled"  ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <button class="btn btn-transparent text-primary border-0" data-bs-toggle="modal" data-bs-target="#editProduct<?php echo $key['id_barang'] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <div class="modal fade" id="editProduct<?php echo $key['id_barang'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                                        <input id="nama_barang" type="text" class="form-control" name="updateNama_barang" value="<?php echo $key['nama_barang'] ?>">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="image" class="form-label">Thumbnail</label>
                                                        <input type="file" class="form-control" name="updateImage">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="deskripsi" name="updateDeskripsi" cols="30" rows="2"><?php echo $key['deskripsi'] ?></textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="harga" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" name="updateHarga" value="<?php echo $key['harga'] ?>">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="stok" class="form-label">Stok</label>
                                                        <input type="number" class="form-control" name="updateStok" value="<?php echo $key['stok'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="updateIdBarang" value="<?php echo $key['id_barang'] ?>">
                                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
if (isset($_GET['deleteid'])) {
    $query = "DELETE FROM barang WHERE id_barang = {$_GET['deleteid']} ";
    $mysqli->query($query) or die($mysqli->error);
    echo "<script>window.location.assign('$address/admin/product.php')</script>";
}
if (isset($_POST['create'])) {
    $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $imgType = getimageSize($_FILES['image']['tmp_name']);
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $query = "INSERT INTO barang SET nama_barang = '$nama_barang', imageType = '{$imgType['mime']}', imageData = '$imgData', deskripsi = '$deskripsi', harga = $harga, stok = $stok";
    if ($mysqli->query($query) or die($mysqli->error)) { ?>
        <script>
            alert("Data berhasil ditambah");
            window.location.assign('<?php echo $address ?>/admin/product.php');
        </script>
    <?php }
}
if (isset($_POST['update'])) {
    $imgData = addslashes(file_get_contents($_FILES['updateImage']['tmp_name']));
    $imgType = getimageSize($_FILES['updateImage']['tmp_name']);
    $id_barang = $_POST['updateIdBarang'];
    $nama_barang = $_POST['updateNama_barang'];
    $deskripsi = $_POST['updateDeskripsi'];
    $harga = $_POST['updateHarga'];
    $stok = $_POST['updateStok'];
    $query = "UPDATE barang SET nama_barang = '$nama_barang', imageType = '{$imgType['mime']}', imageData = '$imgData', deskripsi = '$deskripsi', harga = $harga, stok = $stok WHERE id_barang = '$id_barang'";
    if ($mysqli->query($query) or die($mysqli->error)) { ?>
        <script>
            alert("Data berhasil diubah");
            window.location.assign('<?php echo $address ?>/admin/product.php');
        </script>
<?php }
} ?>

<?php
$mysqli->close();
include_once "../template/footer.php"; ?>