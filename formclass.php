<?php

class formclass{

    public $number;
    public $account;
    public $balance;
    protected $_pdo;
    public $table='accs';
    public $pod;

    protected $errors = [];

    public function data_insert(){
        if (!empty($_POST)) { 
            $this->number = isset($_POST['number']) ? trim($_POST['number']) : null; 
            $this->account = isset($_POST['account']) ? trim($_POST['account']) : null; 
            $this->balance = isset($_POST['balance']) ? trim($_POST['balance']) : null; 
            $this->pod = isset($_POST['pod']) ? 1 : 0; 
        }
    }

    public function has_errors(){
        return ! empty($this->errors);
    }

    public function validate(){
        if (!empty($_POST)) { 
            if (empty($this->number))
            {
                $this->errors['number'] = 'Не введен номер телефона';
                echo $this->errors['number']."<br>";
            }
            if (empty($this->account))
            {
                $this->errors['account'] = 'Не введен номер лицевого счёта';
                echo $this->errors['account']."<br>";
            }
            if (!$this->balance)
            {
                $this->errors['balance'] = 'Не введен баланс';
                echo $this->errors['balance']."<br>";
            }
                if (!$this->pod)
            {
                $this->errors['pod'] = 'Данные не подтверждены';
                echo $this->errors['pod']."<br>";
            }
        }
        return ! $this->has_errors();
    }

    public function get_pdo(){
        if (empty($this->_pdo)){
            $this->_pdo = new PDO('mysql:host=localhost;dbname=test','root',''); 
        }
        return $this->_pdo;
    }

     public function sqlsave(){
        if ($this->validate()){
            $sql = $this->get_pdo()->prepare('INSERT INTO `'.$this->table.'` (`number`,`account`,`balance`) VALUES (?,?,?);');
            $sql->execute(array($this->number,$this->account,$this->balance));
            return $sql->rowCount() === 1;
        }
        return false;
    }

    public function ins_table(){
        $sql = $this->get_pdo()->prepare('SELECT * FROM `'.$this->table.'`;');
        $sql->execute();
        while ($object = $sql->fetchObject(static::class)){
            echo "<tr><td>".$object->number."</td><td>".$object->account."</td><td>".$object->balance."</td><td><a href='form.php?id=$object->id'>Изменить</a></td><td><a href='index.php?id=$object->id&del=yes'>Удалить</a></td></tr>";
        }
    }
    public function del_table($idd){
        $sql = $this->get_pdo()->prepare('DELETE FROM `'.$this->table.'`WHERE `id`='.$idd.';');
        $sql->execute();
    }
    public function ins_fromdb($idd){
        $sql = $this->get_pdo()->prepare('SELECT * FROM `'.$this->table.'`WHERE `id`='.$idd.';');
        $sql->execute();
        $object = $sql->fetchObject(static::class);
        $_POST['number']=$object->number;
        $_POST['account']=$object->account;
        $_POST['balance']=$object->balance;      
    }

    public function sqlupd($idd){
            $this->data_insert();
            if($this->validate()){
                $sql = $this->get_pdo()->prepare('UPDATE `'.$this->table.'` set `number`=?, `account`=?, `balance`=? WHERE `id`=? limit 1;');
                $sql->execute(array($this->number,$this->account,$this->balance,$idd));
                header('Location: /calendar');
                return true;
            }
            return false;
    }

}
