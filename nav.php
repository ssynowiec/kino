<nav>
    <div class="container">
        <div class="nav-container" id="nav-container">
            <div class="fixed">
                <a href="./" class="logo">
                    <img src=" ./img/popcorn-logo.png" alt="popcorn logo kina" class="logo-img">
                    <p class="logo-text">Nasze <span>kino</span></p>
                </a>
                <button class="burger-menu" aria-label="burger-menu" id="burger-menu"><img
                        src="./img/icons/menu.svg" class="burger-icon" alt=""></button>
            </div>
            <div class="navbar" id="navbar">
                <a href="./repertuar.php" class="nav-link">Repertuar</a>
                <a href="./contact.php" class="nav-link">Kontakt</a>
                <?php
                    if ((isset($_SESSION['logged']) && $_SESSION['logged'] == true) && (isset($_SESSION['user']) && $_SESSION['user'] != '')) {
                        echo '<a href="./dashboard.php" class="nav-link">Moje dane</a>';
                        echo '<a href="./logout.php" class="nav-link">Wyloguj się</a>';
                    } else {
                        echo '<a href="./login.php" class="nav-link">Mój bilet</a>';
                    }
                ?>
                <a href="./buy-ticket.php" class="btn-buy">
                    <img src="./img/icons/tickets.png" alt="tickets icon" class="icon">
                    Kup bilet
                </a>
            </div>
        </div>
    </div>
</nav>