
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add task</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styleTasks.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../dates.js"></script> -->
</head>
<body>
    <!-- add task -->
    <?php
    $var_value = $_GET['add'];
    // echo "value is ". $var_value;

    ?>

    <div class="container">

    <?php
        if ($var_value == "TODAY")
        {
            $title = "Today's Agenda";
            $min = new DateTime();
            // $min->modify("-1 days");
            $max = new DateTime();
            
            
        }
        elseif ($var_value == "TOMORROW"){

            $title = "Tomorrow's Agenda";
            $min = new DateTime();
            $min->modify("+1 days");
            $max = new DateTime();
            $max->modify("+2 days");

            
        }
        elseif ($var_value == "IN 2 DAYS"){
            $title = "Agenda In 2 Days";
            $min = new DateTime();
            $min->modify("+2 days");
            $max = new DateTime();
            $max->modify("+3 days");

          
        }
        elseif ($var_value == "WITHIN THE WEEK"){
            $title = "Agenda Within The Week";
            $min = new DateTime();
            // $min->modify("+2 days");
            $max = new DateTime();
            $max->modify("+8 days");
            
        }
        elseif ($var_value == "WITHIN 14 DAYS"){
            $title = "Agenda Within 2 Weeks";
            $min = new DateTime();
            // $min->modify("+2 days");
            $max = new DateTime();
            $max->modify("+15 days");
           
        }
        elseif ($var_value == "WITHIN 30 DAYS"){
            $title = "Agenda Within 30 Days";
            $min = new DateTime();
            $min->modify("+1 days");
            $max = new DateTime();
            $max->modify("+31 days");
           
        }
        // echo $title;

        echo "<p style='
        color:red;
        font-family: sans-serif;
        text-align: center;
        font-size:calc(24px + 1.3vw);
       
        font-family: testfont;
        font-weight: bold;
        text-shadow:
        3px  3px 0 #000,
       -1px -1px 0 #000,  
        1px -1px 0 #000,
       -1px  1px 0 #000,
        1px  1px 0 #000;
        '>" . $title . "</p>";
     

       
        
        ?>
        <form action="" method="post">
            <div class="d-flex flex-column">

                <div class = "row-1">
                    <p class="input-label" >Enter agenda:</p>
                    <input type="text" placeholder="agenda" name="agenda" >
                </div>    

                <div class = "row-2">
                    <p class="input-label">Enter subject:</p>
                    <input type="text" placeholder="subject" name="subject">

                    
                    <p class="input-label">Enter date:</p>
                    <!-- <input type="date" name="date"> -->
                    <input type="date" min=<?php echo $min->format("Y-m-d")?> max=<?php echo $max->format("Y-m-d")?> name="date">
                </div>
                
                
            </div>

            <div class="buttons">
           
                <button class="" name="new_agenda" value="" type="submit">Save</button>
                <!-- <a href="index.php?action=save"><button type="button">save</button></a>   -->
                <button class="" name="reset" value="" type="reset">Clear</button>   
                <a href="index.php"><button type="button">Cancel</button></a>  
                
                     
            </div>
            

        </form>
        <?php
        if ($var_value == "TODAY")
        {
            $var_value = "Today_agenda";
            
        }
        elseif ($var_value == "TOMORROW"){

            $var_value = "Tomorrow_agenda";
            
        }
        elseif ($var_value == "IN 2 DAYS"){
            $var_value = "Days2_agenda";
          
        }
        elseif ($var_value == "WITHIN THE WEEK"){
            $var_value = "Days7_agenda";
            
        }
        elseif ($var_value == "WITHIN 14 DAYS"){
            $var_value = "Days14_agenda";
           
        }
        elseif ($var_value == "WITHIN 30 DAYS"){
            $var_value = "Days30_agenda";
           
        }
        // echo $var_value;

        if(isset($_POST['new_agenda']))
        {
            
            $agenda =  stripslashes($_POST['agenda']);
            $subject =  stripslashes($_POST['subject']);
            $date =  stripslashes($_POST['date']);

            $PlannerRecord = "$agenda ~ $subject ~ $date \n";
            $PlannerFile = fopen("./planners/$var_value.txt", "ab");

            if($PlannerFile == False){
                echo "There was an error saving your message!\n";
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