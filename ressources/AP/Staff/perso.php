<?php

    require_once('./requete.php');
    $IDPerso = $_SESSION["idPersonnel"];
    $return_id_perso = return_id_perso($IDPerso);
    $return_id_perso = $return_id_perso->fetchAll();
    
       
    
    $return_etat= return_etat($IDPerso);
    $return_etat = $return_etat->fetch();
    


    $return_etat1= return_etat1($IDPerso);
    $return_etat1 = $return_etat1->fetch();
    


  


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/perso.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  
<div class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
    <a href="./index.html"><img src="../ressources/medical.png" style="margin-top:-10px;width: 50px;height:50px;"></a>
    </div>
  </div>
  
  <div class="nav-links">
    <a href="./login.php">Retour</a>
  </div>
</div>


<section class="globale">




<div class="ligne">
    <div class="case1">
        <!-- <h2>Résultat Tableau</h2> -->


        <div class="tableau">
          <div class="titretab">
          <div class="lignetab">Heure</div>
          <div class="lignetab">Date</div>
          <div class="lignetab">Prénom</div>
          <div class="lignetab">Nom</div>
        </div>
<?php

foreach($return_id_perso as $id_perso){
  echo '<div class="tab">';
  echo '<div class="lignetab">'.$id_perso['HeureHospi'].'</div>';
  echo '<div class="lignetab">'.$id_perso['DateHospi'] . '</div>';
  echo '<div class="lignetab">'.$id_perso['PrenomPatient'] .'<br> </div>';
  echo '<div class="lignetab">'.$id_perso['NomNaissance'] .'<br> </div>';
  echo '</div>';
}
   ?>

        </div>
 


</div>
    <div class="case2">Resultat Graphique 




    <div>
                    <canvas id="myChart"></canvas>
                </div>

                <script>
    
                  const ctx = document.getElementById('myChart');


                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                        labels: ['Fini', 'En cours'],
                        datasets: [{
                            label: 'Hospitalisations',
                            data: <?php echo '['.$return_etat1['count(*)'].','.$return_etat['count(*)'].']' ?>,
                            backgroundColor: [ 'lime', 'red'],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                        },

                    
                        options: {
                          scales: {
                            yAxes: [{
                            beginAtZero: true,
                            gridLines:{
                              display:false
                            }
                        }]
                      }
}
                    });
                    </script>
    </div>
</div>





</section>


</body>
</html>