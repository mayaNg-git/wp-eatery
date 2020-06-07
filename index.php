<?php include 'header.php';
 date_default_timezone_set("America/New_York");
 ?>
	<?php
	
	include 'MenuItem.php';
	$number_of_items = 6;
	$menuItemArray = Array($number_of_items);

		$i = 0;
		while ($i<$number_of_items)
		{
			if ($i % 2 == 0){
				//echo "i am creating item";
				$menuItemArray[$i] = new MenuItem("The WP Burger","Freshly made all-beef patty served up with homefries -","$14");		
			} else {
				$menuItemArray[$i] = new MenuItem("WP Kebobs","Tender cuts of beef and chicken, served with your choice of side -","$17	");
			}	
		$i++;
		}
		
		
	
	?>
            <div id="content" class="clearfix">
                <aside>
                        <h2><?php echo date("l") . "'s"; ?> Specials</h2>
                        <hr>
						<?php
						$stars = '';
						for ($ii=0; $ii<$number_of_items;$ii++){
							$stars = $stars . '*';
							if ($ii % 2 == 0) {
								echo  '<img src="images/burger_small.jpg" alt="Burger" title="' . date("l") . " #" . ($ii+1) . ' Special - Burger"/>';
							echo '<h3>' . $menuItemArray[$ii]->getMenuItem() . " " . $stars. ($ii+1) .'</h3>' . '<p>' . $menuItemArray[$ii]->getDescription() . $menuItemArray[$ii]->getPrice() . '</p>';
							}else {
								echo '<img src="images/kebobs.jpg" alt="Kebobs" title="' . date("l") . " #" . ($ii+1) . ' WP Kebobs">';
								echo '<h3>'. $menuItemArray[$ii]->getMenuItem() . " " . $stars. ($ii+1) . '</h3>' . '<p>' .  $menuItemArray[$ii]->getDescription() . $menuItemArray[$ii]->getPrice() . '</p>';
							}
						}
						?>
                </aside>
                <div class="main">
                    <h1>Welcome</h1>
                    <img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <h2>Book your Christmas Party!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div><!-- End Main -->
            </div><!-- End Content -->
<?php include 'footer.php'; ?>
