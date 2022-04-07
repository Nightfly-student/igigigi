<?php

require_once __DIR__ . '/repository.php';
require_once __DIR__ .'/ticketsrepository.php';
require_once __DIR__ .'/userrepository.php';

use Fpdf\Fpdf;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception AS exep;


class DocumentsRepository extends Repository
{
    public function createPDF($tickets)
    {
        try {
            $ticketPDF = new TicketPDF('P', 'mm', 'A4');
            $ticketPDF->SetTitle('Haarlem_Festival_E_Tickets');
            $ticketPDF->SetAuthor('Haarlem Festival');
            $ticketPDF->Body($tickets);
            return $ticketPDF->Output('D', 'Haarlem_Festival_E_Tickets' . $tickets[0]->getOrder() . '.pdf');
        } catch (Exception $e) {
            echo $e;
        }
    }
    public function createInvoice($tickets)
    {
        try {
            $invoicePDF = new InvoicePDF('P', 'mm', 'A4');
            $invoicePDF->SetTitle('Haarlem_Festival_E_Tickets');
            $invoicePDF->SetAuthor('Haarlem Festival');
            $invoicePDF->ImportantInformation($tickets);
            $invoicePDF->HeaderTable();
            $invoicePDF->Body($tickets);
            return $invoicePDF->Output('D', 'Haarlem_Festival_Invoice' . $tickets[0]->getOrder() . '.pdf');
        } catch (Exception $e) {
            echo $e;
        }
    }
    public function sendOrder($tickets) {
        $mailer = new mail();

        $invoicePDF = new InvoicePDF('P', 'mm', 'A4');
        $invoicePDF->SetTitle('Haarlem_Festival_E_Tickets');
        $invoicePDF->SetAuthor('Haarlem Festival');
        $invoicePDF->ImportantInformation($tickets);
        $invoicePDF->HeaderTable();
        $invoicePDF->Body($tickets);
        $i = $invoicePDF->Output('', 'S');

        $ticketPDF = new TicketPDF('P', 'mm', 'A4');
        $ticketPDF->SetTitle('Haarlem_Festival_E_Tickets');
        $ticketPDF->SetAuthor('Haarlem Festival');
        $ticketPDF->Body($tickets);
        $t = $ticketPDF->Output('', 'S');

        $mailer->sendOrder($tickets, $t, $i);
    }
}

class TicketPDF extends Fpdf
{
    function Header()
    {
        $this->SetFont('Arial', '', 18);
        $this->Cell(55);
        $this->Cell(30, 10, 'Haarlem Festival E-Ticket');
        $this->Ln(20);
    }
    function Body($tickets)
    {
        $qr = new qr();
        $eventInfo = new TicketsRepository();
        $u = new UserRepository();
        $user = $u->findUser($tickets[0]->getOrder());

        $this->SetFont('Arial', '', 14);
        foreach ($tickets as $ticket) {
            $this->AddPage();
            $event = $eventInfo->getEvent($ticket->getSession());
            $result = $qr->createQr($ticket, $event[0]);
            $this->Cell(200, 10, $this->Image($result, 130, 35, 50, 50, "PNG"));
            $this->Ln(10);
            $this->Cell(40, 10, 'Client ID: ' . $user['users_id'] . ' Name: ' . $user['billing_name'] . ' ' . $user['billing_lastname']);
            $this->Ln(10);
            if ($event[0]->getCategory() === 'food') {
                $this->Cell(40, 10, 'Reservation: ' . $event[0]->getTitle());
            } else {
                $this->Cell(40, 10, 'Event: ' . $event[0]->getTitle());
            }
            $this->Ln(10);
            $this->Cell(40, 10, 'Price: ' . number_format($ticket->getPrice(), 2, ',', '') . chr(128));
            $this->Ln(10);
            if ($event[0]->getCategory() === 'food') {
                $this->Cell(40, 10, 'Valid for ' . ($ticket->getPrice() / $event[0]->getPrice()) . ' persons');
            } else {
                $this->Cell(40, 10, 'Valid for 1 person');
            }
            $this->Ln(10);
            $this->Cell(40, 10, 'Expires:' . $ticket->getExpire());
        }
    }
}

