<?php
namespace App;


class Page
{
    private \Twig\Environment $twig;
    public $link;
    public $session;
    

    function __construct()
    {
        $this->session = new Session();
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true
        ]);


    try{
        $this->link= new \PDO('mysql:host=mysql;dbname=b2-paris',"root","");
    } catch (\PDOException $e){
        var_dump($e->getMessage());
        die();
    }
    }

    public function insert(string $table_name, array $data)
    {
        $sql = 'INSERT INTO ' . $table_name . '(surname, name, email, password) VALUES (:surname, :name, :email, :password)' ;
        $sth = $this->link->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $sth->execute($data);
    }

    public function getUserByEmail(array $data)
    {
        $sql ="SELECT * FROM users WHERE email=:email";
        $sth = $this->link->prepare($sql);
        $sth->execute($data);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function render(string $name, array $data) :string
    {
        return $this->twig->render($name, $data);
    }

    public function generateRandomPassword($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomPassword;
    }

    public function updateUserPassword(string $email, string $newPassword){
        $sql ="UPDATE users SET password = :newPassword WHERE email=:email";
        $sth = $this->link->prepare($sql);
        $sth->execute([
            'email' => $email,
            'newPassword' => $newPassword
        ]);
    }

    public function getAllCustomers(){
        $sql ="SELECT * FROM users WHERE role='client' and verified=TRUE ";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC); 
    }
    
    public function getAllInterventions(){
        $sql ="SELECT * FROM interventions";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(); 
    }

    public function getAllStandardiste(){
        $sql ="SELECT * FROM users WHERE role='standardiste'";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC); 
    }
    
    public function getAllIntervenent(){
        $sql ="SELECT * FROM users WHERE role='intervenant'";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC); 
    }
    
    public function getAllNewCustormers(){
        $sql ="SELECT * FROM users WHERE role='client' and verified = FALSE ";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC); 
    }

    public function getIntervenantByIntervention($id) {
        $sql = "SELECT u.name, u.surname
                FROM intervenant_intervention ii
                INNER JOIN users u ON ii.intervenant_id = u.user_id
                WHERE ii.intervention_id = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC); 
    }
    
    
    public function getInterventionsByID($id){
        $sql ="SELECT * FROM interventions WHERE id=$id";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_ASSOC);

    }

    public function getUserByID($id) {
        $sql ="SELECT * FROM users WHERE user_id=$id";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNewCustomerByID($id){
        $sql ="SELECT * FROM users WHERE user_id=$id and verified=FALSE";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateUserRole($id,$role){
        $sql ="UPDATE users SET role = :role WHERE user_id = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':role',$role);
        $sth->bindParam(':id',$id);
        $sth->execute();
        return true;
    }


    public function setUserVerified($id){
        $sql ="UPDATE users SET verified = TRUE WHERE user_id = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id',$id);
        $sth->execute();
        return true;
    }

}