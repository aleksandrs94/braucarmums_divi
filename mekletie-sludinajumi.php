          <?php
              require 'db.php';

                $sakums = $_SESSION['sakums'];
                $beigas = $_SESSION['beigas'];

                //$result = $mysqli->query("SELECT * FROM brauciens WHERE sakums = '$sakums' AND beigas = '$beigas'") or die($mysqli->error());
                //$mysqli->query($result);

                //if ($row = mysqli_fetch_assoc($result)){
                   $result2 = $mysqli->query("SELECT * FROM users JOIN brauciens ON brauciens.users_id=users.id WHERE sakums = '$sakums' AND beigas = '$beigas'") or die($mysqli->error());
                    while ($row = mysqli_fetch_assoc($result2)){
                    echo '<a href="brauciena-sludinajums.php?page_id='.$row['id'].'">';
                      echo '<div class="sludinajuma-info">';
                      //Lietotāja info
                        echo '<div class="profile-info">';
                          if($row['image'] == ""){
                            echo "<img width='100' height='100' src='img/profile/default.png' alt='Default Profile Pic'>";
                          } else {
                            echo "<img width='100' height='100' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                          }

                          echo '<div class="name">';
                          $name = $row['first_name'];
                          $surname = $row['last_name'];
                          echo "<p> $name $surname </p>"; 
                          echo '</div>';
                          echo '<div class="number">';
                            $number = $row['p_number'];
                            echo "<p> $number </p>";
                          echo '</div>';
                        echo '</div>';
                        //Brauciena info
                        echo '<div class="brauciena-info">';
                          echo '<div class="marsruts-info">';
                            $sakums = $row['sakums'];
                            $beigas = $row['beigas'];
                            echo "<p>$sakums - $beigas</p>";
                          echo '</div>';

                          echo '<div class="datums-info">';
                            $datums = $row['datums'];
                            $laiks = $row['laiks'];
                            echo "<p>$datums | $laiks</p>";
                          echo '</div>';

                          echo '<div class="cena-info">';
                            $cena = $row['cena'];
                            echo "<p>$cena €</p>";
                          echo '</div>';

                          echo '<div class="skaits-info">';
                            $skaits = $row['skaits'];
                            echo "<p>$skaits</p>";
                          echo '</div>';

                          echo '<div class="description-info">';
                            $description = $row['description'];
                            echo "<p>$description</p>";
                          echo '</div>';

                          echo '<div class="veids-ico">';
                            echo '<img src="img/car_ico.png" width="50" height="50" alt="Search icon" />';
                          echo '</div>';

                        echo '</div>';
                      echo '</div>';
                    echo'</a>';
                  }
                $result3 = $mysqli->query("SELECT * FROM users JOIN braucejs ON braucejs.users_id=users.id WHERE sakums = '$sakums' AND beigas = '$beigas'") or die($mysqli->error());
                
                  while($row = mysqli_fetch_assoc($result3)){
                    echo '<a href="pasaziera-sludinajums.php?page_id='.$row['id'].'">';
                      echo '<div class="sludinajuma-info">';
                      //Lietotāja info
                        echo '<div class="profile-info">';
                          if($row['image'] == ""){
                            echo "<img width='100' height='100' src='img/profile/default.png' alt='Default Profile Pic'>";
                          } else {
                            echo "<img width='100' height='100' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                          }

                          echo '<div class="name">';
                          $name = $row['first_name'];
                          $surname = $row['last_name'];
                          echo "<p> $name $surname </p>"; 
                          echo '</div>';
                          echo '<div class="number">';
                            $number = $row['p_number'];
                            echo "<p> $number </p>";
                          echo '</div>';
                        echo '</div>';
                        //Brauciena info
                        echo '<div class="brauciena-info">';
                          echo '<div class="marsruts-info">';
                            $sakums = $row['sakums'];
                            $beigas = $row['beigas'];
                            echo "<p>$sakums - $beigas</p>";
                          echo '</div>';
                          
/*                          //pagaidu mainīgais, lai zinātu sludinājumu id
                          echo '<div class="id-info">';
                            $id = $row['id'];
                            echo "<p>$id</p>";
                          echo '</div>';*/

                          echo '<div class="datums-info">';
                            $datums = $row['datums'];
                            $laiks = $row['laiks'];
                            echo "<p>$datums | $laiks</p>";
                          echo '</div>';

                          echo '<div class="description-info">';
                            $description = $row['description'];
                            echo "<p>$description</p>";
                          echo '</div>';

                          echo '<div class="veids-ico">';
                            echo '<img src="img/human.png" width="35" height="70" alt="Search icon" />';
                          echo '</div>';

                        echo '</div>';
                      echo '</div>';
                    echo '</a>';
                  }
                  


                //}
/*                else {
                  $_SESSION['message'] = "Neviens sludinājums netika atrasts!";
                    header("location: main.php");
                }*/
            
          