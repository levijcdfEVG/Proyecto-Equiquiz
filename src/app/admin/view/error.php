<?php
    if(isset($_GET)){
        $error = $_GET['error'];
    }
?>

<div id="error">
    <?php echo $error; ?>
    <a href="index.php">Volver</a>
</div>