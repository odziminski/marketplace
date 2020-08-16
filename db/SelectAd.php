<?php
require_once 'connect.php';

class selectAdvertisement extends DBconnect
{
    public function DisplayAds($query)
    {
        $stmt = $this->getConnection()
            ->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0)
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="container">
                <div class="row">
                    <?php
                        foreach ($result as $row)
                        {
                        ?>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <a href="advertisements/ad/<?=$row['id_ad'] ?>">
                                    <?php
                                                
                                        if (!empty($row['image_name'])){?> 
                                        <img width="100" height="100" src="advertisements/img/submitted/<?= $row['image_name'] ?>"
                                             class="rounded float-left img-responsive border border-dark"></a>
                                <?php
                                    }
                                        else
                                    {?>
                                        <img width="100" height="100" src="advertisements/img/question_mark.png"
                                            class="rounded float-left img-responsive border border-dark"></a>
                                        <?php } ?>
                                <a class="card-title" href='advertisements/ad/<?=$row['id_ad']?>'><?=$row['title']?></a>
                                <p class="card-text"><?=$row['content']?></p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text text-center"><?=$row['price']?> PLN</p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }

                    }
                    else
                    {
                        ?>
                        <h2>Nothing to show yet
                        <a href='advertisements/index.php'><br> 
                        Go back to main page.</a></div>";
                        <?php
                    }
                    ?> 
                        </div>
                    </div>
                </div> 
                <?php
        }

    public function DisplaySingleAd($query)
    {
        $stmt = $this->getConnection()
            ->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        
        if ($count > 0)
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row)
            {
                     $time = strtotime($row['date_added']);
                    $DMYdate = date("d/m/y g:i A", $time);
                   if ($row['sell_buy']=="null"){
                    $row['sell_buy'] = "Undisclosed";
                   }
                
                if (!empty($row['image_name']))
                {
                    echo '<img class="single-img img-fluid border" src= "advertisements/img/submitted/' . $row['image_name'] . '"</br>';
                }
                else
                {
                    echo '<img class="single-img img-fluid border" src= "advertisements/img/question_mark.png "' . '</br>';
                }
                ?>
        <h1> <?= $row['title']?> </h1>

        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Selling/Buying</th>
                    <th>Price</th>
                    <th> Date added </th>
                </tr>
            </thead>
            <tbody>
                <tr class="active">
                    <td><?=$row['category']?></td>
                    <td><?=$row['sell_buy']?></td>
                    <td><?=$row['price']?> PLN</td>
                    <td><?=$DMYdate?></td>
                </tr>
            </tbody>
        </table>
    

</div>
<p class="text-margin text-wrap"> <?=$row['content']?> </p>    
Contact:
<a href="mailto:<?=$row['email'] ?>"><?=$row['email'] ?></a>

<?php
                                        echo '</div>';
                                        echo "<br>";
                                    }

                                }
                                else
                                {
                                    echo "Nothing to show yet.";
                                }
                            }
    }
                    