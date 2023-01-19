<?php

$title = 'vehicules';



$q = getQueryParamsString('q');

$search = getResultatSearchVehicules($q);

$page = getQueryParamsInteger('page') ?? 1;
$vehicules = getVehiculePaginer($page, 12, $q);

?>



<!-- contact -->
<div class="container">
    <?= flash() ?>
    <div class="section">
        <div class="section-title">
            <h2>Vehicules</h2>
        </div>
 
        <form class="form w-60 mb-4" action="" method="get">
            <div class="group-form">
                <?= inputField('q', [
                    'class' => 'input-form',
                    'placeholder' => "rechercher le type du vehicule",
                    'type' => 'text'
                ], $_GET) ?>
                <button class="button button-md button-primary"><i class="fa fa-search"></i> recherche</button>
            </div>
        </form>
        <?= resultats($vehicules['data'], [
            "afficher tous les vehicules",
            generate('admin.vehicules')
        ], $q, $search) ?>
        <table class="table" id="table-responsive">
            <thead>
                <tr>
                    <th>voiture</th>
                    <th>marque</th>
                    <th>type</th>
                    <th>prix</th>
                    <th>ajouté le</th>
                    <th>
                        <a 
                            href="<?= generate('admin.vehicule-create') ?>" 
                            class="button button-primary button-md">
                            <i class="fa fa-add"></i> 
                            nouveau
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicules['data'] as $vehicule): ?>
                <tr class="tr-<?= $vehicule['vehicule_id'] ?>">
                    <td><?= $vehicule['vehicule'] ?></td>
                    <td><?= $vehicule['marque'] ?></td>
                    <td><?= $vehicule['type'] ?></td>
                    <td><?= $vehicule['prix'] ?></td>
                    <td><?= dateFormat($vehicule['create_at']) ?></td>
                    <td>
                        <a
                        id="delete-product"
                        href="<?= generate('admin.vehicule-del', ['vehiculeid' => $vehicule['vehicule_id']]) ?>" 
                        class="button button-md button-danger">
                            <i class="fa fa-minus"></i> 
                        </a>
                        <a 
                        href="<?= generate('admin.vehicule-eye', ['vehiculeid' => $vehicule['vehicule_id']]) ?>" 
                        class="button button-md button-dark">
                            <i class="fa fa-edit"></i> 
                        </a>
                        <a 
                        href="<?= generate('admin.vehicule-eye', ['vehiculeid' => $vehicule['vehicule_id']]) ?>" 
                        class="button button-md button-light">
                            <i class="fa fa-eye"></i> 
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>


        <div class="pagination">
            <?=  pagination($vehicules['options']) ?>
        </div>
    </div>
</div>