<?php

$title = "types";


$page = getQueryParamsInteger('page') ?? 1;
$types = getTypePagine(12, $page);

?>


<!-- contact -->
<div class="container">
    <div class="section">
        <div class="section-title">
            <h2>Types de voitures</h2>
        </div>
        <table class="table" id="table-responsive">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Date de création</th>
                    <th>Option</th>
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
                        href="" 
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