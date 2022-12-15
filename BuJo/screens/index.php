
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner</title>
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <div class="navbar">
    <div class="text-box">
        <h1>BUJO</h1>
    </div>
    </div>
    <div class="snow"></div>
    <div class="snow2"></div>
<?php
    $schedule_agenda = array("TODAY", "TOMORROW", "IN 2 DAYS", "WITHIN THE WEEK", 
    "WITHIN 14 DAYS", "WITHIN 30 DAYS");
    $files = array('Today_agenda', 'Tomorrow_agenda', 'Days2_agenda', 'Days7_agenda', 'Days14_agenda', 'Days30_agenda');

    if(isset($_GET['action'])){
        
        if((file_exists("./planners/".$_GET['category'].".txt")) && 
            (filesize("./planners/".$_GET['category'].".txt") != 0))
            {
                $PlannerArray = file("./planners/".$_GET['category'].".txt");
                switch($_GET['action'])
                {
                    
                    case 'DeleteMessage' :
                        if(isset($_GET['agenda']))
                        {
                            
                            $Index = $_GET['agenda'];
                            unset($PlannerArray[$Index]);
                            $PlannerArray = array_values($PlannerArray);
                        }
                    break;
                    case 'Modify' :
                        if(isset($_GET['agenda']))
                        {
                            
                            $Index = $_GET['agenda'];
                            $cat = $_GET['category'];
                            echo "<script>location.href='editTask.php?agenda=$Index&category=$cat';</script>";
                        }
                    break;
                    
        
        
                }
                if(count($PlannerArray) > 0)
                        {
                            $NewAgenda = implode($PlannerArray);
                            $PlannerStorage = fopen("./planners/".$_GET['category'].".txt", "wb");
        
                            if($PlannerStorage == false)
                            {
                                echo "There was an error updating the message file \n";
        
                            }
                            else{
                                fwrite($PlannerStorage, $NewAgenda);
                                fclose($PlannerStorage);
                            }
                        }
                        else{
                            unlink("./planners/".$_GET['category'].".txt");
                        }
            }
       
    }


 
    // pssst shooore where okiiii 
    // pssst lipat tayoo ewan call? or hmm
    ?>
    
    <div class="d-flex flex-wrap">
        <!-- creating a container for each item inside $schedule_agenda array -->
        <?php
        foreach ($schedule_agenda as $category) {
        ?>
        <!-- creating agenda container for each agenda on category -->
        <div class="container">  
            <div class="schedule">
                <p><?php echo $category;?></p>
                <!-- passes which category they picked to add task page -->
                <form method="get" action="addtask.php">
                    <button class="add-button" name="add" value="<?php echo $category;?>" type="submit">
                <img style="width:35px; height:auto;" src="https://img.icons8.com/stickers/512/add-to-favorites.png" alt=""></button>             
                </form>    
            </div>
            <?php
            //
            if ($category == "TODAY")
            {
                $category = "Today_agenda";
                
            }
            elseif ($category == "TOMORROW"){

                $category = "Tomorrow_agenda";
                
            }
            elseif ($category == "IN 2 DAYS"){
                $category = "Days2_agenda";
              
            }
            elseif ($category == "WITHIN THE WEEK"){
                $category = "Days7_agenda";
                
            }
            elseif ($category == "WITHIN 14 DAYS"){
                $category = "Days14_agenda";
               
            }
            elseif ($category == "WITHIN 30 DAYS"){
                $category = "Days30_agenda";
               
            }

            if((!file_exists("./planners/$category.txt")) 
                || (filesize("./planners/$category.txt" ) == 0)){
                    echo "<p style=\"text-align:center;margin:15px;\"> There are no plans here yet. </p>\n";
            }
            else{
                $PlannerArray = file("./planners/$category.txt");
                $count = count($PlannerArray);
                for ($i = 0; $i < $count; ++$i)
                {
                    $CurrPlanner = explode("~", $PlannerArray[$i]);
                    switch ($category) {
                        case 'Today_agenda':
                            $color = "rgb(240, 212, 89)";
                            break;
                        
                        case 'Tomorrow_agenda':
                            $color = "rgb(22, 53, 231)";
                            break;
                        
                        case 'Days2_agenda':
                            $color = "rgb(215, 26, 221)";
                            break;
                        
                        case 'Days7_agenda':
                            $color = "rgb(206,52,38)";
                            break;
                        
                        case 'Days14_agenda':
                            $color = "rgb(35, 156, 56)";
                            break;
                        
                        case 'Days30_agenda':
                            $color = "rgb(240, 151, 36)";
                            break;
                        
                        
                        default:
                            # code...
                            break;
                    }
                    
                ?>
                <div class="agenda-container" style="border-left-color: <?php echo $color?>;">
                    <div class="d-flex justify-content-end" >
                        <form action="" method="POST">
                            <a href="index.php?action=Modify&agenda=<?php echo $i?>&category=<?php echo $category?>">
                                <img src="https://img.icons8.com/stickers/512/edit.png" alt=""
                                style="width:24px; height: auto; margin-right: 5px;">
                            </a>
                            <a href="index.php?action=DeleteMessage&agenda=<?php echo $i?>&category=<?php echo $category?>">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Red_x.svg" alt=""
                                style="width:20px; height: auto; margin-right: 5px;" ></a>
                            
                        </form>
                    </div>
                    <p class="task-agenda"><?php echo htmlentities($CurrPlanner[0]);?></p>
                    <p class="subject-agenda" style="color: red;"><?php echo htmlentities($CurrPlanner[1]);?> -
                    <span class="date-agenda"> <?php echo htmlentities($CurrPlanner[2]);?></span></p>
                
                </div>
            <?php
                
                }

            ?>
        <?php
            }
            
           
            
            ?>
            
        </div>
        <?php
        
        }
        ?>
    </div>
    
    
    

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>