<?php if(isset($_GET['msg'])){ ?>
    <div id="overlay">
        <div id="dialog" class="overlayFeedbackDialog 
        <?php       
            if(isset($_GET['s'])){
                echo "success";
            }else{
                echo "failure";
            }
        ?>">
            <div class="feedback"> <?php echo base64_decode($_GET['msg']); ?> </div>
        </div>
    </div>
<?php } ?>