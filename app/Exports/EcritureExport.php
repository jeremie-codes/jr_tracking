<?php

namespace App\Exports;

use App\Models\PlusieurMouvement;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class EcritureExport implements FromCollection, WithStyles
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
        $data[] = ['Date du rapport : ' . $this->date]; // Ligne 2
        $data[] = ['Rapport Journalière ']; // Ligne 1
        $data[] = ['']; // Ligne 3

        // Ajouter la ligne actuelle
        $data[] = [['Libellé', 'Entrée','', '', '', 'Sortie', '', '', '', 'Balance', '', '', '',],
                   ['', 'CDF', 'USD', 'EUR', 'CFA', 'CDF', 'USD', 'EUR', 'CFA', 'CDF', 'USD', 'EUR', 'CFA']]; // Ligne 3
        $data[] = $this->rapports;

        $total = [
            'entree_cdf' => 0, 'entree_usd' => 0, 'entree_eur' => 0, 'entree_cfa' => 0,
            'sortie_cdf' => 0, 'sortie_usd' => 0, 'sortie_eur' => 0, 'sortie_cfa' => 0,
        ];

        // Vérifie si c'est la dernière ligne
        foreach ($this->rapports as $rapport) {
            // Calcul des totaux
            $total['entree_cdf'] += (float) $rapport['entree_cdf'] ?? 0;
            $total['entree_usd'] += (float) $rapport['entree_usd'] ?? 0;
            $total['entree_eur'] += (float) $rapport['entree_eur'] ?? 0;
            $total['entree_cfa'] += (float) $rapport['entree_cfa'] ?? 0;
            $total['sortie_cdf'] += (float) $rapport['sortie_cdf'] ?? 0;
            $total['sortie_usd'] += (float) $rapport['sortie_usd'] ?? 0;
            $total['sortie_eur'] += (float) $rapport['sortie_eur'] ?? 0;
            $total['sortie_cfa'] += (float) $rapport['sortie_cfa'] ?? 0;

        }

        // Ajouter la ligne TOTAL
        $data[] = [
            'TOTAL',
            $total['entree_cdf'],
            $total['entree_usd'],
            $total['entree_eur'],
            $total['entree_cfa'],
            $total['sortie_cdf'],
            $total['sortie_usd'],
            $total['sortie_eur'],
            $total['sortie_cfa'],
            $total['entree_cdf'] - $total['sortie_cdf'],
            $total['entree_usd'] - $total['sortie_usd'],
            $total['entree_eur'] - $total['sortie_eur'],
            $total['entree_cfa'] - $total['sortie_cfa'],
        ];

        return collect($data);
    }

    public function styles(Worksheet $sheet)
    {

        // Récupérer le nombre total de lignes en tenant compte de la ligne TOTAL
        $rowCount = $this->collection()->count() + 5; // +5 pour inclure l'en-tête

        // Fusionner les cellules des en-têtes
        $sheet->mergeCells("A1:M1");
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells("A2:M2");
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells("A4:A5");
        $sheet->mergeCells("B4:E4");
        $sheet->mergeCells("F4:I4");
        $sheet->mergeCells("J4:M4");

        // remplir la colonne balance par des fleches
        $sheet->setCellValue('J6', "|");
        $sheet->setCellValue('K6', "|");
        $sheet->setCellValue('L6', "|");
        $sheet->setCellValue('M6', "|");

        // Appliquer la largeur des colonnes
        $sheet->getColumnDimension('A')->setAutoSize(true);

        // active le retour à la ligne
        $sheet->getStyle("A6:M$rowCount")->getAlignment()->setWrapText(true);
        $sheet->getStyle("B4:M$rowCount")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("A4")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A4:M$rowCount")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Fusionner les cellules de la colonne BALANCE (sans inclure la dernière ligne)
        $lastRowToMerge = $rowCount - 1;
        $sheet->mergeCells("J6:J$lastRowToMerge");
        $sheet->mergeCells("K6:K$lastRowToMerge");
        $sheet->mergeCells("L6:L$lastRowToMerge");
        $sheet->mergeCells("M6:M$lastRowToMerge");

        // Appliquer des bordures à tout le tableau
        $sheet->getStyle("A4:M$rowCount")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Appliquer la largeur des colonnes
        foreach (range('A', 'M') as $column) { // Ajuster selon le nombre de colonnes
            $sheet->getColumnDimension($column)->setWidth(10); // Largeur fixe pour toutes les colonnes
        }

        // Appliquer la hauteur des lignes
        $lastRow = $sheet->getHighestRow(); // Dernière ligne de données
        for ($row = 4; $row <= $lastRow; $row++) { // Commencer après les titres
            $sheet->getRowDimension($row)->setRowHeight(20); // Hauteur fixe
        }

        // Mettre en gras la ligne TOTAL
        $sheet->getStyle("A$rowCount:M$rowCount")->applyFromArray([
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
