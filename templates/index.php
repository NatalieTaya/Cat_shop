<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/core/core.php';
includeTemplate('header.php');

?>

    <form class="form" method="post" >
        <input type="text" name="name">
        <button  type="submit" name="submitQuery"><img src="/public/css/magnifying-glass-silhouette.png">  </button>
    </form>


    <?php

        
    ?>
<?php

includeTemplate('footer.php');
?>

