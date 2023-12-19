<?php $title = 'Procéder au paiement'; ?>
<?php $description =
    'Le système de paiement Stripe est bien sécurisé qui permet d\'effectuer des paiements en ligne.'; ?>

    <div id="paiementContainer" class="">
    <h1 class="">Introduisez les coordonées bancaires</h1>
    <form action="#" method="POST" class="form-inscription" name="paiementForm" id="">
            <div class="form-inscription">
                <label for="clientName">
                    <p>
                        <input type="text" name="clientName" placeholder="Name" id="clientName">
                    </p>
                </label>
            </div>
            <div class="form-inscription">
                <label for="clientEmail">
                    <p>
                        <input type="text" name="clientEmail" placeholder="Email" id="clientEmail">
                    </p>
                </label>
            </div>
            <div class="form-inscription">
                <label for="clientCode">
                    <p>
                        <input type="text" name="clientCode" placeholder="Card code" id="clientCode">
                    </p>
                </label>   
            </div>
            <div class="form-inscription">
                <label for="cardMonth"></label>
                <select name="cardMonth" class="coach-paiement" id="cardMonth">
                <option>Select Month</option>
                <?php foreach ($params['months'] as $month): ?>
                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                    <?php endforeach; ?>
                </select>             
                <label for="cardYear"></label>
                <select name="cardYear" class="coach-paiement" id="cardYear">
                <option>Select Year</option>
                <?php foreach ($params['years'] as $year): ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endforeach; ?>
                </select> 
            </div>
            <div class="form-inscription">   
                <p>                    
                    <input type="text" name="cardVerificationCode" placeholder="CVC" id="cardVerificationCode">
                </p>
            </div>
            <div class="form-inscription">
                <input
                 type="submit" 
                 id="paiementButton"                  
                 value="Acheter" class="form-inscription">
            </div>
        </form>
    </div>
    <div class="back-page">
    <?= isset($_SERVER['HTTP_REFERER'])
        ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
        : '' ?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>