<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/location.php';

class HistoricRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Location');
            $locations = $stmt->fetchAll();

            return $locations;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
