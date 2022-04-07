<?php 
require __DIR__ . '/../repositories/newsrepository.php';

class NewsService {
    public function insertEmail($email) {
        $repository = new NewsRepository();
        $repository->insertEmail($email);
    }
}
