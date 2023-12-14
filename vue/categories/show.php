<?php $title = 'Catégorie des articles'; ?>
<?php $description =
    'Découvrez les catégories disponible pour trouver les informations utiles'; ?>
<div class="top_article">
    <?php if (!empty($params['category'])): ?>
        <?php foreach ($params['category'] as $key => $value): ?>
            <h1>Catégorie : <?= $value->getTitle() ?> </h1>
            <div class="banniere_bouton">
                <?php if (
                    isset($_SESSION['statut']) &&
                    $_SESSION['statut'] === 1
                ): ?>
                    <div class="bouton_commande updateBtn"><a href="<?= dirname(
                        SCRIPTS
                    ) .
                        '/admin/categories/edit/' .
                        $value->getId() ?>">Modifier</a></div>
                    <form method="POST" action="<?= dirname(SCRIPTS) .
                        '/admin/categories/delete/' .
                        $value->getId() ?>" 
                        class="bouton_commande" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">
                        <input type="submit" value="Supprimer" name="delete">
                    </form>
                <?php endif; ?>
            </div>
            <p><span class="information">Ecrit par</span>
                <span class="mark"><?= isset($user)
                    ? $user->showNameAuthor($value->getCat_author())
                    : '' ?></span>
                le <em><?= $value->getDate_creation() ?></em>
            </p>

            <div class="justify_article">
                <a class="grand_image" href="<?= SCRIPTS .
                    'img' .
                    DIRECTORY_SEPARATOR .
                    'uploads' .
                    DIRECTORY_SEPARATOR .
                    $value->getCategory_image() ?>">

                    <img src="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR .
                        'uploads' .
                        DIRECTORY_SEPARATOR .
                        $value->getCategory_image() ?>" alt="Image de la catégorie" title="Cliquez pour agrandir"></a>
                <span>
                    <h3><?= $value->getDescription() ?></h3>
                </span>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php if ($this->isConnected() && $_SESSION['statut'] === 1): ?>
    <h3>Modifier cette catégorie</h3>
    <form action="?action=categoryForm" method="post" class="form-create" enctype="multipart/form-data">
        <fieldset>
            <legend>Introduisez vos informations</legend>
            <div class="form-create">
                <label for="">Titre de la catégorie
                    <input type="hidden" name="id" value="<?= $value->getId() ?>">

                    <p><input type="text" required name="title" value="<?= $value->getTitle() ?>"></p>
                </label>
            </div>
            <div class="form-create">
                <label for="">Description de la catégorie
                    <p>
                        <textarea 
                        required name="description" 
                        placeholder="Description de la catégorie" 
                        rows="5" cols="33"><?= $value->getDescription() ?></textarea>
                    </p>
                </label>
            </div>
            <div class="form-create">
                <label class="form-create" for="image_cat">Choisir une image</label>
                <p>
                    <input 
                    type="file" 
                    name="category_image" 
                    class="image" 
                    id="image_cat" 
                    accept='.gif, .png , .jpg' 
                    required>
                </p>
            </div>
            <p><input type="hidden" name="cat_author" value="<?= htmlspecialchars(
                $_SESSION['id_user']
            ) ?>"></p>
            <div class="form-create">
                <p><input type="submit" value="Envoyer" name="updateCategory"></p>
                <p><input type="reset" value="Annuler" /></p>
            </div>
        </fieldset>
    </form>
<?php endif; ?>
<div class="back-page">
    <a href="<?= dirname(SCRIPTS) ?>">Retour à la page d'accueil</a>
    <a href="<?= dirname(SCRIPTS) .
        DIRECTORY_SEPARATOR .
        'category' .
        DIRECTORY_SEPARATOR .
        $value->getId() .
        DIRECTORY_SEPARATOR .
        'posts' ?>" class="bouton_rouge">Consulter
        les articles de cette catégorie
        <img src="<?= SCRIPTS .
            'img' .
            DIRECTORY_SEPARATOR .
            'by_default' .
            DIRECTORY_SEPARATOR .
            'flecheblanchedroite.png' ?>" alt="le bouton rouge" />
    </a>
</div>