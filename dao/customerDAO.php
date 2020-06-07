<?php
require_once('dao/abstractDAO.php');
require_once('customer/customer.php');
class customerDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
    public function getCustomers(){
        $result = $this->mysqli->query('SELECT * FROM mailinglist WHERE customerName != ""' );
        $customers = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new employee object, and add it to the array.
                $customer = new Customer($row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['deletedCustomerNames'], $row['referrer']);
				$customer ->setId($row['_id']);
				$customers[] = $customer;
            }
            $result->free();
            return $customers;	
        }
        $result->free();
        return false;
    }
	
	    public function getCustomers1(){
        $result = $this->mysqli->query('SELECT * FROM mailinglist');
        $customers = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new employee object, and add it to the array.
                $customer = new Customer($row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['deletedCustomerNames'], $row['referrer']);
				$customer ->setId($row['_id']);
				$customers[] = $customer;
            }
            $result->free();
            return $customers;
        }
        $result->free();
        return false;
    }

	
    public function getCustomer($_id){
        $query = 'SELECT * FROM mailinglist WHERE _id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('s', $_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $customer = new customer($temp['customerName'], $temp['phoneNumber'], $temp['emailAddress'], $temp['deletedCustomerNames'], $temp['referrer']);
            $result->free();
            return $customer;
        }
        $result->free();
        return false;
    }

    public function addCustomer($customer){
        if(!$this->mysqli->connect_errno){
            $query = 'INSERT INTO mailingList(customerName,phoneNumber,emailAddress,referrer) VALUES (?,?,?,?)';
            $stmt = $this->mysqli->prepare($query);
			$name = $customer->getName();
			$phone = $customer->getPhoneNumber();
			$emailAddress = $customer->getEmail();
			$referrer = $customer->getReferrer();	
            $stmt->bind_param('ssss',$name,$phone,$emailAddress,$referrer);
            $stmt->execute();
            if($stmt->error){
                return $stmt->error;
            } else {
                return $customer->getName() . ' added successfully!';
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
	
    
    public function deleteCustomer($_id){
        if(!$this->mysqli->connect_errno){
					$query2 = 'SELECT * FROM mailinglist WHERE _id = ?';
					$stmt2 = $this->mysqli->prepare($query2);
					$stmt2->bind_param('s', $_id);
					$stmt2->execute();
					$result = $stmt2->get_result();
					if($result->num_rows == 1){
						$temp = $result->fetch_assoc();
						$customer = new customer($temp['customerName'] , $temp['phoneNumber'] , $temp['emailAddress'] , $temp['deletedCustomerNames'] , $temp['referrer']);
						$result->free();
					}
			$name = $customer->getName();
			$phoneNumber = $customer->getPhoneNumber();
			$emailAddress = $customer->getEmail();
			$referrer = $customer->getReferrer();
			$insert = "Name: " . $name . "<br>Phone: " . $phoneNumber . "<br>Email: " . $emailAddress . "<br>Referrer: " . $referrer;
			$query1 = 'INSERT INTO mailingList(deletedCustomerNames) VALUES (?)';
            $stmt2 = $this->mysqli->prepare($query1);
			$stmt2->bind_param('s',$insert);
			
			
            $query = 'DELETE FROM mailingList WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('s', $_id);
			$stmt2->execute();
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {          
                return ;
            }
        } else {
            return false;
        }
    }
}

?>
