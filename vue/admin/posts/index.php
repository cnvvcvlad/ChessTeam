<?php $title = 'Administration des articles'; ?>
<?php $description = 'Page de l\'administrateur'; ?>
<div class="container">  
    <h1>Administration des articles</h1>
    <div class="justify_article">
        <a href="<?= dirname(
            SCRIPTS
        ) ?>/admin/posts/create" class="">Créer un nouvel article</a>
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
            <?php foreach ($params['posts'] as $post): ?>
                <tr>
                    <th><?= $post->getId() ?></th>
                    <td><a href="<?= dirname(
                        SCRIPTS
                    ) ?>/posts/<?= $post->getId() ?>"><?= $post->getArt_title() ?></a></td>
                    <td><?= $post->getDate_creation() ?></td>
                    <td>
                        <div class="justify_article">
                            <a class="" href="<?= dirname(
                                SCRIPTS
                            ) ?>/admin/posts/edit/<?= $post->getId() ?>">Modifier</a>
                        </div>
                        <form 
                        action="<?= dirname(
                            SCRIPTS
                        ) ?>/admin/posts/delete/<?= $post->getId() ?>" 
                        method="post"
                        onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">
                            <input type="submit" value="Supprimer">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="back-page">
    <?php
// substr($_SERVER['HTTP_REFERER'], 0)
?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>
</div>