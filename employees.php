<?php
    ob_start();
    session_start();

    include('init.php');
    include ( $lay . 'header.php');

$noNavbar = "";
// $noFooter = "";
    if(isset($_SESSION['UserName']) && $_SESSION['GroupId'] == 1) {
        // header('Location : index.php');
        echo 'U Are Admin';

    } else {

    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signupForm'])) {
    
        $username = $_POST['signupName'];
        $password = sha1($_POST['signupPass']);
        $newpassword = sha1($_POST['newSignupPass']);

        $stmt = $starCon->prepare('SELECT
                                            UserName, PassWord
                                        FROM
                                            users
                                        WHERE
                                            UserName = ?
                                        AND
                                            PassWord = ?
                                        LIMIT 1');
        $stmt->execute(array($username, $password));
        $count = $stmt->rowCount();

        if($count > 0) {
            $stmt = $starCon->prepare('UPDATE
                                        users
                                    SET
                                        PassWord = ?,
                                        SignStatus = 1
                                    WHERE
                                        UserName = ?
                                        ');
            $stmt->execute(array($newpassword, $username));
        }
                                    

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
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="login" method="POST">
                    <div class="form-group">
                        <select name="loginName">
                            <?php 
                            foreach($users as $user) {
                                if($user['SignStatus'] == 1) {
                                    echo '<option value=\'';
                                        if($user['SignStatus'] == 1) {echo $user['UserName'];}
                                        echo '\'>'; 
                                        if($user['SignStatus'] == 1) {echo $user['UserName'];}
                                    echo '</option>';
                                }
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="loginPass" placeholder="كلمة السر" autocomplete="new-password">
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg" name="loginForm" value="تسجيل الدخول">
                </form>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="signUp" method="POST">
                    <div class="form-group">
                        <select name="signupName">
                            <?php 
                                foreach($users as $user) {
                                    if($user['SignStatus'] == 0) {
                                        echo '<option value=\'';
                                            if($user['SignStatus'] == 0) {echo $user['UserName'];}
                                            echo '\'>'; 
                                            if($user['SignStatus'] == 0) {echo $user['UserName'];}
                                        echo '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="signupPass" placeholder="كلمة السر" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="newSignupPass" placeholder="كلمة السر الجديدة" autocomplete="new-password">
                    </div>
                    <input type="submit" class="btn btn-success btn-lg btn-block" name="signupForm" value="انشاء حساب">
                </form>
            </div>
        </div>
    </div>
</div>




<?php
    }
    include( $lay . 'footer.php');
    ob_end_flush(); 
?>