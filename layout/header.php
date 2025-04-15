<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/noto-kufi-arabic" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="http://gregfranko.com/jquery.selectBoxIt.js/css/jquery.selectBoxIt.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $css ?>style.css" />
    <title>Document</title>
</head>
<body dir="rtl" class="parallax-bg header" data-bgurl="images/2.png" >
    <!-- <div class="layout"></div> -->

<?php 

    if(!isset($noNavbar)) {
?>
        
<nav dir="ltr" class="navbar navbar-star fixed-top <?php if(htmlspecialchars($_SERVER['PHP_SELF']) == '/Star/employees.php') {echo 'employees';}?> navbar-expand-lg bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/star.png" alt=""></a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">الصفحة الرئيسية</a>
                </li>
                <?php if(!isset($_SESSION['UserName'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="employees.php">العاملين</a>
                    </li>
                <?php } ?>
        <?php if(isset($_SESSION['UserName'])) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    اهلا <?php echo $_SESSION['UserName']; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
                    <li><a class="dropdown-item" href="#">لوحة التحكم</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="nav-link" href="logout.php">تسجيل الخروج</a></li>
                </ul>
            </li> 
        <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<?php } ?>