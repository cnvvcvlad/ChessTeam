<?php ob_start(); ?>
<?php $title = 'Créez un article sur ChessTeam'; ?>
<?php $description =
    'Tous les membres connectés peuvent ajouter des articles de blog et des commentaires'; ?>

<?php if (isConnected()): ?>
    <h1>Créez un article !</h1>
    <form action="src/controller/controllerFrontEnd.php" method="post" class="form-create" enctype="multipart/form-data">
        <fieldset>
            <legend>Introduisez vos informations</legend>
            <div class="form-create">
                <?php if (isset($allCategory)): ?>
                <label for="category">Catégorie de l'article
                    <p><select required class="form-inscription" name="category">
                            <option value="">--Choisir une Catégorie--</option>
                            <?php foreach ($allCategory as $key => $value): ?>
                                <option value="<?= $value->getId() ?>"><?= $value->getTitle() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <?php endif; ?>
            </div>
            <div class="form-create">
                <label for="art_title">Titre de l'article
                    <p><input type="text" required name="art_title" value="" placeholder="Titre de l'article"></p>
                </label>
            </div>
            <div class="form-create">
                <label for="art_description">Description de l'article
                    <p><textarea name="art_description" required placeholder="Description de l'article" rows="5"
                                 cols="33"></textarea></p>
                </label>
            </div>
            <div class="form-create">
                <label for="art_content">Contenu de l'article
                    <p><textarea name="art_content" required placeholder="Contenu de l'article" rows="10"
                                 cols="60"></textarea></p>
                </label>
            </div>
            <div class="form-create">
                <label class="form-inscription" for="image_article">Choisir une image
                    <input type="file" class="image" id="image_article" name="image_article" accept='.gif, .png , .jpg'
                           required>
                </label>
            </div>
            <p><input type="hidden" name="id_user" value="<?= $_SESSION[
                'id_user'
            ] ?>"></p>

            <div class="form-create">
                <input type="submit" value="Envoyer" name="articleCreation">

                <p><input type="reset" value="Annuler"/></p>

            </div>
        </fieldset>
    </form>
    <div class="back-page">
        <a href="<?= substr(
            basename($_SERVER['HTTP_REFERER']),
            0
        ) ?>">Retour</a>
        <a href="?action=home">Retour à l'accueil</a>
    </div>

<?php endif; ?>
<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>
