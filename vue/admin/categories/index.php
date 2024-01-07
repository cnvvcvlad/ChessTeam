<?php $title = 'Administration des articles'; ?>
<?php $description = 'Page de l\'administrateur'; ?>
<div class="container">
    <h1>Administration des catégories</h1>
    <div class="justify_article">
        <a href="<?= dirname(
                        SCRIPTS
                    ) ?>/admin/categories/create" class="">Créer une nouvelle catégorie</a>
    </div>
    <table id="posts" class="posts">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Publié le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['categories'] as $category) : ?>
                <tr>
                    <th><?= $category->getId() ?></th>
                    <td><a href="<?= dirname(
                                        SCRIPTS
                                    ) ?>/categories/<?= $category->getId() ?>"><?= $category->getTitle() ?></a></td>
                    <td><?= $category->getDate_creation() ?></td>
                    <td>
                        <div class="justify_article">
                            <a class="" href="<?= dirname(
                                                    SCRIPTS
                                                ) ?>/admin/categories/edit/<?= $category->getId() ?>">Modifier</a>
                        </div>
                        <form action="<?= dirname(
                                            SCRIPTS
                                        ) ?>/admin/categories/delete/<?= $category->getId() ?>" method="post" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">
                            <input type="submit" value="Supprimer">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="back-page">
        <?= isset($_SERVER['HTTP_REFERER'])
            ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
            : '' ?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>
</div>