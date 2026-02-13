<div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <a href="/objet/create" class="btn btn-primary mb-4">Add Object</a>
            <?php if (!isset($objects) || empty($objects)): ?>
                <div class="col-12">
                    <p class="text-muted text-center">No object</p>
                </div>
            <?php else: ?>
                <?php foreach ($objects as $object): ?>
                <div class="col-lg-3 col-md-4">
                    <div class="bg-light p-4 mb-30">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3"><?= htmlspecialchars($object['titre']) ?></span></h5>
                        <p><?= htmlspecialchars($object['description']) ?></p>
                        <p>Prix: <?= htmlspecialchars($object['prix_estimatif']) ?>€</p>
                        
                        <div class="d-flex gap-2 mt-3">
                            <a href="/objet/edit/<?= htmlspecialchars($object['id_objet']) ?>" class="btn btn-sm btn-primary flex-fill">
                                <i class="fa fa-edit mr-1"></i>Update
                            </a>
                            <form method="POST" action="/objet/delete" style="display:inline; flex: 1;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($object['id_objet']) ?>">
                                <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet objet ?')">
                                    <i class="fa fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>