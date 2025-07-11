<style>
    .navbar {
        background-color: #151614 !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
        color: white !important;
    }

    .navbar .nav-link:hover,
    .navbar .navbar-brand:hover {
        color: #cccccc !important;
        /* optional: helleres Weiß beim Hover */
    }

    .navbar .navbarmargin {
        margin-left: 35px;
        margin-right: 35px;
    }

    .full-line {
        border-top: 1px solid #53773D;
        /* margin: 20px auto; */
        width: 100% !important;

    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid navbarmargin">
        <a class="navbar-brand" href="">
            <img src="assits/img/logo.png" alt="" width="50" height="44" class="d-inline-block align-text-top">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=allmixes">All Mixes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=mixcalculator">Mix Calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=reversecalculator">Reverse Calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=mixinghelp">Mixing Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=shedulearchiv">Schedule Archiv</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="index.php?page=test">test</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
<div class="full-line"></div>