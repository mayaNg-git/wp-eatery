
<?php include 'header.php'; ?>
<?php 
require_once('dao/abstractDAO.php');
require_once('dao/customerDAO.php');
	  try{
			$customerDAO = new customerDAO();
			$abstractDAO = new abstractDAO();
			$hasError = false;
			$errorMessages = Array();
			
		if(isset($_POST['customerName']) || isset($_POST['phoneNumber']) || isset($_POST['emailAddress']) || isset($_POST['referral'])){
				
					if($_POST['customerName'] == ""){
					$hasError = true;
					$errorMessages['customerNameError'] = 'Please enter valid name.';
					}
					if($_POST['phoneNumber'] == ""){
					$hasError = true;
					$errorMessages['phoneNumberError'] = 'Please enter valid phone number.';
					}
					if($_POST['phoneNumber'] !=0 && (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['phoneNumber']))){
					$hasError = true;
					$errorMessages['phoneNumberError'] = 'Invalid format ( xxx-xxx-xxxx)';
					}
					if(($_POST['emailAddress'] == "") || (! filter_var ( $_POST ['emailAddress'], FILTER_VALIDATE_EMAIL ))){
					$hasError = true;
					$errorMessages['emailAddressError'] = 'Please enter valid email address.';
					}
					$email1=$_POST['emailAddress'];
					$sql= "SELECT * FROM mailingList where emailAddress = '$email1'";
					$email = $abstractDAO->getMysqli()->query($sql);
					$num = $abstractDAO->getMysqli()->affected_rows;

					if($num != 0){
					$error = true;
					$errormessage['emailAddress'] = "Duplicate Email Address.";
					}

				
					
					if (empty($_POST['referral'])){
					$hasError = true;
					$errorMessages['referralError'] = "Please input a referral";
					}
					if(!$hasError){
					$email = $_POST['emailAddress'];
					$customer = new Customer($_POST['customerName'], $_POST['phoneNumber'], $email , "", $_POST['referral']);
					$addSuccess = $customerDAO->addCustomer($customer);
					echo '<h3>' . $addSuccess . '</h3>';
                }
			}
		?>



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
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="customerName" id="customerName" size='40'>
								<?php 
									if(isset($errorMessages['customerNameError'])){
									echo '<br>';
									echo '<span style=\'color:yellow\'>' . $errorMessages['customerNameError'] . '</span>';
									}
									?></td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" size='40'>
								<?php 
								//If there was an error with the firstName field, display the message
									if(isset($errorMessages['phoneNumberError'])){
									echo '<br>';						
									echo '<span style=\'color:yellow\'>' . $errorMessages['phoneNumberError'] . '</span>';
									}
									?></td>
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size='40'>
								<?php 
								//If there was an error with the firstName field, display the message
									if(isset($errorMessages['emailAddressError'])){
									echo '<br>';				
									echo '<span style=\'color:yellow\'>' . $errorMessages['emailAddressError'] . '</span>';
									}
									?></td>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper">
                                    Radio<input type="radio" name='referral' id='referralRadio' value='radio'>
                                    TV<input type='radio' name='referral' id='referralTV' value='TV'>
                                    Other<input type='radio' name='referral' id='referralOther' value='other'>
								<?php
									if (isset($errorMessages['referralError'])){
									echo '<br>';						
									echo '<span style=\'color:yellow\'>' . $errorMessages['referralError'] . '</span>';
									}
									?></td>
                            </tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Add Customer'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>
                </div><!-- End Main -->
            </div><!-- End Content -->	
    <?php
		}catch(Exception $e){
			echo '<h3>Error on page.</h3>';
			echo '<p>' . $e->getMessage() . '</p>';
		}
?>			
			<?php include 'footer.php'; ?>
        </div><!-- End Wrapper -->
    </body>
