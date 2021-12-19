<?php $title = 'Formulaire'; ?>
<?php $description = 'Page du formulaire'; ?>
<div class="container">
    <h1><?= isset($params['post'][0]) ? $params['post'][0]->getArt_title() : 'Créer un nouvel article' ?></h1>
<form action="<?= isset($params['post'][0]) ? dirname(SCRIPTS) . "/admin/posts/edit/" . $params['post'][0]->getId() : dirname(SCRIPTS) . "/admin/posts/create" ?>" method="post" class="form-inscription"
                      enctype="multipart/form-data">
                    <fieldset>
                        <legend>Introduisez vos informations</legend>
                        <div class="form-create">
                            <label for="">Titre de l'article
                                <input type="hidden" name="id" value="<?= isset($params['post'][0]) ? $params['post'][0]->getId() : '' ?>">

                                <p><input type="text" name="art_title" value="<?= isset($params['post'][0]) ? $params['post'][0]->getArt_title() : '' ?>"></p>
                            </label>
                        </div>
                        <div class="form-create">
                            <label for="">Description de l'article
                                <p><textarea name="art_description" placeholder="Description de l'article" rows="5"
                                             cols="33"><?= isset($params['post'][0]) ? $params['post'][0]->getArt_description() : '' ?></textarea></p>
                            </label>
                        </div>
                        <div class="form-create">
                            <label for="">Contenu de l'article
                                <p><textarea name="art_content" placeholder="Contenu de l'article" rows="5"
                                             cols="33"><?= isset($params['post'][0]) ? $params['post'][0]->getArt_content() : '' ?></textarea></p>
                            </label>
                        </div>
                        <?php if (isset($params['categories'])): ?>
                        <div class="form-create">
                            <label for="category">Catégorie de l'article
                                <p><select required class="form-inscription" name="category">
                                        <option value="">--Choisir une Catégorie--</option>
                                        <?php foreach ($params['categories'] as $key => $value): ?>
                                            <option value="<?= $value->getId() ?>"><?= $value->getTitle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                            </label>
                        </div>
                        <?php endif; ?>
                        <div class="form-inscription art_image">
                            <label class="form-inscription" for="image">Choisir une image</label>
                            <input type="file" class="image" id="image" name="art_image"
                                   accept='.gif, .png , .jpg' required>

                        </div>
                        <p><input type="hidden" name="art_author" value="<?= isset($params['post'][0]) ? $params['post'][0]->getArt_author() : '' ?>"></p>

                        <p><input type="hidden" name="category_id" value="<?= isset($params['post'][0]) ? $params['post'][0]->getCategory_id() : ''?>"></p>

                        <div class="form-create">
                            <p><input type="submit" value="<?= isset($params['post'][0]) ? 'Enregistrer les modifications' : 'Enregistrer mon article' ?>" name="<?= isset($params['post'][0]) ? 'updateArticle' : 'articleCreation' ?>"></p>

                            <p><input type="reset" value="Annuler"/></p>
                        </div>
                    </fieldset>
                </form>
</div>