<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Categories</th>
                            <th>Description</th>
                            <th>Update</th>
                            <th>Remove</th>
                            <th>Date Creation</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php foreach ($categories as $category): ?>
                        <tr>
                            <td class="align-middle"><img src="/assets/img/product-1.jpg" alt="" style="width: 50px;"> <?php echo $category['nom_categorie']; ?></td>
                            <td class="align-middle"><?php echo $category['description_categorie']; ?></td>
                            <td class="align-middle">
                                <!-- <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div> -->
                                <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                            </td>
                            <td class="align-middle">
                                <form method="POST" action="/admin/categories/delete" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($category['id_categorie']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle"><?php echo $category['date_creation']; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$160</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
