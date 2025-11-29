<?php 
    ob_start();
    session_start();

    include('init.php');
    include($lay . 'header.php');

    

    

?>

    
    <!-- <div class="category-holder">
        <ul class="adel">
            <div class="row">
                <li class="col-sm-1">بقالة بالوزن</li>
                <li class="col-sm-1">بقالة جافة</li>
                <li class="col-sm-1">مجمدات</li>
            </div>
        </ul>
    </div> -->
    <div class="ahmed">
        <div class="container text-center">
            <div class="row box-container">
                <div class="col-6 col-md-4">
                    <div class="box">
                        <a href="users">link</a>
                        <div class="img-con">
                            <!-- <img src="images/img-frame.png" class="frame-img" alt=""> -->
                            <img src="images/crystal.png" alt="">
                        </div>
                    </div>
                </div>
            
                <div class="col-6 col-md-4">
                    <div class="box">
                        <div class="img-con">
                            <!-- <img src="images/img-frame.png" class="frame-img" alt=""> -->
                            <img src="images/crystal.png" alt="">
                        </div>
                        <!-- <ul>
                            <li>بلانك 5 لتر</li>
                            <li>السعر : 50</li>
                            
                        </ul> -->
                    </div>
                </div>
           
                <div class="col-6 col-md-4">
                    <div class="box">
                        <div class="img-con">
                            <!-- <img src="images/img-frame.png" class="frame-img" alt=""> -->
                            <img src="images/crystal.png" alt="">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    
    
    
    
    
    
    
    <?php 
        include( $lay . 'footer.php'); 
        ob_end_flush();
    ?>

</html>