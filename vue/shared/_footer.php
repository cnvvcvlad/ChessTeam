<footer>
    <div class="pied-page">
        <div class="middle">
            <ul class="menu">
                <li class="item" id="profile">
                    <a class="btn" href="#profile">Notre adresse</a>

                    <div class="smenu">
                        <h5>15 rue Général Faidherbe</h5>
                        <h5>94130 Nogent sur Marne</h5>
                        <h5>0783554818</h5>
                        <h5>cnvvc_vlad@yahoo.fr</h5>
                    </div>
                </li>

                <li class="item" id="message">
                    <a class="btn" href="#message">Réseaux Sociaux</a>

                    <div class="smenu">
                        <a href="https://www.facebook.com/">Facebook<span class="icon-facebook"></span></a>
                        <a href="https://www.twitter.com/">Twitter<span class="icon-twitter"></span></a>
                        <a href="https://www.whatsapp.com/">Whatsapp<span class="icon-whatsapp"></span></a>
                        <a href="?action=rss" rel="noreferrer noopener" target="_blank">
                            Flux RSS<img src="assets/img/logo/rss.png" alt="Le Flux RSS" title="Flux RSS" />
                        </a>
                    </div>
                </li>

                <li class="item" id="settings">
                    <a class="btn" href="#settings">FAQ / CGU / CONTACT</a>

                    <div class="smenu">
                        <a href="?action=questions">Questions fréquentes</a>
                        <a href="?action=conditions">Condition d'utilisation</a>
                        <a href="?action=mentions">Mentions légales</a>
                        <a href="?action=contact">Contactez-nous</a>

                    </div>
                </li>
                <?php if ($role->isConnected()) : ?>
                    <li class="item"><a href="?action=deconnect" class="btn">Déconnexion</a>
                        <div class="separate"></div><a class="btn" href="">#top</a>
                    </li>
                <?php else : ?>
                    <li class="item"><a target="_blank" class="btn" href="https://www.chess.com/" rel="noreferrer noopener">Chess.com</a>
                        <div class="separate"></div><a class="btn" href=""><i class="fas fa-arrow-up"></i>#top</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
    <div>
        <div class="copyright">
            <p>&copy; Copyright 2019 - <?php echo date('Y'); ?> </p>
            <span class="compteur">
                <?php
                require_once dirname(__DIR__) .
                    DIRECTORY_SEPARATOR .
                    'compteur' .
                    DIRECTORY_SEPARATOR .
                    'compteur.php';
                add_vue();
                $vues = nb_vues();
                ?>
                IL y a <?= $vues ?> visite<?php if (
                                                $vues > 1
                                            ) : ?>s<?php endif; ?> sur le site
            </span>
        </div>
    </div>

</footer>