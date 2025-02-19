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
                <th>Statut</th>
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
                        >
                            <input onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));" type="submit" value="Supprimer">
                        </form>
                    </td>
                    <td>                        
                        <form 
                        action="<?= dirname(
                            SCRIPTS
                        ) ?>/admin/posts/status/update ?>" 
                        method="post"                        
                        >
                            <select name="status">
                                <?php foreach ($params['status'] as $status): ?>
                                    <option  value="<?= $status; ?>" <?= ($post->getArt_statut() === $status) ? 'selected' : ''; ?>>
                                        <?= ucfirst($status); ?>                                    
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id" value="<?= $post->getId() ?>">                            
                            <input onclick="return(confirm('Etes-vous sûr de vouloir modifier le statut?'));" type="submit" value="Modifier le statut">
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