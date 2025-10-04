

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/header.css">
    <link rel="stylesheet" href="/public/css/footer.css">
    <link rel="stylesheet" href="/public/css/extended_search.css">

    <script src="/public/js/scroll.js"> </script>

    <title>Document</title>

</head>

<body>
    
    <header class="header">
        <div class='background'>
            <img src="public\css\chad_9809faf37fc54322b85f654b1f336ae9.png" alt="">
        </div>

        <div class="nav-container">
            <h1 class=' title'>Store</h1>

            <ul class="navbar-nav"> 
                <li class="nav-item">    <a href="/">Главная</a>     </li>
                <?php if (!isset($_SESSION['auth']) ) {?>
                <li class="nav-item">    <a href="/login">Войти</a>  </li>
                <li class="nav-item">    <a href="/register">Зарегистрироваться</a>  </li>
                <?php } else if (isset($_SESSION['auth']) && User::isAdmin($_SESSION['id']) ){?>
                <li class="nav-item">    <a href="/cart">Корзина</a>     </li> 
            </ul>
            <ul class="navbar-nav"> 
                <li class="nav-item">    <a href="/admin">Добавить товар</a>     </li>
                <li class="nav-item">    
                    <form action="/logout" method="post" >
                        <button type="submit" name="logout">
                            Выйти
                        </button>
                    </form>
                </li>
                <?php } else if (isset($_SESSION['auth']) && ! (User::isAdmin($_SESSION['id']) )) {?>
                <li class="nav-item">    <a href="/cart">Корзина</a>     </li>
            </ul>    
            <ul class="navbar-nav"> 
                <li class="nav-item">    
                    <form action="/logout" method="post" >
                        <button type="submit" name="logout">
                            Выйти
                        </button>
                    </form>
                </li>
                <?php } ?>
            </ul>
            
        </div>
    </header>


   
