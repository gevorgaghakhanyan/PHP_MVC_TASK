<?php
/* @var $content_for_layout */

?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <title>PHP_MVC_task</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/tasks/index">PHP MVC Task</a>
    <?php
    if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == false){
        echo '<a class="navbar-brand float-right ml-lg-5" href="/users/index">Log in</a>';
    }else{
        echo '<a class="navbar-brand float-right ml-lg-5" href="/users/log_out">Log Out</a>';
    }
    ?>

</nav>
<div class="container container-body">
    <div class="content">
        <?php
            echo $content_for_layout;
        ?>
    </div>
</div>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
