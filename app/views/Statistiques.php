<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col">
            <div class="stat-card bg-light d-flex align-items-center justify-content-between mb-4" style="height: 100px;">
                <div class="card-body">
                    <p class="text-uppercase mb-1">Nombres totales des utilisateurs</p>
                    <h4 class="mb-0"><?php echo $totaluser ?></h4>
                </div>
                <i class="fa fa-users fa-3x text-primary"></i>
            </div>
        </div>
        <div class="col-lg-12 table-responsive mb-5">
        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="align-middle"><?php echo $user['nom']; ?></td>
                    <td class="align-middle"><?php echo $user['email']; ?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        </div>
    </div>
</div>