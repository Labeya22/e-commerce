<?php

$title = "marques";

$q = getQueryParamsString('q');

$search = getResultatSearchMarque($q);

$page = getQueryParamsInteger('page') ?? 1;
$marques = getMarquePagine(12, $page, $q);

?>


<!-- contact -->
<div class="container">
    <?= flash() ?>
    <div class="section">
        <div class="section-title">
            <h2>marques des voitures</h2>
        </div>
 
        <form class="form w-60 mb-4" action="" method="get">
            <div class="group-form">
                <?= inputField('q', [
                    'class' => 'input-form',
                    'placeholder' => "rechercher la marque d'un vehicule",
                    'type' => 'text'
                ], $_GET) ?>
                <button class="button button-md button-primary"><i class="fa fa-search"></i> recherche</button>
            </div>
        </form>
        <?= resultats($marques['data'], [
            "afficher tous les marques",
            generate('admin.marques')
        ], $q, $search) ?>
        <table class="table" id="table-responsive">
            <thead>
                <tr>
                    <th>marque</th>
                    <th>date de création</th>
                    <th>
                        <a 
                            href="<?= generate('admin.marque-create') ?>" 
                            class="button button-primary button-md">
                            <i class="fa fa-add"></i> 
                            nouveau
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marques['data'] as $marque): ?>
                <tr class="tr-<?= $marque['marque_id'] ?>">
                    <td><?= $marque['marque'] ?></td>
                    <td><?= dateFormat($marque['create_at']) ?></td>
                    <td>
                        <a
                        id="delete-product"
                        href="<?= generate('admin.marque-del', ['marqueid' => $marque['marque_id']]) ?>" 
                        class="button button-md button-danger">
                            <i class="fa fa-minus"></i> 
                            supprimer
                        </a>
                        <a 
                        href="<?= generate('admin.marque-update', ['marqueid' => $marque['marque_id']]) ?>" 
                        class="button button-md button-dark">
                            <i class="fa fa-edit"></i> 
                            editer
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>


        <div class="pagination">
            <?=  pagination($marques['options']) ?>
        </div>
    </div>
</div>