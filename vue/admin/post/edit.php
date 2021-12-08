<div class="container">
<form action="<?= dirname(SCRIPTS) ?>/admin/posts/edit/<?= $params['post'][0]->getId() ?>" method="post" class="form-inscription"
                      enctype="multipart/form-data">
                    <fieldset>
                        <legend>Introduisez vos informations</legend>
                        <div class="form-inscription">
                            <label for="">Titre de l'article
                                <input type="hidden" name="id" value="<?= $params['post'][0]->getId() ?>">

                                <p><input type="text" name="art_title" value="<?= $params['post'][0]->getArt_title() ?>"></p>
                            </label>
                        </div>
                        <div class="form-inscription">
                            <label for="">Description de l'article
                                <p><textarea name="art_description" placeholder="Description de l'article" rows="5"
                                             cols="33"><?= $params['post'][0]->getArt_description() ?></textarea></p>
                            </label>
                        </div>
                        <div class="form-inscription">
                            <label for="">Contenu de l'article
                                <p><textarea name="art_content" placeholder="Contenu de l'article" rows="5"
                                             cols="33"><?= $params['post'][0]->getArt_content() ?></textarea></p>
                            </label>
                        </div>
                        <div class="form-inscription">
                            <label class="form-inscription" for="image">Choisir une image</label>
                            <input type="file" class="image" id="image" name="art_image"
                                   accept='.gif, .png , .jpg' required>

                        </div>
                        <p><input type="hidden" name="art_author" value="<?= $params['post'][0]->getArt_author() ?>"></p>

                        <p><input type="hidden" name="category_id" value="<?= $params['post'][0]->getCategory_id() ?>"></p>

                        <div class="form-inscription">
                            <p><input type="submit" value="Enregistrer les modifications" name="updateArticle"></p>

                            <p><input type="reset" value="Annuler"/></p>
                        </div>
                    </fieldset>
                </form>
</div>