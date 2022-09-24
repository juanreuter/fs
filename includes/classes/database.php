<?php
class Db
{
 var $servidor;
 var $user;
 var $pass;
 var $db_name;	
 var $db_conn;
 var $db_select;
 var $table;
 var $result; //Resultado de la consulta
 var $registros;
 var $datos;
  	function Db()
  	{
        /*
		MONIMAR*/
  		$this->servidor="localhost";
  	    $this->db_name="fcaramuti_monimar";
  	    $this->user="monimarsrl";
  	    $this->pass="monimar1234";
  	    $this->table="";
        

  		/*
  		LOCAL 
  		$this->servidor="localhost";
  	    $this->db_name="monimar";
  	    $this->user="root";
  	    $this->pass="lowe";
  	    $this->table="";
 		*/

  	    $this->db_conn=@mysql_connect($this->servidor, $this->user, $this->pass) or die ("Error de Coneccion".mysql_error());
  	    $this->db_select=@mysql_select_db($this->db_name, $this->db_conn);
  	}

  	function consulta_db($sql)
  	{
  		$this->result=mysql_query($sql, $this->db_conn) or die("Error de Consulta: ".$sql."<br/>".mysql_error());
  		return ($this->result);
  	}

  	function close_db()
  	{
  		//mysql_close($this->db_conn);
  		return;
  	}

 	//BEGIN USERS
  	function newUser($user){
		$sql = "INSERT INTO user(hash, firstname, lastname, email, phonenumber, mobilenumber, address,city,state,password,newsletter,enabled)
				VALUES('".sha1($user->getEmail())."','".$user->getFirstName()."','".$user->getLastName()."','".$user->getEmail()."','".$user->getPhoneNumber()."','".$user->getMobileNumber()."','".$user->getAddress()."','".$user->getCity()."','".$user->getState()."','".$user->getPassword()."',".(($user->isNewsletter) ? 1: 0).",0)";
		$this->consulta_db($sql);
		return mysql_insert_id();
	}
	
	function existEmail($email){
		$sql = "SELECT email FROM user WHERE email = '$email'";
		$resource = $this->consulta_db($sql);
		$rows = mysql_num_rows($resource);
		
		if($rows>0)
			return true;
		
		return false;
	}
	
	function enableUser($hash){
		$sql = "SELECT * FROM user WHERE hash = '$hash'";
		$resource = $this->consulta_db($sql);
		$filas = mysql_num_rows($resource);
		if($filas>0){
			$sql = "UPDATE user SET enabled = 1 WHERE hash = '$hash'";
			$this->consulta_db($sql);
			return true;
		}else{
			return false;
		}
	}
	
	function getUserByHash($hash){
		$sql = "SELECT * FROM user WHERE hash = '$hash'";
		$resource = $this->consulta_db($sql);
		$data = mysql_fetch_object($resource);
		$user = new User();
		
		$user->setFirstName($data->firstname);
		$user->setLastName($data->lastname);
		$user->setEmail($data->email);
		$user->setPhoneNumber($data->phonenumber);
		$user->setMobileNumber($data->mobilenumber);
		$user->setAddress($data->address);
		$user->setCity($data->city);
		$user->setState($data->state);
		$user->setPassword($data->password);
		$user->setNewsletter($data->newsletter);
		$user->setActive($data->enabled);
		
		return $user;
	}
	
	function getUserByEmail($email){
		$sql = "SELECT * FROM user WHERE email = '$email'";
		$resource = $this->consulta_db($sql);
		$fila = mysql_num_rows($resource);
		if($fila>0){
			$data = mysql_fetch_object($resource);
			$user = new User();
			
			$user->setFirstName($data->firstname);
			$user->setLastName($data->lastname);
			$user->setEmail($data->email);
			$user->setPhoneNumber($data->phonenumber);
			$user->setMobileNumber($data->mobilenumber);
			$user->setAddress($data->address);
			$user->setCity($data->city);
			$user->setState($data->state);
			$user->setPassword($data->password);
			$user->setNewsletter($data->newsletter);
			$user->setActive($data->enabled);
			
			return $user;
		}
		
		return false;
	}

	function updateUser($userid, $firstname, $lastname, $email, $password){
		$colPass = ($password != "") ? ",password = '$password'" : "";
		
		$sql = "UPDATE user SET user_first_name = '$firstname', user_last_name = '$lastname', user_email = '$email' ".$colPass."
				WHERE user_id = $userid";
		$this->consulta_db($sql);
	}
	
	function loginUser($username,$password){
		$sql = "SELECT * FROM user WHERE email = '$username' AND password = '$password'";
		$resource = $this->consulta_db($sql);
		$fila = mysql_num_rows($resource);
		if($fila>0){
			$data = mysql_fetch_object($resource);
			$user = new User();
			
			$user->setFirstName($data->firstname);
			$user->setLastName($data->lastname);
			$user->setEmail($data->email);
			$user->setPhoneNumber($data->phonenumber);
			$user->setMobileNumber($data->mobilenumber);
			$user->setAddress($data->address);
			$user->setCity($data->city);
			$user->setState($data->state);
			$user->setPassword($data->password);
			$user->setNewsletter($data->newsletter);
			$user->setActive($data->enabled);
			
			if($data->enabled=="0"){
				return false;
			}
			
			return $user;
		}
		
		return false;
	}
	
	function deleteUser($userid){
		$sql = "DELETE FROM user WHERE user_id = $userid";
		$this->consulta_db($sql);
	}
  	//END USERS

      	
  	function publish($id_campo,$id,$valor,$table){
  		$sql = "UPDATE $table SET enabled=$valor WHERE $id_campo=".$id;
  		$this->consulta_db($sql);
  	}
}
?>
