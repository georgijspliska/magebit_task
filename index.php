<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Magebit Test Task</title>
        <link href="style.css" rel="stylesheet"> 
        <?php require('file.php'); ?>           
    </head>
    <body>        
        <div id="main">
            <div id="menu">
                <div id="logo_div">
                    <img id="logo" src="Image/Union.png" alt="logo">
                    <img id="logo_text" src="Image/pineapple.png" alt="logo_text">
                </div>
                <div id="bars">     
                    <a class="text-normal" href="#">About</a>
                    <a class="text-normal" href="#">How it works</a>
                    <a class="text-normal" href="#">Contact</a>               
                </div>
            </div>  
            <div id="cn">
                <div id="action">                  
                    <img id="cup" <?php echo $img;?> src="Image/ic_success.svg" alt="cup">
                    <h1><?php echo $h1;?></h1>                    
                    <p id="action-p" class="text-normal"><?php echo $text;?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validation()" method="post">
                        <div id="eb" <?php echo $display;?>>
                            <input type="email" class="text-normal" name="email" id="email" placeholder="Type yout email address here...">
                            <input type="submit" name="submit" value="">
                        </div>
                        <div id="err_div">
                            <span class="error text-normal" id="err"><?php echo $Err;?></span>
                        </div>
                        <div id="ct" <?php echo $display;?>>
                            <label class="check_cont">                            
                                <input type="checkbox" id="checkbox" name="tos">
                                <span class="check_span"></span>    
                                <span class="check_span_check"></span>                            
                            </label>   
                            <p id="action-p2" class="text-normal">I agree to <a href="#">terms of service</a></p>                             
                        </div>
                    </form>
                    <hr>
                    <div id="icons">
                        <div class="ico">
                            <a href="#">
                                <span class="div_c" id="fac"></span>
                            </a>
                        </div>
                        <div class="ico">
                            <a href="#">
                                <span class="div_c" id="ins"></span>
                            </a>
                        </div>
                        <div class="ico">
                            <a href="#">
                                <span class="div_c" id="twi"></span>
                            </a>
                        </div>
                        <div class="ico">
                            <a href="#">
                                <span class="div_c" id="you"></span>
                            </a>
                        </div>
                    </div>                    
                </div>       
            </div>   
        </div>  
        <div id="photo">
            <img src="Image/image_summer.png" alt="Summer">
        </div>                   
        <script src="script.js"></script>   
    </body>
</html>