<?php

class UsersModel {
   private $db;

   public function __construct() {
      // 1. abre conexión con DB
      $this->db = new PDO('mysql:host=localhost;dbname=catalogo_musical;charset=utf8', 'root', '');
   }

   public function getAll() {
      // 2. prepara y ejecuta la consulta
      $query = $this->db->prepare('SELECT * FROM users');
      $query->execute();

      // 3. obtiene los resultados
      $users = $query->fetchAll(PDO::FETCH_OBJ);

      // var_dump($query->errorInfo());

      return $users;
   }

   public function get($id) {
      $query = $this->db->prepare('SELECT * FROM users WHERE id_user = ?');
      $query->execute([$id]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

   public function getByEmail($email) {
      $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
      $query->execute([$email]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

}
