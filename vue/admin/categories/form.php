<?php $title = 'Formulaire'; ?>
<?php $description = 'Page du formulaire'; ?>
<div class="container">
    <h1><?= isset($params['category'][0])
        ? $params['category'][0]->getTitle()
        : 'Créer une nouvelle catégorie' ?></h1>
    <form action="<?= isset($params['category'][0])
        ? dirname(SCRIPTS) .
            '/admin/categories/update-category/' .
            $params['category'][0]->getId()
        : dirname(SCRIPTS) .
            '/admin/categories/create-category' ?>" method="post" class="form-inscription" enctype="multipart/form-data">
        <fieldset>
            <legend>Introduisez vos informations</legend>
            <div class="form-create">
                <label for="">Titre de la catégorie
                    <input type="hidden" name="id" value="<?= isset(
                        $params['category'][0]
                    )
                        ? $params['category'][0]->getId()
                        : '' ?>">

                    <p><input type="text" name="cat_title" value="<?= isset(
                        $params['category'][0]
                    )
                        ? $params['category'][0]->getTitle()
                        : '' ?>"></p>
                </label>
            </div>
            <div class="form-create">
                <label for="">Description de la catégorie
                    <p><textarea maxlength="20" minlength="5" required name="cat_description" placeholder="Description de la catégorie" rows="5" cols="33"><?= isset(
                        $params['category'][0]
                    )
                        ? $params['category'][0]->getDescription()
                        : '' ?></textarea></p>
                </label>
            </div>
            <div class="form-inscription art_image">
                <label class="form-inscription" for="image">Choisir une image</label>
                <input type="file" class="image" id="image" name="image_category" accept='.gif, .png , .jpg, .jpeg'>
                <?php if (
                    isset($params['category'][0]) and
                    !empty($params['category'][0]->getCategory_image())
                ): ?>
                    <img src="<?= dirname(SCRIPTS) .
                        '/public/img/uploads/' .
                        $params[
                            'category'
                        ][0]->getCategory_image() ?>" alt="" width="100">
                <?php endif; ?>
            </div>
            <input type="hidden" name="cat_author" value="<?= isset(
                $params['category'][0]
            )
                ? $params['category'][0]->getCat_author()
                : '' ?>">

            
            <input type="hidden" name="old_image" value="<?= isset(
                $params['category'][0]
            )
                ? $params['category'][0]->getCategory_image()
                : '' ?>">

            <div class="form-create">
                <p><input type="submit" value="<?= isset($params['category'][0])
                    ? 'Enregistrer les modifications'
                    : 'Enregistrer ma catégorie' ?>" name="<?= isset(
    $params['category'][0]
)
    ? 'updateCategory'
    : 'createCategory' ?>"></p>

                <p><input type="reset" value="Annuler" /></p>
            </div>
        </fieldset>
    </form>
</div>