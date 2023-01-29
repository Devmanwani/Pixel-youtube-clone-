<?php
class user {
    private $con, $sqlData;

    public function __construct($con, $username){

        $this->con = $con;

        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un" );
        $query->bindParam(":un", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);

    }

    public static function isLoggedIn() {
        return isset($_SESSION["userLoggedIn"]);
    }

    public function getUsername(){
        if (is_array($this->sqlData)) {
            return $this->sqlData["username"];
        } else {
            return false;
        }
    }
    
    /*public function getUsername(){
        return $this->sqlData["username"];
        
    }*/

    public function getname(){
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
        
    }

    public function getfirstName(){
        return $this->sqlData["firstName"];
        
    }

    public function getlastName(){
        return $this->sqlData["lastName"];
        
    }

    public function getEmail(){
        return $this->sqlData["email"];
        
    }

    public function getProfilePic(){
        if (is_array($this->sqlData)) {
            return $this->sqlData["profilePic"];
        } else {
            return false;
        }
    }

    public function getsignUpDate(){
        return $this->sqlData["signUpDate"];
        
    }

    public function isSubscribedTo($userTo){
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom",$username);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount() > 0;

    }
    
    public function getSubscriberCount(){
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $query->bindParam(":userTo",$username);
        $username = $this->getUsername();
        $query->execute();
        return $query->rowCount();

    }

    public function getSubscriptions(){
        $query = $this->con->prepare("SELECT userTo FROM subscribers WHERE userfrom=:userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userFrom", $username);
        $query->execute();

        $subs=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $user = new user($this->con, $row["userTo"]);
            array_push($subs, $user);

        }
        return $subs;
    }
}


?>