<?php
class professionalsModel {
    private $db;
   
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=hospital;charset=utf8', 'root', '');
    }

    public function getAll($limit, $offset) {
        $query = $this->db->prepare("SELECT * FROM professionals LIMIT :limit OFFSET :offset");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sortByOrder($sortBy, $order) {
        $query = $this->db->prepare("SELECT * FROM professionals ORDER BY $sortBy $order");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCount() {
        $query = $this->db->prepare("SELECT COUNT(*) as count FROM professionals");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getById($id) {
        $query = $this->db->prepare("SELECT * FROM professionals WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($name, $last_name, $specialty, $incorporation) {
        $query = $this->db->prepare("INSERT INTO professionals (name, last_name, specialty, incorporation) VALUES (:name, :last_name, :specialty, :incorporation)");
        $query->bindValue(':name', $name);
        $query->bindValue(':last_name', $last_name);
        $query->bindValue(':specialty', $specialty);
        $query->bindValue(':incorporation',$incorporation);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function deleteById($id) {
        $query = $this->db->prepare("DELETE FROM profesionales WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();
    }

    public function updateById($id, $name, $last_name, $specialty, $incorporation) {
        $query = $this->db->prepare("UPDATE professionals SET name = :name, last_name = :last_name, specialty = :specialty, incorporation = :incorporation WHERE id = :id");
        $query->bindValue(':name', $name);
        $query->bindValue(':last_name', $last_name);
        $query->bindValue(':specialty', $specialty);
        $query->bindValue(':incorporation', $incorporation);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();
    }
    
    public function filterByYear($year) {
        $query = $this->db->prepare("SELECT * FROM professionals WHERE YEAR(incorporation) = :year");
        $query->bindValue(':year', $year, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
