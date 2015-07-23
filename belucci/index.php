<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Minecraft Belucci - Serveur FTB</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"><a href="#">Ressources</a>
                </li>
                <li><a href="http://www.mediafire.com/download/1m5vhyyx6s8ju4a/gregtech_config.rar">Gregtech_config</a>
                </li>
                <li><a href="http://www.mediafire.com/download/iy53w63ks3kdf9r/Gregtechmod+4.07o.zip">Gregtech_Mod</a>
                </li>
                <li><a href="http://www.creeperrepo.net/direct/FTB2/3338a2f292fc3181ee205795379f5500/launcher%5EFTB_Launcher.exe">Launcher Feed The Beast</a>
                </li>
                <li><a href="http://team76.net/">Team76</a>
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="content-header">
                <h1>
                    <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
                    Minecraft Belucci - FTB
                </h1>
            </div>
            <div class="page-content inset">
                
                        <?php
    // Edit this ->
    define( 'MQ_SERVER_ADDR', '92.222.144.167' );
    define( 'MQ_SERVER_PORT', 25566 );
    define( 'MQ_TIMEOUT', 1 );
    // Edit this <-
    
    // Display everything in browser, because some people can't look in logs for errors
    Error_Reporting( E_ALL | E_STRICT );
    Ini_Set( 'display_errors', true );
    
    require __DIR__ . '/MinecraftQuery.class.php';
    
    $Timer = MicroTime( true );
    
    $Query = new MinecraftQuery( );
    
    try
    {
        $Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
    }
    catch( MinecraftQueryException $e )
    {
        $Exception = $e;
    }
    
    $Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>

<?php if( isset( $Exception ) ): ?>
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo htmlspecialchars( $Exception->getMessage( ) ); ?></div>
            <p><?php echo nl2br( $e->getTraceAsString(), false ); ?></p>
        </div>
<?php else: ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Informations serveur</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
<?php foreach( $Info as $InfoKey => $InfoValue ): ?>
                        <tr>
                            <td><?php echo htmlspecialchars( $InfoKey ); ?></td>
                            <td><?php
    if( Is_Array( $InfoValue ) )
    {
        echo "<pre>";
        print_r( $InfoValue );
        echo "</pre>";
    }
    else
    {
        echo htmlspecialchars( $InfoValue );
    }
?></td>
                        </tr>
<?php endforeach; ?>
<?php else: ?>
                        <tr>
                            <td colspan="2">Aucune information reçu/td>
                        </tr>
<?php endif; ?>
                    </tbody>
                </table>
            </div>
                       <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Joueurs</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): ?>
                        <tr>
                            <td><?php echo htmlspecialchars( $Player ); ?></td>
                        </tr>
<?php endforeach; ?>
<?php else: ?>
                        <tr>
                            <td>Aucun joueur en connecté</td>
                        </tr>
<?php endif; ?>
                    </tbody>
                </table>
            </div>
 
        </div>
<?php endif; ?>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
</body>

</html>
