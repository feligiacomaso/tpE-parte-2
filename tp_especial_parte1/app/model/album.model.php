<?php

class AlbumModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=localhost;dbname=catalogo_musical;charset=utf8',
            'root',
            ''
        );
    }

    public function getAll() {
        $query = $this->db->prepare('
            SELECT album.*, artista.nombre_artistico
            FROM album
            JOIN artista ON album.id_artista = artista.id_artista
        ');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id) {
        $query = $this->db->prepare('
            SELECT album.*, artista.nombre_artistico
            FROM album
            JOIN artista ON album.id_artista = artista.id_artista
            WHERE id_album = ?
        ');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getByArtista($id_artista) {
        $query = $this->db->prepare('
            SELECT album.*, artista.nombre_artistico
            FROM album JOIN artista ON album.id_artista = artista.id_artista
            WHERE album.id_artista = ?
        ');
        $query->execute([$id_artista]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($nombre, $fecha_lanzamiento, $cantidad_canciones, $imagen, $id_artista) {
        $query = $this->db->prepare('
            INSERT INTO album(nombre, fecha_lanzamiento, cantidad_canciones, imagen, id_artista)
            VALUES (?, ?, ?, ?, ?)
        ');

        $query->execute([
            $nombre,
            $fecha_lanzamiento,
            $cantidad_canciones,
            $imagen,
            $id_artista
        ]);

        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM album WHERE id_album = ?');
        $query->execute([$id]);
    }

    public function update($id, $nombre, $fecha_lanzamiento, $cantidad_canciones, $imagen, $id_artista) {
        $query = $this->db->prepare('
            UPDATE album
            SET nombre = ?, fecha_lanzamiento = ?, cantidad_canciones = ?, imagen = ?, id_artista = ?
            WHERE id_album = ?
        ');

        $query->execute([
            $nombre,
            $fecha_lanzamiento,
            $cantidad_canciones,
            $imagen,
            $id_artista,
            $id
        ]);
    }
}