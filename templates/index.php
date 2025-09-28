<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/core/core.php';
includeTemplate('header.php');

?>

    <form class="form" method="post" >
        <input type="text" name="name">
        <button  type="submit" name="submitQuery"><img src="/images/magnifying-glass-silhouette.png">  </button>
    </form>


    <?php

        $user = new User();

        $kuku = $user->findByEmail('admin@example.com');
        if ($kuku) {
            echo "User found: ";
            print_r( $kuku);
        } else {
            echo "User not found";
        }
    ?>
<?php

includeTemplate('footer.php');
?>

