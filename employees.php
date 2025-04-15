<?php
    ob_start();
    session_start();
    include('init.php');
    include ( $lay . 'header.php');

    // set_exception_handler(function($e) {
    //     echo 'ahmed ghnam exception handler';
    // });
   

$noNavbar = "";
// $noFooter = "";
    if(isset($_SESSION['UserName']) && $_SESSION['GroupId'] == 1) {
        // header('Location : index.php');
        echo 'U Are Admin';

    } else {
        
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signupForm'])) {
    
        $username = htmlspecialchars($_POST['signupName']);
        $password = $_POST['signupPass'];
        $newpassword = $_POST['newSignupPass'];
        

        include "classes/dbConnect.class.php";
        include "classes/Signup.class.php";
        include "classes/Signupctrl.class.php";

        $user = new SignupCtrl($username, $password, $newpassword);
        $user->signupUser();
        $errors = $user->validateForm();

        
        
        

        // $stmt = $starCon->prepare('SELECT
        //                                     UserName, PassWord
        //                                 FROM
        //                                     users
        //                                 WHERE
        //                                     UserName = ?
        //                                 AND
        //                                     PassWord = ?
        //                                 LIMIT 1');
        // $stmt->execute(array($username, $password));
        // $count = $stmt->rowCount();

        // if($count > 0) {
        //     $stmt = $starCon->prepare('UPDATE
        //                                 users
        //                             SET
        //                                 PassWord = ?,
        //                                 SignStatus = 1
        //                             WHERE
        //                                 UserName = ?
        //                                 ');
        //     $stmt->execute(array($newpassword, $username));
        // }
                                    

    } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginForm'])) {
        
        $username = $_POST['loginName'];
        $password = sha1($_POST['loginPass']);
        
        $stmt = $starCon->prepare('SELECT
                                            UserName, ID, PassWord, GroupId
                                        FROM
                                            users 
                                        WHERE
                                            UserName = ? 
                                        AND 
                                            PassWord = ?
                                        LIMIT 1');
        $stmt->execute(array($username, $password));
        $count = $stmt->rowCount();
        $row   = $stmt->fetch();


        if($count > 0) {
            $_SESSION['UserName'] = $username;
            $_SESSION['PassWord'] = $password;
            $_SESSION['GroupId']  = $row['GroupId'];
            header('Location: index.php');
            exit();
        }
    }

    $stmt2 = $starCon->prepare('SELECT * FROM users');
    $stmt2->execute();
    $users = $stmt2->fetchAll();

?>

<div class="employees-form">
    <div class="overlay">
        <div class="container">
            <div class="form-container">
                <h1>
                    <span class="s" data-class="signUp">مستخدم جديد</span> | 
                    <span class="l selected" data-class="login">تسجيل الدخول</span>
                </h1>

                <!-- Start LogIn Form -->

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="login" method="POST">
                    <!-- Print Error if The User Is Already Exist -->
                    <?php if(isset($_POST['signupForm']) && isset($errors['userexist'])) { ?>
                            <div class="alert alert-danger"><?php echo $errors['userexist']; ?></div>
                        <?php } ?>
                        <!-- Print Error if The User Is Already Exist -->
                    
                        <!-- Print Success Message If The User Registered Successfully -->
                         <?php if(is_object($user) && !empty($user->getSuccessMsg())) { ?>
                            <div class="alert alert-success"><?php  echo $user->getSuccessMsg(); ?></div>
                         <?php  } ?>
                        <!-- Print Success Message If The User Registered Successfully -->
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" name="loginName" value="<?php echo isset($_POST['loginName']) ?  htmlspecialchars($_POST['signupName']) : ''; ?>" placeholder="اسم المستخدم" autocomplete="off">
                    </div> 
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="loginName" placeholder="كلمة السر" autocomplete="new-password">
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg" name="loginForm" value="تسجيل الدخول">
                </form>

                <!-- End LogIn Form -->
        
                <!-- Start Signup Form -->

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="signUp" method="POST">
                    <?php if(isset($_POST['signupForm']) && isset($errors['userexist'])) { ?>
                        <div class="alert alert-danger"><?php echo $errors['userexist']; ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" name="signupName" value="<?php echo isset($_POST['signupName']) ?  htmlspecialchars($_POST['signupName']) : ''; ?>" placeholder="اسم المستخدم" autocomplete="off">
                    </div>
                    <?php if(isset($_POST['signupForm'])) {
                            if(!empty($errors['username'])) { ?>
                            <div class="alert alert-danger">
                                <?php
                                    foreach($errors['username'] as $error) {
                                        echo $error . '<br>';
                                    }
                                ?>    
                            </div>
                    <?php }} ?>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="signupPass" placeholder="كلمة السر" autocomplete="new-password">
                    </div>
                    <?php if(isset($_POST['signupForm'])) {
                            if(!empty($errors['oldpassword'])) { ?>
                            <div class="alert alert-danger">
                                <?php
                                    foreach($errors['oldpassword'] as $error) {
                                        echo $error . '<br>';
                                    }
                                ?>    
                            </div>
                    <?php }} ?>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="newSignupPass"  title="يجب ان يكون اكثر من 4 حروف وارقام " placeholder="كلمة السر الجديدة" autocomplete="new-password">
                    </div>
                    <!-- pattern="[A-Za-z0-9_]{4,}" -->
                    <?php if(isset($_POST['signupForm'])) {
                            if(!empty($errors['newpassword'])) { ?>
                            <div class="alert alert-danger">
                                <?php
                                    foreach($errors['newpassword'] as $error) {
                                        echo $error . '<br>';
                                    }
                                ?>    
                            </div>
                    <?php }} ?>
                    <input type="submit" class="btn btn-success btn-lg btn-block" name="signupForm" value="انشاء حساب">
                </form>
                <!-- End Signup Form -->

            </div>
        </div>
    </div>
</div>




<?php
    }
    include( $lay . 'footer.php');
    ob_end_flush(); 
?>