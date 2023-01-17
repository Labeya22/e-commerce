<?php

$title = "types";



$q = getQueryParamsString('q');

$search = getNResultatSearch($q);

$page = getQueryParamsInteger('page') ?? 1;
$types = getTypePagine(12, $page, $q);

?>


<!-- contact -->
<div class="container">
    <?= flash() ?>
    <div class="section">
        <div class="section-title">
            <h2>Types de voitures</h2>
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
        <?= resultats($types['data'], [
            "afficher tous les types",
            generate('admin.types')
        ], $q, $search) ?>
        <table class="table" id="table-responsive">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Date de création</th>
                    <th>
                        <a 
                            href="<?= generate('admin.type-create') ?>" 
                            class="button button-primary button-md">
                            <i class="fa fa-add"></i> 
                            nouveau
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types['data'] as $type): ?>
                <tr class="tr-<?= $type['type_id'] ?>">
                    <td><?= $type['type'] ?></td>
                    <td><?= dateFormat($type['create_at']) ?></td>
                    <td>
                        <a
                        id="delete-product"
                        href="<?= generate('admin.type-del', ['typeid' => $type['type_id']]) ?>" 
                        class="button button-md button-danger">
                            <i class="fa fa-minus"></i> 
                            supprimer
                        </a>
                        <a 
                        href="<?= generate('admin.type-update', ['typeid' => $type['type_id']]) ?>" 
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
            <?=  pagination($types['options']) ?>
        </div>
    </div>
</div>