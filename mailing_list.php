<?php include 'header.php'; ?>
<?php require_once('dao/customerDAO.php'); ?>
   

        <?php
        $customerDAO = new customerDAO;	
		$customers = $customerDAO->getCustomers();
            if($customers){
				echo '<table width = "100%" border=\'1\'>';
                echo '<tr><th>Customer Name</th><th>Phone Number</th><th>Email Address</th><th>How did you hear about us?</th><th>Delete?</th></tr>';
                foreach($customers as $customer){
                    echo '<tr>';
                    echo '<td><center>' . $customer->getName() . '</td></center>';
                    echo '<td><center>' . $customer->getPhoneNumber() . '</td></center>';
                    echo '<td><center>' . $customer->getEmail() . '</td></center>';
                    echo '<td><center>' . $customer->getReferrer() . '</td></center>';
					echo '<td><center><a href="mailing_list.php?id=' . $customer->getId() . '">' . '<input type="submit" name="deleteItem" value = "Delete"/>' . '</td></center>';
                    echo '</tr>';
                }
				echo '</table>';
				}else{
					echo '<h3>'.'There is no customer data in the list '.'</h3>';
				}	
				
				if( isset($_GET['id']) && !isset($_GET['choice']) ){	
					$delCustomer = $customerDAO->getCustomer($_GET['id']);  
					echo "<h3>Are you sure you want to delete " . $delCustomer->getName() . "?</h3>";
					echo '<table width = "100%" border = \'2\' style="margin-right: auto; margin-left: auto; text-align: center;">';
					echo '<tr>';
					echo "<form name='yesButton' method='post' action='mailing_list.php?id=" . $_GET['id'] . "&choice=y'>";
					echo "<td>";
					echo "<input type='submit' name='yes' value='Yes'>";
					echo "</td>";
					echo '</form>';
					echo "<form name='noButton' method='post' action='mailing_list.php?id=" . $_GET['id'] . "&choice=n'>";
					echo "<td>";
					echo "<input type='submit' name='no' value='No'>";
					echo "</td>";
					echo '</form>';
					echo '</tr>';
					echo '</table>';
	
					}
					
					
					if ( isset($_GET['id']) && isset($_GET['choice']) ){
						if( $_GET['choice'] == 'y' ){
							
						    $result = $customerDAO->deleteCustomer($_GET['id']);  
						   	header("Location: mailing_list.php?choice=y");
						}else{  
						header("Location: mailing_list.php?choice=n");      
					}
				}
			        if(isset($_GET['choice'])){
					if($_GET['choice'] == 'y'){
                    echo "<h3>Customer deleted.";
					}
					if($_GET['choice'] == 'n'){
                    echo '<h3>Customer did not delete</h3>';
				
				}
            }	
					?>	
    
<?php include 'footer.php'; ?>