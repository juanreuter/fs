<?
class User{
	
	var $firstname;
	var $lastname;
	var $email;
	var $phonenumber;
	var $mobilenumber;
	var $address;
	var $city;
	var $state;
	var $password;
	var $newsletter;
	var $activeAccount;
	
	function User(){
		$this->firstname = "";
		$this->lastname = "";
		$this->email = "";
		$this->phonenumber = "";
		$this->mobilenumber = "";
		$this->address = "";
		$this->city = "";
		$this->state = "";
		$this->password = "";
		$this->newsletter = false;
		$this->activeAccount = false;
	}
	
	//GETTERS
	function getFirstName(){
		return $this->firstname;
	}
	
	function getLastName(){
		return $this->lastname;
	}
	
	function getEmail(){
		return $this->email;
	}
	
	function getPhoneNumber(){
		return $this->phonenumber;
	}
	
	function getMobileNumber(){
		return $this->mobilenumber;
	}
	
	function getAddress(){
		return $this->address;
	}
	
	function getCity(){
		return $this->city;
	}
	
	function getState(){
		return $this->state;
	}
	
	function getPassword(){
		return $this->password;
	}
	
	function isNewsletter(){
		return $this->newsletter;
	}
	
	function isActive(){
		return $this->activeAccount;
	}
	
	//SETTERS
	function setFirstName($firstname){
		$this->firstname = $firstname;
	}
	
	function setLastName($lastname){
		$this->lastname = $lastname;
	}
	
	function setEmail($email){
		$this->email = $email;
	}
	
	function setPhoneNumber($phone){
		$this->phonenumber = $phone;
	}
	
	function setMobileNumber($mobile){
		$this->mobilenumber = $mobile;
	}
	
	function setAddress($address){
		$this->address = $address;
	}
	
	function setCity($cityt){
		$this->city = $cityt;
	}
	
	function setState($s){
		$this->state = $s;
	}
	
	function setPassword($p){
		$this->password = $p;
	}
	
	function setNewsletter($news){
		$this->newsletter = $news;
	}
	
	function setActive($active){
		$this->activeAccount = $active;
	}
}
?>