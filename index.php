<?php
// Sitzung nur starten, wenn noch keine Sitzung aktiv ist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// EINBINDER VERSCHIEDENER FILES
require_once('App/Config/dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Schedule</title>

    <!-- Libraries include -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- #TODO META FILE -->

    <!-- CSS-File -->
    <link rel="stylesheet" href="assits/css/global.css">

</head>

<style>
    body {
        min-height: 100vh !important;
        display: flex;
        flex-direction: column;
        background-color: #1f1f1f !important;
    }

    html,
    body {
        background: #1f1f1f !important;
    }

    #content {
        flex: 1;
    }
</style>

<body>
    <?php
    // header("Location: index.php?page=home");

    $page = '404.php';
    $frontend = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) ?? 'home';


    // $content = '';

    // Switch-Case für die Frontend-Seiten
    switch ($frontend) {

        case 'home':
            $page = 'home.php';
            break;

        //-------------------------------------------------------------------

        case 'allmixes':
            $page = 'allmixes.php';
            break;

        //-------------------------------------------------------------------

        case 'mixcalculator':
            $page = 'mixcalculator.php';
            break;

        //-------------------------------------------------------------------

        case 'reversecalculator':
            $page = 'reversecalculator.php';
            break;


        //-------------------------------------------------------------------

        case 'shedulearchiv':
            $page = 'shedulearchiv.php';
            break;

        //-------------------------------------------------------------------

        case 'mixinghelp':
             $page = 'mixinghelp.php';
             break;

        //-------------------------------------------------------------------

        case 'impressum':
            $page = 'impressum.php';
            break;

        //-------------------------------------------------------------------

        // END
        // Ab hier beginnt test Page

        // case 'test':
        //     $page = 'test.php';
        //     break;

        //-------------------------------------------------------------------


        // 404 Landing Page by Error
        // muss immer hinzugefügt werden, da die ($page) als varibale 404.php hat!!!
        case '404':
            $page = '404.php';
            break;

        //-------------------------------------------------------------------
        //-------------------------------------------------------------------
        // ENDE DES SWITCH / CASE MODEL
        default:
            $page = '404.php';
    }

    //----------------------------------------------------------------------------------------------------------------------------

    // EINBINDER NAVBAR
    include "includes/navbar.php";

    // Wrapper für den flexiblen Inhaltsbereich
    echo '<div id="content" class="flex-grow-1">';

    // Einbindung der jeweiligen Frontend-Page
    require_once 'src/template/' . $page;

    echo '</div>'; // Ende von #content

    // EINBINDER des Footer's
    include "includes/footer.php";


    // EINBINDER der Copyrights
    // include "includes/copyrights.php";

    // ---------------------------------------------------------



    ?>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script> LIST.JS Libary
    <!-- LIST.JS Libary -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

</body>

</html>