<?PHP
if (isset($_POST['month']) && isset($_POST['year'])) {
    $selectedMonth = $_POST['month'];
    $selectedYear = $_POST['year'];
    $sem = array(6,0,1,2,3,4,5); // Correspondance des jours de la semaine : lundi = 0, dimanche = 6
    $mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
    $day = array('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche');
    $timestampDay = mktime(0, 0, 0, $selectedMonth, 1, $selectedYear); // Timestamp du premier jour du mois 
    $currentMonth = date('n',$timestampDay); // Tant que le mois reste celui du départ

    $previousmonth = date('t',mktime(0, 0, 0, $selectedMonth-1, 1, $selectedYear)) - ($sem[date('w',$timestampDay)]-1);
    $nextmonth = date('j',mktime(0, 0, 0, $selectedMonth+1, 1, $selectedYear));
    
    function weeksPerMonth($m,$y){
        $timestampDay = mktime(1, 1, 1, $m, 1, $y); // cree le timestamp du jour recherché
        $nday = date('t', $timestampDay); // affiche le nombre de jour du mois, entre 28 et 31
        $fday = date("N",$timestampDay); // definie le jour du 1er lundi du mois, retourne 1 pour lundi  a 7 pour dimanche
        $xday = $nday + $fday;  //xday = nb de jour dans le mois + index du 1er ludi
        if ($xday == 29) {
            $n = 4; // cas ou fevrier 28jour et le 1er comemence un lundi
        }else if($xday % 7 != 0){
            $n = floor($xday/7) + 1;  //cas si $xday % 7jour different de 0
        }else  {
            $n = floor($xday/7);   // cas ou $xday = 35
        }
        return $n;
    };
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>patie 9 exercice 9</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="index.php" method="POST">
        <select name="month" id="month-select">
            <option value="1" <?php if (isset($_POST['month']) && $_POST['month'] == '1') { echo ' selected';}?> >janvier</option>
            <option value="2" <?php if (isset($_POST['month']) && $_POST['month'] == '2') { echo ' selected';}?> >fevrier</option>
            <option value="3" <?php if (isset($_POST['month']) && $_POST['month'] == '3') { echo ' selected';}?>>mars</option>
            <option value="4" <?php if (isset($_POST['month']) && $_POST['month'] == '4') { echo ' selected';}?>>avril</option>
            <option value="5" <?php if (isset($_POST['month']) && $_POST['month'] == '5') { echo ' selected';}?>>mai</option>
            <option value="6" <?php if (isset($_POST['month']) && $_POST['month'] == '6') { echo ' selected';}?>>juin</option>
            <option value="7" <?php if (isset($_POST['month']) && $_POST['month'] == '7') { echo ' selected';}?>>juillet</option>
            <option value="8" <?php if (isset($_POST['month']) && $_POST['month'] == '8') { echo ' selected';}?>>aout</option>
            <option value="9" <?php if (isset($_POST['month']) && $_POST['month'] == '9') { echo ' selected';}?>>septembre</option>
            <option value="10" <?php if (isset($_POST['month']) && $_POST['month'] == '10') { echo ' selected';}?>>octobre</option>
            <option value="11" <?php if (isset($_POST['month']) && $_POST['month'] == '11') { echo ' selected';}?>>novembre</option>
            <option value="12" <?php if (isset($_POST['month']) && $_POST['month'] == '12') { echo ' selected';}?>>decembre</option>
        </select>
        <select name="year" id="mois-select">
            <option value="2000" <?php if (isset($_POST['year']) && $_POST['year'] == '2000') { echo ' selected';}?>>2000</option>
            <option value="2001" <?php if (isset($_POST['year']) && $_POST['year'] == '2001') { echo ' selected';}?>>2001</option>
            <option value="2002" <?php if (isset($_POST['year']) && $_POST['year'] == '2002') { echo ' selected';}?>>2002</option>
            <option value="2003" <?php if (isset($_POST['year']) && $_POST['year'] == '2003') { echo ' selected';}?>>2003</option>
            <option value="2004" <?php if (isset($_POST['year']) && $_POST['year'] == '2004') { echo ' selected';}?>>2004</option>
            <option value="2005" <?php if (isset($_POST['year']) && $_POST['year'] == '2005') { echo ' selected';}?>>2005</option>
            <option value="2006" <?php if (isset($_POST['year']) && $_POST['year'] == '2006') { echo ' selected';}?>>2006</option>
            <option value="2007" <?php if (isset($_POST['year']) && $_POST['year'] == '2007') { echo ' selected';}?>>2007</option>
            <option value="2008" <?php if (isset($_POST['year']) && $_POST['year'] == '2008') { echo ' selected';}?>>2008</option>
            <option value="2009" <?php if (isset($_POST['year']) && $_POST['year'] == '2009') { echo ' selected';}?>>2009</option>
            <option value="2010" <?php if (isset($_POST['year']) && $_POST['year'] == '2010') { echo ' selected';}?>>2010</option>
            <option value="2011" <?php if (isset($_POST['year']) && $_POST['year'] == '2011') { echo ' selected';}?>>2011</option>
            <option value="2012" <?php if (isset($_POST['year']) && $_POST['year'] == '2012') { echo ' selected';}?>>2012</option>
        </select>
        <input type="submit" value="Validation">
        </form>
        <?php if (isset($_POST['month']) && isset($_POST['year'])) {?>
            <table class=" table<?php echo weeksPerMonth($_POST['month'], $_POST['year']) ?>weeks">
                <tr class="tableHeader">
                    <th colspan="7"><?php echo $mois[$_POST['month']] . ' ' . $_POST['year']?></th>
                </tr>
                <tr>
                    <?php for($i = 0; $i <= 6; $i++){ ?>
                        <th><?= $day[$i] ?></th>
                    <?php } ?>
                </tr>
                <?php
                for ($l = 0 ; $l < weeksPerMonth($selectedMonth, $selectedYear) ; $l++){ // calendrier s'adapte au nombre de semaine?>
                    <tr>
                        <?php for ($i = 0 ; $i < 7 ; $i++) { // boucle pour afficher 7 td
                            $currentDay = $sem[date('w',$timestampDay)]; // Jour de la semaine à traiter

                            
                            if (($currentDay == $i) && $timestampDay < (mktime(0, 0, 0, $selectedMonth, 1, $selectedYear) + (date('t',mktime(0, 0, 0, $selectedMonth, 1, $selectedYear)) * 86400))  && ($currentMonth == $selectedMonth)) { // Si le jours de semaine et le mois correspondent ?>
                                <td> <?= date('j',$timestampDay) // Affiche le jour du mois?> </td> 
                                <?php 
                                $timestampDay += 86400; // timeStamp = au jour suivant
                            }else { ?>
                                    <!-- &nbsp; -->
                                    <?php if ($previousmonth <= date('t',mktime(12, 0, 0, $selectedMonth-1, 1 ,$selectedYear))) { ?>
                                        <td class="gray">
                                            <?= $previousmonth; ?>
                                        </td>
                                        <?php $previousmonth += 1; 
                                    }else { ?>
                                        <td class="gray">
                                            <?= $nextmonth; ?>
                                        </td>
                                        <?php $nextmonth += 1; ?>
                                    <?php } //fin else nexmonth ?>
                                </td>
                            <?php } //fin du else
                        } //fin boucle affiche les 7 jours?>
                    </tr>
                <?php } //fin boucle nombre de semaine ?>
            </table>
        <?php } // fin du If isset?>
</body>
</html>
