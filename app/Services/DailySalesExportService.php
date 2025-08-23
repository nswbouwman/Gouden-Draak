<?php

namespace App\Services;

use App\Models\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class DailySalesExportService
{
    public function generateForDate($date = null)
    {
        $date = $date ?? now()->toDateString();

        $orders = Order::with('items.menuItem')
            ->whereDate('created_at', $date)
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Tafel');
        $sheet->setCellValue('B1', 'Gerecht');
        $sheet->setCellValue('C1', 'Aantal');
        $sheet->setCellValue('D1', 'Prijs');
        $sheet->setCellValue('E1', 'Totaal');

        $row = 2;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $sheet->setCellValue("A$row", $order->table_nr);
                $sheet->setCellValue("B$row", $item->menuItem->name);
                $sheet->setCellValue("C$row", $item->quantity);
                $sheet->setCellValue("D$row", $item->price);
                $sheet->setCellValue("E$row", $item->quantity * $item->price);
                $row++;
            }
        }

        $sheet->setCellValue("D$row", "Omzet:");
        $sheet->setCellValue("E$row", $orders->flatMap->items->sum(fn($i) => $i->quantity * $i->price));

        $filename = "sales/sales_summary_{$date}.xlsx";
        $writer = new Xlsx($spreadsheet);

        Storage::makeDirectory('sales');
        $writer->save(Storage::path($filename));

        return $filename;
    }
}