class InvoicePDF extends Fpdf
{
    function Header()
    {
        $this->SetFont('Arial', '', 18);
        $this->Cell(55);
        $this->Cell(30, 10, 'Haarlem Festival Invoice');
        $this->Ln(20);
    }

    public function ImportantInformation($tickets)
    {
        $u = new UserRepository();
        $o = new OrderRepository();
        $this->SetFont('Arial', '', 14);
        $this->AddPage();
        $user = $u->findUser($tickets[0]->getOrder());
        $payment = $o->getPayment($tickets[0]->getOrder());
        $date = new DateTime($payment->paidAt);
        $this->Cell(40, 10, 'Payment Date: ' . date_format($date, 'd/m/Y h:i'));
        $this->Ln(10);
        $this->Cell(40, 10, 'Invoice Date: ' . date("d/m/Y h:i"));
        $this->Ln(10);
        $this->Cell(40, 10, 'Name: ' . $user['billing_name'] . ' ' . $user['billing_lastname']);
        $this->Ln(10);
        $this->Cell(40, 10, 'Client ID: ' . $user['users_id']);
        $this->Ln(10);
        $this->Cell(40, 10, 'Address: ' . $user['billing_address'] . ' Country: ' . $user['billing_country']);
        $this->Ln(10);
        $this->Cell(40, 10, 'Email: ' . $user['email'] . ' Phone Number: ' . $user['billing_phone']);
        $this->Ln(30);
    }
    public function HeaderTable()
    {
        $this->Cell(20, 10, 'ID', 1, 0, 'C');
        $this->Cell(70, 10, 'NAME', 1, 0, 'C');
        $this->Cell(30, 10, 'PRICE', 1, 0, 'C');
        $this->Cell(20, 10, 'TAX', 1, 0, 'C');
        $this->Ln();
    }
    public function Body($tickets)
    {

        $eventInfo = new TicketsRepository();

        $total = 0;
        $vat = 0;
        $this->SetFont('Arial', '', 12);
        foreach ($tickets as $ticket) {
            $event = $eventInfo->getEvent($ticket->getSession());
            $this->Cell(20, 10, $event[0]->getId(), 1, 0, 'C');
            $this->Cell(70, 10, $event[0]->getTitle(), 1, 0, 'C');
            $this->Cell(30, 10, number_format($ticket->getPrice(), 2, ',', '') . chr(128), 1, 0, 'C');
            $this->Cell(20, 10, '9%', 1, 0, 'C');
            $total += $ticket->getPrice();
            $vat += (($ticket->getPrice() / 100) * 9);
            $this->Ln();
        }
        $this->SetFont('Arial', '', 14);
        $this->Ln(10);
        $this->Cell(40, 10, 'VAT: ' . number_format($vat, 2, ',', '') . chr(128));
        $this->Ln(10);
        $this->Cell(40, 10, 'Total: ' . number_format($total, 2, ',', '') . chr(128));
    }
}
class qr
{
    public function createQr($ticket, $event)
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data("/ticket/confirm?ticketid=" . $ticket->getIdentifier())
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText($event->getTitle())
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();

        //$result->saveToFile(__DIR__.'/qrCodes/qrcode'.$ticket->getId().'.png');
        $dataUri = $result->getDataUri();
        return $dataUri;
    }
}
class mail
{
    function sendOrder($tickets, $t, $i)
    {
        $mail = new PHPMailer();
        $u = new UserRepository();
        $user = $u->findUser($tickets[0]->getOrder());
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'haarlemfestivalmailer@gmail.com';                     //SMTP username
            $mail->Password   = '@HaarlemFestival1';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('haarlemfestivalmailer@gmail.com', 'Haarlem Festival');
            $mail->addAddress($user['email'], $user['billing_name'].' '.$user['billing_lastname']);     //Add a recipient

            //Attachments
          //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
           // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Tickets & Invoice | Order '.$tickets[0]->getOrder();
            $mail->Body    = 'Hello '.$user['billing_name'].', <br/><br/> Have fun at the event, see attachments for the invoice and the tickets';

            $mail->addStringAttachment($i, 'Haarlem_Festival_Invoice.pdf');
            $mail->addStringAttachment($t, 'Haarlem_Festival_Tickets.pdf');

            $mail->send();
            echo 'Message has been sent';
        } catch (exep $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
