<?php

class ArtistaModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=localhost;dbname=catalogo_musical;charset=utf8',
            'root',
            ''
        );
    }

    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM artista');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM artista WHERE id_artista = ?');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($nombre_artistico, $nombre_completo, $fecha_nacimiento, $genero, $imagen) {
        $query = $this->db->prepare('
            INSERT INTO artista(nombre_artistico, nombre_completo, fecha_nacimiento, genero, imagen)
            VALUES (?, ?, ?, ?, ?)
        ');

        $query->execute([
            $nombre_artistico,
            $nombre_completo,
            $fecha_nacimiento,
            $genero,
            $imagen
        ]);

        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM artista WHERE id_artista = ?');
        $query->execute([$id]);
    }

    public function update($id, $nombre_artistico, $nombre_completo, $fecha_nacimiento, $genero, $imagen) {
        $query = $this->db->prepare('
            UPDATE artista
            SET nombre_artistico = ?, nombre_completo = ?, fecha_nacimiento = ?, genero = ?, imagen = ?
            WHERE id_artista = ?
        ');

        $query->execute([
            $nombre_artistico,
            $nombre_completo,
            $fecha_nacimiento,
            $genero,
            $imagen,
            $id
        ]);
    }
}