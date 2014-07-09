<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BonesCraft!</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    
    <script type="text/javascript" src='/dist/js/jquery-2.1.0.min.js'></script>
    <script type="text/javascript" src='/dist/js/bootstrap.js'></script>




  </head>

  <body style="background-image:url('mcbg.jpg'); background-repeat:no-repeat;
background-attachment:fixed;
background-position:center;
background-size: cover;">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php $_SERVER['SERVER_NAME'];?>">BonesCraft!</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#status" data-toggle="tab">Status</a></li>
            <li><a href="#players" data-toggle="tab">Players</a></li>
            <li><a href="#mods" data-toggle="tab">Mods</a></li>
            <li><a href="/map">Map</a></li>
            <li><a href="#contact" data-toggle="tab">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="tab-content">
	<div id="status" class="tab-pane active">
		<div class="container">
			<div class="starter-template">
			<?php
			    require 'Classes/MinecraftQuery.class.php';

			    $Query = new MinecraftQuery( );

			    try
			    {
				$Query->Connect( $server_ip, $server_query_port );
				$ServerInformaiton = $Query->GetInfo( );

				?>
					<h2>Server On-Line</h2>
					<div class="list-group">
					  <a href="#" class="list-group-item">
					    <h4 class="list-group-item-heading">Server Name</h4>
					    <p class="list-group-item-text"><?php echo $ServerInformaiton['HostName']; ?></p>
					  </a>
					  <a href="#" class="list-group-item">
					    <h4 class="list-group-item-heading">Max Players</h4>
					    <p class="list-group-item-text"><?php echo $ServerInformaiton['MaxPlayers']; ?></p>
					  </a>
					  <a href="#" class="list-group-item">
					    <h4 class="list-group-item-heading">Version</h4>
					    <p class="list-group-item-text"><?php echo $ServerInformaiton['Version']; ?></p>
					  </a>
					</div>

				<?php
			    }
			    catch( MinecraftQueryException $e )
			    {
				echo $e->getMessage( );
			    }
			?>
			</div>
		</div>	
	</div>
<div id="players" class="tab-pane">
		<div class="container">
			<div class="starter-template">
<h2>Players</h2>
<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $ServerInformaiton['Players']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $ServerInformaiton['MaxPlayers']; ?>" style="width: <?php echo $ServerInformaiton['Players']; ?>%;">
    <?php echo $ServerInformaiton['Players']; ?> of <?php echo $ServerInformaiton['MaxPlayers']; ?>
  </div>
</div>

<?php print_r( $Query->GetPlayers( ) ); ?>

</div>
</div>
</div>
        <div id="mods" class="tab-pane">
            <div class="container">
                <div class="starter-template">
                 <h2>Current Forge Version</h2>
                 <ul class="list-group">
<?php
                          $directory = $server_base_directory . 'installer/';
                          $scanned_directory = array_diff(scandir($directory), array('..', '.'));
                          $exclude_list = array("Dynmap-1.9.3-forge-10.12.0.jar");

                          foreach ($exclude_list as &$item) {
                              $key = array_search($item, $scanned_directory);
                              if($key){
                                  unset($scanned_directory[$key]);
                              }
                          }
                           foreach ($scanned_directory as &$item) {
                                  if(strpos($item, 'installer.jar')){
                                  echo "<li class='list-group-item'><a href='/installer/" . $item . "'>". $item ."</a></li>";
                                  }
                          }

?>		
                 </ul> 

		<h2>Active Mods</h2>

		 <ul class="list-group">
                          <?php
                          $directory = $server_base_directory . 'mods/';
                          $scanned_directory = array_diff(scandir($directory), array('..', '.'));
                          $exclude_list = array("Dynmap-1.9.3-forge-10.12.0.jar");

                          foreach ($exclude_list as &$item) {
                              $key = array_search($item, $scanned_directory);
                              if($key){
                                  unset($scanned_directory[$key]);
                              }
                          }

                          foreach ($scanned_directory as &$item) {
                                  if(strpos($item, '.jar')){
                                  echo "<li class='list-group-item'><a href='/mods/" . $item . "'>". $item ."</a></li>";
                                  }
			 	  if(strpos($item, '.zip')){
                                  echo "<li class='list-group-item'><a href='/mods/" . $item . "'>". $item ."</a></li>";
                                  }
                          }

                          ?>
                  </ul>

                </div>

              </div>
        </div>
        <div id="status" class="tab-pane">
            <p>Other</p>
        </div>
    </div>
      
      
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
  </body>
</html>
