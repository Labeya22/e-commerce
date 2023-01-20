<?php

$title = "utilisateurs";

$q = getQueryParamsString('q');

$search = getNResultatSearchUsers($q);

$page = getQueryParamsInteger('page') ?? 1;
$users = getUsersPagine(12, $page, $q);

?>


<!-- contact -->
<div class="container">
    <?= flash() ?>
    <div class="section">
        <div class="section-title">
            <h2>Utilisateurs</h2>
        </div>
 
        <form class="form w-60 mb-4" action="" method="get">
            <div class="group-form">
                <?= inputField('q', [
                    'class' => 'input-form',
                    'placeholder' => "rechercher un utilisateur",
                    'type' => 'text'
                ], $_GET) ?>
                <button class="button button-md button-primary"><i class="fa fa-search"></i> recherche</button>
            </div>
        </form>
        <?= resultats($users['data'], [
            "afficher tous les utilisateurs",
            generate('admin.users')
        ], $q, $search) ?>
        <table class="table" id="table-responsive">
            <thead>
                <tr>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>nom d'utilisateur</th>
                    <th>email</th>
                    <th>role</th>
                    <th>date de création</th>
                    <th>
                        <a 
                            href="<?= generate('admin.user-create') ?>" 
                            class="button button-primary button-md">
                            <i class="fa fa-add"></i> 
                            nouveau
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users['data'] as $user): ?>
                <tr class="tr-<?= $user['utilisateur_id'] ?>">
                    <td><?= $user['nom'] ?></td>
                    <td><?= $user['prenom'] ?></td>
                    <td><?= $user['utilisateur'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= dateFormat($user['create_at']) ?></td>
                    <td>
                        <a
                        id="delete-product"
                        href="<?= generate('admin.user-del', ['userid' => $user['utilisateur_id']]) ?>" 
                        class="button button-md button-danger">
                            <i class="fa fa-minus"></i> 
                            supprimer
                        </a>
                        <a 
                        href="<?= generate('admin.user-update', ['userid' => $user['utilisateur_id']]) ?>" 
                        class="button button-md button-dark">
                            <i class="fa fa-edit"></i> 
                            editer
                        </a>
                        <a 
                        href="<?= generate('admin.user-eye', ['id' => $user['utilisateur_id']]) ?>" 
                        class="button button-md button-light">
                            <i class="fa fa-eye"></i> 
                            détails
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="pagination">
            <?=  pagination($users['options']) ?>
        </div>
    </div>
</div>