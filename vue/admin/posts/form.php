<?php

$title = 'Formulaire'; ?>
<?php $description = 'Page du formulaire'; ?>
<div class="container">
    <h1><?= isset($params['post'][0])
            ? $params['post'][0]->getArt_title()
            : 'Créer un nouvel article' ?></h1>
    <form action="<?= isset($params['post'][0])
                        ? dirname(SCRIPTS) . '/admin/posts/edit/' . $params['post'][0]->getId()
                        : dirname(SCRIPTS) .
                        '/admin/posts/create' ?>" method="post" class="form-inscription" enctype="multipart/form-data">
        <fieldset>
            <legend>Introduisez vos informations</legend>
            <div class="form-create">
                <label for="">Titre de l'article
                    <input type="hidden" name="id" value="<?= isset(
                                                                $params['post'][0]
                                                            )
                                                                ? $params['post'][0]->getId()
                                                                : '' ?>">

                    <p><input type="text" name="art_title" value="<?= isset(
                                                                        $params['post'][0]
                                                                    )
                                                                        ? $params['post'][0]->getArt_title()
                                                                        : '' ?>"></p>
                </label>
            </div>
            <div class="form-create">
                <label for="">Description de l'article
                    <p><textarea maxlength="100" minlength="5" required name="art_description" placeholder="Description de l'article" rows="5" cols="33"><?= isset($params['post'][0])
                                                                                                                                                                ? $params['post'][0]->getArt_description()
                                                                                                                                                                : '' ?></textarea></p>
                </label>
            </div>
            <div class="form-create">
                <label for="">Contenu de l'article
                    <p><textarea minlength="5" id="editor" name="art_content" placeholder="Contenu de l'article" rows="5" cols="33"><?= isset($params['post'][0])
                                                                                                                                                    ? $params['post'][0]->getArt_content()
                                                                                                                                                    : '' ?></textarea></p>
                </label>
            </div>
            <?php if (isset($params['categories'])) : ?>
                <div class="form-create">
                    <label for="category">Catégorie de l'article
                        <p><select required class="form-inscription" name="category">
                                <option value="">--Choisir une Catégorie--</option>
                                <?php foreach ($params['categories']
                                    as $key => $value) : ?>
                                    <option value="<?= $value->getId() ?>"><?= $value->getTitle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                    </label>
                </div>
            <?php endif; ?>
            <div class="form-inscription art_image">
                <label class="form-inscription" for="image">Choisir une image</label>
                <input type="file" class="image" id="image" name="art_image" accept='.gif, .png , .jpg, .jpeg'>
                <?php if (
                    isset($params['post'][0]) and
                    !empty($params['post'][0]->getArt_image())
                ) : ?>
                    <img src="<?= dirname(SCRIPTS) .
                                    '/public/img/uploads/' .
                                    $params['post'][0]->getArt_image() ?>" alt="" width="100">
                <?php endif; ?>

            </div>
            <input type="hidden" name="art_author" value="<?= isset(
                                                                $params
                                                            )
                                                                ? $_SESSION['id_user']
                                                                : $params['post'][0]->getArt_author() ?>">

            <input type="hidden" name="category_id" value="<?= isset(
                                                                $params['post'][0]
                                                            )
                                                                ? $params['post'][0]->getCategory_id()
                                                                : '' ?>">
            <input type="hidden" name="old_image" value="<?= isset(
                                                                $params['post'][0]
                                                            )
                                                                ? $params['post'][0]->getArt_image()
                                                                : '' ?>">

            <div class="form-create">
                <p><input type="submit" value="<?= isset($params['post'][0])
                                                    ? 'Enregistrer les modifications'
                                                    : 'Enregistrer mon article' ?>" name="<?= isset(
                                                                                                $params['post'][0]
                                                                                            )
                                                                                                ? 'updateArticle'
                                                                                                : 'articleCreation' ?>"></p>
                <p><input type="reset" value="Annuler" /></p>
            </div>
        </fieldset>
    </form>
    <div class="back-page">
        <?= isset($_SERVER['HTTP_REFERER'])
            ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
            : '' ?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>
</div>