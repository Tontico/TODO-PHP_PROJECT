<?php

namespace Keha\Test\App;

use PDO;
use Keha\Test\Config\Config;

class Model extends PDO
{
    private static $instance = null;

    private function __construct()
    {
        try {
            parent::__construct(
                "mysql:dbname=" . Config::DBNAME . ";host=" . Config::DBHOST,
                Config::DBUSER,
                Config::DBPWD
            );
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function readAll($entity)
    {
        $query = $this->query('select * from ' . $entity);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . $entity);
    }

    public function readBy($entity, $parameter)
    {
        $query = $this->query('select ' . $parameter . ' from ' . $entity);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . $entity);
    }

    // public function getById($entity, $conditions, $id)
    // {
    //     $query = $this->query('select * from ' . $entity . ' where ' . $conditions . '=' . $id);
    //     return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . $entity)[0];
    // }

    public function save($entity, $datas): int
    {
        $sql = 'INSERT into ' . $entity . ' (';
        $count = count($datas) - 1;
        $preparedDatas = [];
        $i = 0;
        foreach ($datas as $key => $value) {
            $sql .= $key;
            if ($i < $count) {
                $sql = $sql . ',';
            }
            $i++;
        }
        $sql .= ') VALUES (';
        $i = 0;
        foreach ($datas as $key => $data) {
            $preparedDatas[] = htmlspecialchars($data);
            $sql .= "?";
            if ($i < $count) {
                $sql = $sql . ', ';
            }
            $i++;
        }
        $sql = $sql . ')';
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);

        $lastInsertId = $this->lastInsertId();

        return $lastInsertId;
    }

    public function getByAttribute($entity, $attribute, $value)
    {
        // SELECT * FROM table WHERE attribute = value
        $query = $this->query("SELECT * FROM $entity WHERE $attribute = '$value'");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    public function getByJoin($entity, $entityJoin, $attribute, $attributeJoin,$attributeUser, $value)
    {
        $query = $this->query("SELECT * FROM $entity JOIN $entityJoin ON $entity.$attribute = $entityJoin.$attributeJoin WHERE $entityJoin.$attributeUser = $value");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    public function getByRequest($entity, $attribute, $entity1, $attribute1, $value)
    {
        $query = $this->query("SELECT * FROM $entity WHERE $attribute = (SELECT * FROM $entity1 WHERE $attribute1 = $value)");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }

    public function getProjectByIdUser($id_utilisateur)
    {
        $query = $this->query("SELECT * FROM projet JOIN participants_projet ON projet.Id_projet=participants_projet.Id_projet WHERE Id_utilisateur = '$id_utilisateur'");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst("projet"));
    }


    public function updateById($entity,$attribute, $id, $datas): void
    {
        $sql = 'UPDATE ' . $entity . ' SET ';
        $count = count($datas) - 1;
        $preparedDatas = [];
        $i = 0;
        foreach ($datas as $key => $value) {
            $preparedDatas[] = htmlspecialchars($value);
            $sql .= $key . " = ?";
            if ($i < $count) {
                $sql = $sql . ', ';
            }
            $i++;
        }
        $sql = $sql . " WHERE $attribute='$id'";
        echo $sql . '<br>';
        var_dump($preparedDatas);
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);
    }

    /*public function deleteById($entity, $id): void
    {
        $sql = "DELETE from $entity WHERE id = '$id'";
        $this->exec($sql);
    }*/

    public function delete($entity, $param, $condition)
    {
        $sql = "DELETE FROM $entity WHERE $param = $condition";
        echo $sql;
        $this->exec($sql);
    }

    public function update($entity, $column, $value, $condition)
    {
        $sql = " UPDATE $entity SET $column = '$value' WHERE id = $condition";
        echo $sql;
        $this->exec($sql);
    }

    // public function ChangeConstraint()
    // {
    //     $sql = " ALTER TABLE participants_projet NOCHECK CONSTRAINT ALL;";
    //     echo $sql;
    //     $this->exec($sql);
    // }
    /*public function ChangeConstraint()
    {
        $sql = " ALTER TABLE administrateur DROP INDEX Id_utilisateur ";
        echo $sql;
        $this->exec($sql);
    }*/
}



