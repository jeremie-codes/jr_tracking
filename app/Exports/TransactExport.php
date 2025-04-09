<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class TransactExport implements FromCollection, WithStyles
{

    private $rapports;
    private $date;

    public function __construct($rapports, $date)
    {
        $this->rapports = $rapports;
        $this->date = $date;
    }

    public function collection()
    {
        $data = [];

        // Titre ou lignes personnalisées
        $data[] = ['Rapport Journalière Des Transactions']; // Ligne 1
        $data[] = ['Date du rapport : ' . $this->date]; // Ligne 2
        $data[] = ['']; // Ligne 3

        // Ajouter la ligne actuelle
        $data[] = ['Nom de l\'agent', 'Numéro AG', 'Dépot', '', 'Retrait', ''];
        $data[] = ['', '', 'CDF', 'USD', 'CDF', 'USD']; // Ligne 3

        foreach ($this->rapports as $rapport) {
            $data[] = [
                $rapport['client'],
                $rapport['numero'],
                $rapport['depot_cdf'],
                $rapport['depot_usd'],
                $rapport['retrait_cdf'],
                $rapport['retrait_usd'],
            ];
        }

        $total = [
            'depot_cdf' => 0, 'depot_usd' => 0,
            'retrait_cdf' => 0, 'retrait_usd' => 0,
        ];

        // Vérifie si c'est la dernière ligne
        foreach ($this->rapports as $rapport) {
            $total['depot_cdf'] += (float) $rapport['depot_cdf'] ?? 0;
            $total['depot_usd'] += (float) $rapport['depot_usd'] ?? 0;
            $total['retrait_cdf'] += (float) $rapport['retrait_cdf'] ?? 0;
            $total['retrait_usd'] += (float) $rapport['retrait_usd'] ?? 0;
        }

        $data[] = [
            'TOTAL',
            '',
            $total['depot_cdf'],
            $total['depot_usd'],
            $total['retrait_cdf'],
            $total['retrait_usd'],
        ];

        // dd(collect($data));
        return collect($data);
    }

    public function styles(Worksheet $sheet)
    {

        // Récupérer le nombre total de lignes en tenant compte de la ligne TOTAL
        $rowCount = $this->collection()->count(); // +5 pour inclure l'en-tête

        // Fusionner les cellules des en-têtes
        $sheet->mergeCells("A1:F1");
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells("A2:F2");
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells("A4:A5");
        $sheet->mergeCells("B4:B5");
        $sheet->mergeCells("C4:D4");
        $sheet->mergeCells("E4:F4");
        $sheet->mergeCells("A$rowCount:B$rowCount");

        // Appliquer la largeur des colonnes
        $sheet->getColumnDimension('A')->setAutoSize(true);

        // active le retour à la ligne
        $sheet->getStyle("A6:F$rowCount")->getAlignment()->setWrapText(true);
        $sheet->getStyle("B4:F$rowCount")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("A4")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A4:F$rowCount")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Appliquer des bordures à tout le tableau
        $sheet->getStyle("A4:F$rowCount")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Appliquer la largeur des colonnes
        foreach (range('A', 'F') as $column) { // Ajuster selon le nombre de colonnes
            $sheet->getColumnDimension($column)->setWidth(20); // Largeur fixe pour toutes les colonnes
        }

        // Appliquer la hauteur des lignes
        $lastRow = $sheet->getHighestRow(); // Dernière ligne de données
        for ($row = 4; $row <= $lastRow; $row++) { // Commencer après les titres
            $sheet->getRowDimension($row)->setZeroHeight(20); // Hauteur fixe
        }

        // Mettre en gras la ligne TOTAL
        $sheet->getStyle("A$rowCount:F$rowCount")->applyFromArray([
            'font' => ['bold' => true],
        ]);

        return [
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
            4 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
        ];
    }

}
