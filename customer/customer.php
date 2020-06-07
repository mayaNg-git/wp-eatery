<?php

	class customer{
		private $customerName;
		private $phoneNumber;
		private $emailAddress;
		private $referrer;
		private $id;
		private $deletedCustomer;
		
		function __construct ($customerName,$phoneNumber,$emailAddress, $deletedCustomer,$referrer){
			$this->customerName = $customerName;
			$this->phoneNumber = $phoneNumber;
			$this->emailAddress = $emailAddress;
			$this->referrer = $referrer;
			$this->deletedCustomer = $deletedCustomer;
		}
		
		function getName(){
			return $this->customerName;
		}
		
		function setName(){
			$this->customerName = $customerName;
		}
		
       function getPhoneNumber(){
			return $this->phoneNumber;
       }
       
       function setPhone($phoneNumber){
			$this->phoneNumber = $phoneNumber;
       }
     
       function getEmail(){
			return $this->emailAddress;
       }
    
       function  setEmail($emailAddress){
			$this->emailAddress = $emailAddress;
       }
       
       function getReferrer(){
			return $this->referrer;
       }
    
       function setReferrer($referrer){
			$this->referrer = $referrer;
       }


	   function getDeletedCustomer(){
			return $this->deletedCustomer;
		}
		
		function setDeletedCustomer(){
			$this->deletedCustomer = $deletedCustomer;
		}
		  function getId(){
			return $this->id;
       }
    
       function setId($id){
			$this->id = $id;
       }
		
	}