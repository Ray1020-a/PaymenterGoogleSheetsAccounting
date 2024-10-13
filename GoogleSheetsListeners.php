<?php

namespace App\Extensions\Events\GoogleSheets;

use App\Events\Invoice\InvoicePaid;
use DateTime;
use DateTimeZone;
use App\Helpers\ExtensionHelper;

class GoogleSheetsListeners
{
    private function sendgoogle(string $time, string $money, string $id) {
        $url = 'https://script.google.com/macros/s/' . ExtensionHelper::getConfig('GoogleSheets', 'script_id') . '/exec';
        $invoiceinfo = 'https://store.mcloudtw.com/admin/invoices/' . $id;

        $data = json_encode([
            'a' => $time,
            'b' => $money,
            'c' => '*',
            'd' => '*',
            'e' => '*',
            'f' => '*',
            'g' => '*',
            'h' => '*',
            'i' => '*',
            'j' => $invoiceinfo,
        ]);
    
        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n", // Set content type to application/json
                'method'  => 'POST',
                'content' => $data,
            ],
        ];
        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        return $result;
    }

    /**
     * Handle the Invoice paid event.
     */
    public function handleInvoicePaid(InvoicePaid $event): void
    {
        $invoice = $event->invoice;
        $money = $invoice->total();
        $timedate = new DateTime("now", new DateTimeZone("Asia/Taipei"));
        $time = $timedate->format('Y-m-d');
        $id = $invoice->id;
        $this->sendgoogle($time, $money, $id);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(): array
    {
        return [
            InvoicePaid::class => 'handleInvoicePaid',
        ];
    }
}
