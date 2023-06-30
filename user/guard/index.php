<?php require('../../env/error_reporting.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="$_GET['msg'] == ''viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Guard Login</title>
    <link rel="stylesheet" href="../../styles/styles.min.css">
</head>
<body>
    <main id="home">
        <div class="divider">
            <div class="divider_container">
                <div class="form_container">
                    <img 
                        class="arusha-technical-collage-logo" 
                        src="../../store/Atc_logo.png" 
                        alt=""
                    />
                    <h2>Guard Login</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore dicta vitae deleniti in, autem libero.</p>
                    <form action="../../process/login.php" method="POST" class="login_form">
                        <div class="form_group">
                            <label for="guard_id">Guard ID</label>
                            <input type="text" name="guard_id">
                        </div>
                        <div class="form_group">
                            <label for="password">Password</label>
                            <input type="password" name="password">
                        </div>
                        <div class="form_group">
                            <button type="submit">Login</button>
                        </div>
                        <div class="form_group">
                            <div class="feedback 
                                <?php 
                                    if(isset($_GET['msg'])){
                                        
                                        if(isset($_GET['s'])){
                                            echo "success";
                                        }else{
                                            echo "failure";
                                        }
                                    }
                                ?>"
                            >
                                <?php 
                                    if(isset($_GET['msg'])){
                                        echo base64_decode($_GET['msg']);
                                    }else{
                                        echo "feedback message";
                                    }
                                ?>  
                            </div>
                        </div>
                        <div id="redirect" class="form_group">
                            <a href="../../">Return Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="divider">
            <div class="divider_container">
                <!-- <img id="hero_image" src="../../store/arusha-technical-collage.png" alt=""> -->
                <!-- <img id="hero_image" src="../../store/hero_images/hero_security_3.jpg" alt=""> -->
                <!-- <img id="hero_image" src="../../store/hero_images/hero_security_2.jpg" alt=""> -->
                <img id="hero_image" src="../../store/hero_images/hero_security_1.jpg" alt="">
                <div id="hero">
                    <!-- <img src="" alt="">
                    <h3>Student Identification System</h3>
                    <p>Quas quibusdam explicabo accusamus accusantium exercitationem, id voluptatem, incidunt optio! Vero quibusdam placeat expedita nisi, consectetur facere.</p>
                    <p>Consectetur quia fugit veritatis, quas quibusdam explicabo accusamus accusantium exercitationem, id voluptatem, incidunt optio! Vero quibusdam placeat expedita nisi, consectetur facere.</p> -->
                </div>
            </div>
        </div>
    </main>
</body>
</html>