<?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 1): ?>
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