<?php include 'header.php'; ?>
<?php require_once('dao/customerDAO.php'); ?>
	
	          <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
	
	                <div class="main">
                    <h1><center>Removed Customer's List</h1>
				
        <?php
        $customerDAO = new customerDAO;	
		$customers = $customerDAO->getCustomers1();
            if($customers){
				echo '<table width = "100%" border=\'1\'>';
                echo '<tr><th><center>Customer Information</center></th></tr>';
                foreach($customers as $customer){
                    echo '<tr>';
                    echo '<td>' . $customer->getDeletedCustomer() . '</td>';
                    echo '</tr>';
                }
				echo '</table>';
				}else{
					echo '<h3>'.'There is no customer data in the list '.'</h3>';
				}	
					?>
			</div>
    </div><!-- End Content -->
<?php include 'footer.php'; ?>