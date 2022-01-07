<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Magebit Test Task</title>
        <?php require('file.php'); ?>    
        <style>
            table, th, td {
                padding: 10px;
                border: 1px solid black;
                border-collapse: collapse;
            }
            #main{
                display: flex;
            }
            form{
                margin-left: 10px;
            }
        </style>    
    </head>
    <body> 
        <div id="main">
            <table>
                <tr>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Delete</th>
                </tr>
                <?php

                    $mainig = Print_Table();
                    $myArr = array();
                    $arrtt = array();  
                    $del_show = 'style="display: none;"';                 

                    function print_data(){

                        global $myArr, $att;

                        for ($x = 0; $x < count($myArr); $x++) {
                            if ($att[$myArr[$x][2]] == 1){
                                if ($_POST['text'] == "" || strpos($myArr[$x][1], $_POST['text']) !== false){ 
                                    echo "<tr><td>".$myArr[$x][0]."</td>";
                                    echo "<td>".$myArr[$x][3]."</td>";
                                    echo '<td> <input type="checkbox" name="del[]" form="my_form" value="'.$myArr[$x][0].'"></td></tr>';
                                }
                            }
                        }
                    }                    
                  
                    for ($x = 0; $x < count($mainig); $x++) {
                        array_push($myArr, array(
                            $mainig[$x][0],
                            strstr($mainig[$x][0], '@', true),
                            substr($mainig[$x][0], strpos($mainig[$x][0],'@')),
                            $mainig[$x][1]
                        ));
                        array_push($arrtt,
                            substr($mainig[$x][0], strpos($mainig[$x][0],'@'))
                        );
                    }    

                    $att = array_count_values($arrtt);
                    foreach ($att as $x => $a) {
                        $att[$x] = 0;
                    }
                    
                    if (isset($_POST['upd'])){

                        if(isset($_POST['box'])) {
                            $att[$_POST['box'][0]] = 1;                        
                        } 
                        else {
                            foreach ($att as $x => $a) {
                                $att[$x] = 1;
                            }                      
                        }
                        if(isset($_POST['rad'])) {
                            if ($_POST['rad']=="name"){
                                sort($myArr);
                                print_data();
                            }
                            else {
                                print_data();
                            }
                            
                        }  
                        $del_show = 'style="display: inline;"';                   
                    }
                    if(isset($_POST['delb'])) {
                        if(isset($_POST['del'])){
                            foreach ($_POST['del'] as $x => $a){
                                Delete_Row($a);
                            }
                        }                    
                    } 
                    
                   
                ?> 
            </table> 
            <form method="post" id="my_form">
                <input type="radio" name="rad" value="name">    
                <label for="name">Sort By Name</label></br> 
                <input type="radio" name="rad" value="date" checked>    
                <label for="date">Sort By Date</label>   
                <hr>
                <?php                    
                    foreach ($att as $x => $a) {
                        echo '<input type="radio" name="box[]" value="'.$x.'">';
                        echo '<label for="'.$x.'">'.$x.'</label></br>';
                    }            
                ?>
                <hr>
                <input type="text" name="text" placeholder="Type email"/></br>
                <hr>
                <input type="submit" name="upd" value="Update"/> 
                <input type="submit" <?php echo $del_show;?> name="delb" value="Delete"/> 
            </form>
        </div>
    </body>
</html>