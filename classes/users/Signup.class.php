<?php


class Signup extends DbCon {

    protected function setUser($username, $password, $newpassword) {

        $hashedNewpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        // set_exception_handler(function(Exception $e) {
        //     echo 'ahmed ghnam exception handler';
        // });
        $stmt = $this->StarCon()->prepare('SELECT UserName, PassWord, SignStatus FROM users WHERE UserName = ? LIMIT 1');
        $stmt->execute([$username]);
        $count = $stmt->rowCount();
        if($count > 0) {
            $user = $stmt->fetch();
            if($user['SignStatus'] == 1) {
                $stmt = null;
                $this->errors = ['userexist' => 'هذا المستخدم مسجل بالفعل'];
            } else {
                if(password_verify($password, $user['PassWord'])) {
                    $stmt = $this->StarCon()->prepare('UPDATE users SET PassWord = ?, SignStatus = 1 WHERE UserName = ?');
                    $stmt->execute(array($hashedNewpassword, $username));
                    $count = $stmt->rowCount();
                    if($count > 0) {
                        $this->successMsg = 'تم التسجل بنجاح يمكنك الان تسجيل الدخول';
                    }
                }

            }
            
        } 
    } 



    /// This Used With Select Box Fields SignUp Form

    // protected function checkUserExist($username, $password) {
    //     $stmt = $this->StarCon()->prepare('SELECT UserName, PassWord FROM users WHERE UserName = ? AND PassWord = ? LIMIT 1');
    //     $stmt->execute(array($username, $password));
    //     $count = $stmt->rowCount();
    //     if($count > 0) {
            
    //         $stmt = null;
    //         $this->errors = ['userexist' => 'هذا المستخدم مسجل بالفعل'];
    //         header('Location: employees.php');
    //         exit();
    //     } else {
    //         return false;
    //     }
    // } 

    // protected function setUser($username, $password) {
    //     $stmt = $this->StarCon()->prepare('UPDATE users SET PassWord = ? WHERE UserName = ?');
    //     $stmt->execute(array($password, $username));
    //     $count = $stmt->rowCount();
    //     if($count > 0) {
    //         $this->successMsg = 'تم التسجيل بنجاح يمكنك الان تسجيل الدخول';
    //     } else {
    //         $this->errors= ['signupError' => 'هناك مشكلة ف التسجيل'];
    //     }
    // }


    

}



?>