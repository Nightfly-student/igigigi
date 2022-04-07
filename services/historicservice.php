<?php 
require __DIR__ . '/../repositories/historicrepository.php';

class HistoricService {
    public function getAll() {
        $repository = new HistoricRepository();
        return $repository->getAll();
    }
}
