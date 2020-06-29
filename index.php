<?php
// équivalent d'un if, si on sélectionne février, alors = 2, sinon = mois en cours.
$selectedMonth = (isset($_POST['months']) ? $_POST['months'] : date('m'));
$selectedYear = (isset($_POST['years']) ? $_POST['years'] : date('Y'));
$months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$numeroDuJour = 1;
// N = jour de la semaine sous forme de chiffre
// quand on dit dollar on ne l'écrit pas
$premierJourDuMois = date('N', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear));
$nombreDeJourDansLeMois = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
$dernierJourDuMois = date('N', mktime(0, 0, 0, $selectedMonth, $nombreDeJourDansLeMois, $selectedYear));
$nombreDeCaseAvant = $premierJourDuMois - 1;
$nombreDeCaseAprès = 7 - $dernierJourDuMois;
//deux jours avant et deux jours après + 31 = 35
$nombreDeCaseDuCalendrier = $nombreDeCaseAvant + $nombreDeJourDansLeMois + $nombreDeCaseAprès;
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Calendrier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
</head>
<body>
    <form action="tp.php" method="POST">
        <div class="form-group">
            <label for="months">Mois</label>    
        <select name="months" id="months">
            <?php foreach($months as $indexMonth => $month){ ?>
                <option value="<?= $indexMonth + 1 ?>" <?= $selectedMonth == $indexMonth + 1 ? 'selected' : '' ?> ><?= $month ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="form-group">
           <label for="years">Année</label>
        <select name="years" id="years">
            <option value="0" selected disabled>Veuillez sélectionner une année</option>
                <?php //Dans la balise option, on rajoute la valeur dans value et entre les balises
                    for($year = 1900; $year <= 2100; $year++){ ?>
                    <option value="<?= $year ?>" <?= $selectedYear == $year ? 'selected' : '' ?>><?= $year ?></option>
               <?php } ?>
        </select> 
        </div>
            <div class="form-group">
                <input type="submit" value="Valider" class="btn btn-success" />
            </div>
    </form>
    <table class="table table-striped">
        <thead>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
            <th>Samedi</th>
            <th>Dimanche</th>
        </thead>
        <tbody>
            <tr>
                <?php
                // On utilise une boucle pour générer le bon nombre de cases(jour avant le mois, nombre de jour dans le mois, jour après le mois)
                 for ($case = 1; $case <= $nombreDeCaseDuCalendrier; $case++) { ?>
                    <td>
                    <?php
                    //on vérifie que la case qui est en train d'être créée, correspond au numéro du premier jour.
                    //on arrête l'affichage du numero du jour quand il atteint la fin du mois.
                    if($case >= $premierJourDuMois && $numeroDuJour <= $nombreDeJourDansLeMois){
                        echo $numeroDuJour;
                        $numeroDuJour++;
                    } ?>
                    </td>
                   <?php 
                    // % = modulo
                    if ($case % 7 == 0) { ?>
                        </tr><tr>
                    <?php
                            }
                        }
                    ?>
            </tr>
        </tbody>
    </table>
</body>

</html>