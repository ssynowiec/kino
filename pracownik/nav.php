<nav>
    <div class="container">
        <div class="nav-container" id="nav-container">
            <div class="fixed">
                <a href="../" class="logo">
                    <img src=" ./img/popcorn-logo.png" alt="popcorn logo kina" class="logo-img">
                    <p class="logo-text">Nasze <span>kino</span></p>
                </a>
                <button class="burger-menu" aria-label="burger-menu" id="burger-menu"><img
                        src="./img/icons/menu.svg" class="burger-icon" alt=""></button>
            </div>
            <div class="navbar" id="navbar">
                <?php
                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == true && isset($_SESSION['admin']) && $_SESSION['admin'] != '') {
                        echo '<a href="./" class="nav-link">Dashboard</a>';
                        echo '<a href="./films.php" class="nav-link">Filmy</a>';
                        echo '<a href="./seanse.php" class="nav-link">Seanse</a>';
                        echo '<a href="./logout.php" class="nav-link">Wyloguj się</a>';
                    } else {
                        echo '';
                    }
                ?>
                <!-- <a href="./buy-ticket.php" class="btn-buy">
                    <img src="./img/icons/tickets.png" alt="tickets icon" class="icon">
                    Kup bilet
                </a> -->
            </div>
        </div>
    </div>
</nav>