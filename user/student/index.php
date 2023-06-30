<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Student registration</title>
    <link rel="stylesheet" href="../../styles/styles.min.css">
    <script src="../../scripts/register_students.js" defer></script>
    <script src="../../scripts/image_preview.js" defer></script>
</head>
<body>
    <main id="home">
        <div class="divider">
            <div class="divider_container">
                <div class="form_container">
                    <img 
                        class="arusha-technical-collage-logo" 
                        src="../../store/Atc_logo.png" 
                        alt="Arusha technical college Logo"
                    />
                    <h2>Student registration</h2>
                    <p>Student's ID barcode scanning will provide information filled below to college's guard on duty.</p>
                    <form action="../../process/register_student.php" method="POST" class="login_form multistep" enctype="multipart/form-data">
                        <div id="steps_container">
                            <div id="step1" class="step">
                                <div class="form_group">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" />
                                </div>
                                <div class="form_group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" />
                                </div>
                                <div class="form_group">
                                    <button id="step1nextBtn" class="nextBtn">Continue</button>
                                </div>
                            </div>
                            <div id="step2" class="step">
                                <div class="form_group">
                                    <label for="adm_no">Admission number</label>
                                    <input type="number" name="adm_no" maxlength="11"/>
                                </div>
                                <div class="form_group">
                                    <label for="course">Course</label>
                                    <input type="text" name="course" />
                                </div>
                                <div class="form_group buttons">
                                    <button id="step2backBtn" class="backBtn">Back</button>
                                    <button id="step2nextBtn" class="nextBtn">Continue</button>
                                </div>
                            </div>
                            <div id="step3" class="step">
                                <div class="form_group">
                                    <div id="profile_image">
                                        <span>DP</span>
                                        <img alt="student's profile picture" />
                                    </div>
                                    <p id="image_picker">Click to choose image</p>
                                    <input type="file" name="profile_picture" id="dpInputFile">
                                </div>
                                <div class="form_group buttons">
                                    <button id="step3backBtn" class="backBtn">Back</button>
                                    <button  id="step3finalBtn" type="submit">Register</button>
                                </div>
                            </div>
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
                <img id="hero_image" src="../../store/hero_images/hero_students_1.jpg" alt="">
                <!-- <img id="hero_image" src="../../store/hero_images/hero_students_2.jpg" alt=""> -->
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