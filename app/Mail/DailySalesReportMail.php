<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailySalesReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $filePath;
    public string $date;

    public function __construct(string $filePath, string $date)
    {
        $this->filePath = $filePath;
        $this->date = $date;
    }

    public function build()
    {
        return $this->subject("Dagelijks verkooprapport {$this->date}")
            ->view('emails.daily_sales_report')
            ->attach($this->filePath, [
                'as' => "sales_summary_{$this->date}.xlsx",
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
    }
}
