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
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Tambah</button>
                        </div>
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
                    <tr>
                        <td class="col">1</td>
                        <td class="col">Judul</td>
                        <td class="col-2"><img class="w-100" src="../assets/static_images/dummy.png"></td>
                        <td class="col">Desc</td>
                        <td class="col">Rp.450.000</td>
                        <td class="col">12</td>
                        <td class="col">
                            <button class="btn btn-transparent text-danger border-0">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-transparent text-primary border-0" data-bs-toggle="modal" data-bs-target="#editProduct">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <div class="modal fade" id="editProduct" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="form-group mb-3">
                                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                                    <input id="nama_barang" type="text" class="form-control" name="nama_barang" value="Title">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="image" class="form-label">Thumbnail</label>
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" cols="30" rows="2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, et soluta. Laborum distinctio consequuntur mollitia molestiae aut animi architecto dolores dolore ipsam, aliquam facilis earum dolorem, ab, quos voluptate sunt?</textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <input type="number" class="form-control" name="harga" value="5000">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="stok" class="form-label">Stok</label>
                                                    <input type="number" class="form-control" name="stok" value="5">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include_once "../template/footer.php"  ?>