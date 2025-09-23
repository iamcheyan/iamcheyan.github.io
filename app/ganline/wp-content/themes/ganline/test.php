<?php
	/*
	Template Name: test 
	*/ 
?>
<?php get_header(); ?>

<?php
     session_start();
     $username = $_POST['username']."<br>";
     $message  = $_POST['message'];
     $hide     = $_POST['hidden'];
     var_dump($_SESSION);
    if($hide==$_SESSION['conn'])
    {
        echo "亲，提交成功了哦";
    }else
    {
    echo "<script>alert('亲！就知道你会刷新提交，stop 你已经提交成功啦');</script>";
    echo "<script>window.location.href='index.php';</script>";
    }
    session_destroy();
?>