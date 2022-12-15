
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Agenda</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styleTasks.css">
</head>
<body>
    <!-- add task -->
    <?php
    $cat = $_GET['category'];
    $agenda = $_GET['agenda'];
    $PlannerArray = file("./planners/$cat.txt");
    $count = count($PlannerArray);
    $CurrPlanner = explode("~", $PlannerArray[$agenda]);
    $orgDate = $CurrPlanner[2];  
    $newDate = date("Y-m-d", strtotime($orgDate));  
    // echo $cat;
    

    ?>
    <?php
        if ($cat == "Today_agenda")
        {
            $min = new DateTime();
            // $min->modify("-1 days");
            $max = new DateTime();
            
            
        }
        elseif ($cat == "Tomorrow_agenda"){

            $min = new DateTime();
            $min->modify("+1 days");
            $max = new DateTime();
            $max->modify("+2 days");

            
        }
        elseif ($cat == "Days2_agenda"){
            $min = new DateTime();
            $min->modify("+2 days");
            $max = new DateTime();
            $max->modify("+3 days");

          
        }
        elseif ($cat == "Days7_agenda"){
            $min = new DateTime();
            // $min->modify("+2 days");
            $max = new DateTime();
            $max->modify("+8 days");
            
        }
        elseif ($cat == "Days14_agenda"){
            $min = new DateTime();
            // $min->modify("+2 days");
            $max = new DateTime();
            $max->modify("+15 days");
           
        }
        elseif ($cat == "Days30_agenda"){
            $min = new DateTime();
            $min->modify("+1 days");
            $max = new DateTime();
            $max->modify("+31 days");
           
        }
        // echo $min;
        
        ?>

    <div class="container">
        <form action="" method="post">
            <div class="d-flex flex-column">

                <p class="input-label" >Enter agenda:</p>
                <input type="text" name="agenda" value="<?php echo $CurrPlanner[0]?>">

                <p class="input-label">Enter subject:</p>
                <input type="text" placeholder="subject" name="subject" value="<?php echo $CurrPlanner[1]?>">

                <p class="input-label">Enter date:</p>
                <!-- <input type="date" placeholder="agenda" name="date" value=""> -->
                <input type="date" value="<?php echo $newDate;?>" min=<?php echo $min->format("Y-m-d")?> max=<?php echo $max->format("Y-m-d")?> name="date">
                
            </div>

            <div class="d-flex flex-row justify-content-end" style="margin:15px;">
           
                <button class="" name="modified_agenda" value="" type="submit">Save</button>
                <!-- <a href="index.php?action=save"><button type="button">save</button></a>   -->
                <!-- <button class="" name="reset" value="" type="reset">clear</button>    -->
                <a href="index.php"><button type="button">cancel</button></a>  
                
                     
            </div>
            

        </form>
        <?php
        

        if(isset($_POST['modified_agenda']))
        {
            print_r($PlannerArray);
            echo $agenda;
            unset($PlannerArray[$agenda]);
            print_r($PlannerArray);
            $PlannerArray = array_values($PlannerArray);
            if(count($PlannerArray) > 0)
                        {
                            $NewAgenda = implode($PlannerArray);
                            $PlannerStorage = fopen("./planners/$cat.txt", "wb");
        
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
                            unlink("./planners/$cat.txt");
                        }

            $agenda =  stripslashes($_POST['agenda']);
            $subject =  stripslashes($_POST['subject']);
            $date =  stripslashes($_POST['date']);

            $PlannerRecord = "$agenda ~ $subject ~ $date \n";
            $PlannerFile = fopen("./planners/$cat.txt", "ab");

            if($PlannerFile == False){
                echo "There was an error udpating your message!\n";
            }
            else{
                fwrite($PlannerFile, $PlannerRecord);
                fclose($PlannerFile);
                echo "Your agenda has been saved.\n";

            }
            echo "<script>location.href='index.php';</script>";
        }
     

       
        
        ?>
        
        
    </div>
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>