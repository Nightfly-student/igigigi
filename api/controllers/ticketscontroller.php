<?php
require __DIR__ . '/../../services/ticketsservice.php';

class TicketsController
{
    private $ticketsService;
    function __construct()
    {
        header("Content-type:application/json");
        $this->ticketsService = new TicketsService();
    }

    public function index()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType == "application/json") {
            // unset($_SESSION['cart']);
            $entityBody = file_get_contents('php://input', 'r');
            parse_str($entityBody, $post_data);
            $res = json_decode($entityBody, true);
            $cartarr = [
                "event" => $res['data']['result'],
                "adults" => $res['data']['adults'],
                "children" => $res['data']['children'],
                "category" => $res['data']['category'],
            ];
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
            
            $keyValue = in_array($res['data']['result'], array_column($_SESSION['cart'], 'event'));
            if ($keyValue) {

                foreach ($_SESSION['cart'] as $key => &$val) {
                    if ($val['event'] === $res['data']['result']) {
                        $checkarr = (object)[
                            "event" => $res['data']['result'],
                            "amount" => intval($_SESSION['cart'][$key]['children'] + $res['data']['children']) + intval($_SESSION['cart'][$key]['adults'] + $res['data']['adults'])
                        ];
                        if (!$this->ticketsService->checkTickets($checkarr)) {
                            http_response_code(409);
                            echo json_encode('Not Enough Tickets Available', JSON_PRETTY_PRINT);
                            return;
                        } else {
                            $_SESSION['cart'][$key]['adults'] += $res['data']['adults'];
                            $_SESSION['cart'][$key]['children'] += $res['data']['children'];
                            http_response_code(200);
                            echo json_encode('Added to existing Item');
                        }
                    }
                }
            } else {
                array_push($_SESSION['cart'], $cartarr);
                http_response_code(200);
                echo json_encode('Added To Cart');
            }
        } else {
            http_response_code(403);
            echo json_encode("No POST request", JSON_PRETTY_PRINT);
        }
    }
    public function deleteEvent()
    {
        $entityBody = file_get_contents('php://input', 'r');
        parse_str($entityBody, $post_data);
        $res = json_decode($entityBody, true);
        foreach ($_SESSION['cart'] as $key => &$val) {
            if ($val['event'] === $res['id']) {
                array_splice($_SESSION['cart'], $key, 1);
                http_response_code(200);
                echo json_encode('Deleted');
                return;
            }
        }
    }
    public function updateEvent()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType == "application/json") {
            $entityBody = file_get_contents('php://input', 'r');
            parse_str($entityBody, $post_data);
            $res = json_decode($entityBody, true);

            foreach ($_SESSION['cart'] as $key => &$val) {
                if ($val['event'] === $res['id']) {
                    
                    $checkarr = (object)[
                        "event" => $res['id'],
                        "amount" => $res['children'] + $res['adults'],
                    ];

                    if (!$this->ticketsService->checkTickets($checkarr)) {
                        http_response_code(409);
                        echo json_encode('Not Enough Tickets Available', JSON_PRETTY_PRINT);
                        return;
                    } else {
                        $_SESSION['cart'][$key]['adults'] = $res['adults'];
                        $_SESSION['cart'][$key]['children'] = $res['children'];

                        http_response_code(200);
                        echo json_encode('Updated');
                        return;
                    }
                }
            }
        } else {
            http_response_code(403);
            echo json_encode("No POST request", JSON_PRETTY_PRINT);
        }
    }
}
