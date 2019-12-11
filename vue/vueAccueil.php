<?php ob_start(); ?>

<?php $title = 'Accueil blog ChessTeam Nogent sur Marne'; ?>
<?php $description = 'Le blog du ChessTeam Nogent sur Marne propose aux internautes passionés des échecs  de consulter ses articles publiés, s\'inscrire en tant que membre pour publier ses propres articles et commentaires' ;?>
<div class="main-vue">
    <div class="banniere"> 
    <?php if (!empty($lastArticles)): ?>
        <article>   
            <!-- La structure du slide -->            
            <div class="galleryContainer">
                <div class="slideShowContainer">
                    <div id="playPauseBtn" onclick="playPauseSlides()"></div>
                    <div class="leftArrow" onclick="plusSlides(-1)"><span class="arrow arrowLeft"></span></div>
                    <div class="rightArrow" onclick="plusSlides(1)"><span class="arrow arrowRight"></span></div>
                    <div class="captionHolder">
                        <h1 class="captionTitle"></h1>
                        <p class="captionText"></p>
                    </div>

                    <?php foreach ($lastArticles as $key => $values): ?>
                        <div class="imageHolder">
                        <img src="assets/img/uploads/<?= $values->getArt_image() ?>" alt="Image article">
                        <h1 class="captionTitle"><?= $values->getArt_title() ?></h1>
                        <p class="captionText"><?= $values->getArt_description() ?></p>
                    </div>
                    <?php endforeach; ?>                    
                </div>
                <div id="dotsContainer"></div>
            </div>
        </article>

        <div class="bienvenue"> 
            <div class="search_bouton">
                <label for="article-search">Recherchez un article :</label>
                <input type="search" id="article-search"
                    aria-label="Recherchez un article">
                <button>Search</button>
            </div>       
            <div class="banniere_bouton">
                <?php if (isAdmin()) : ?>
                    <div class="bouton_commande"><a href="">Supprimer</a></div>
                    <div class="bouton_commande"><a href="">Modifier</a></div>
                <?php endif; ?>
                <div class="bouton_commande">
                    <a href="#" class="bouton_rouge">Voir l'article <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge" /></a>
                </div>
            </div>
        </div>
    </div>
    <div class="top_article">            
    <?php if (!empty($lastArticle_one)) : ?>
    <?php foreach ($lastArticle_one as $key => $value) : ?>
        <h1><img src="assets/img/by_default/ico_epingle.png" alt="Catégorie" class="ico_categorie" /><?= $value->getArt_title() ?></h1> 
        <div class="banniere_bouton">
                <?php if (isAdmin()) : ?>
                    <div class="bouton_commande"><a href="">Modifier</a></div>
                <?php endif; ?>
                <div class="bouton_commande">
                    <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Voir l'article <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge" /></a>
                </div>
            </div>
        <p>Ecrit par <mark><?= showNameAuthor($value->getArt_author()) ?></mark> le <em><?= $value->getArt_date_creation() ?></em> dans la catégorie <strong><?= showNameCategory($value->getCategory_id()) ?></strong></p>  
        <div class="justify_article">
            <p>
            <img src="assets/img/uploads/<?= $value->getArt_image() ?>" alt="Image de l'article">

                <span><?= $value->getArt_content() ?></span>                    
            </p>
            <p><a href="?action=allArticles&amp;id=<?= $value->getId() ?>">Commentaires(<?= numberCommentsOfArticle(getAllCommentsOfArticle($value->getId())); ?>)</a></p>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>
    </div>  
    
    <div class="program">
        <section class="content">
            <h2 class="myColor">Qui sommes-nous ?</h2>
            <p><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, explicabo neque odit repellat debitis eum mollitia dolor ducimus nulla saepe recusandae sint aspernatur omnis porro fuga officia quod quasi rem?</span><span>Error placeat molestias debitis pariatur molestiae atque dolores. Debitis, sint eaque. Cumque ipsa, ad blanditiis porro quas adipisci voluptatum? Quisquam expedita in minus id nulla, adipisci facere praesentium. Amet, deleniti?</span></p>
        </section>
        <section class="content">
            <h2 class="myColor">Nos actualités</h2>
            <p><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt praesentium vel deleniti quasi itaque voluptatibus delectus magnam harum, voluptate, non doloremque facilis quam iure eum, illum provident reprehenderit repellat laudantium?</span><span>Reprehenderit enim eaque sapiente excepturi maxime error recusandae illum? Amet sint sapiente omnis cupiditate iure quod optio, suscipit consectetur cumque deserunt illo molestias repellendus voluptatem error nesciunt assumenda provident! Molestias!</span></p>
        </section>
        <section class="content">
            <h2 class="myColor">Les sites partenaires</h2>
            <p><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima laborum reiciendis adipisci quasi sit in ut esse tenetur repudiandae ea minus totam enim eligendi explicabo, rerum mollitia omnis vel aspernatur.</span><span>Autem iste hic est ipsa, aliquam at sit earum sapiente dignissimos beatae deleniti quis laudantium, quisquam, voluptate possimus aut repellendus doloremque reprehenderit error id asperiores! Aspernatur quibusdam mollitia commodi perferendis!</span></p>
        </section>
    </div>     
</div>
<?php endif; ?>

<?php $template = ob_get_clean(); ?>



<?php require 'templates/tempAccueil.php'; ?>