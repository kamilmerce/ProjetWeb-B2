<?php
namespace App;


class Page
{
    private \Twig\Environment $twig;
    private $link;
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
}