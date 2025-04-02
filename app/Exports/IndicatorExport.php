<?php

namespace App\Exports;

use App\Models\Devise;
use App\Models\Indicateur;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IndicatorExport implements FromCollection, WithHeadings, WithStyles
{
    private $rapports;
    private $devises;

    public function __construct()
    {
        // Charger toutes les devises
        $this->devises = Devise::all();

        // Charger les mouvements avec leurs relations
        $this->rapports = Indicateur::with(['devise', 'user'])
            ->get()
            ->map(function ($mouvement) {
                return [
                    'type' => $mouvement->type,
                    'auteur' => $mouvement->auteur,
                    'montant' => $mouvement->montant,
                    'devise' => $mouvement->devise->code ?? null,
                    'agent' => $mouvement->user->name ?? 'N/A',
                    'date_ref' => $mouvement->date_ref ? Carbon::parse($mouvement->date_ref)->format('d/m/Y') : null, // Format personnalisé
                    'libelle' => $mouvement->libelle,
                ];
            });
    }

    public function collection()
    {

        // dd($this->rapports);
        $data = [];

        $data[] = ['Rapport Journalière '];
        $data[] = ['Date du rapport : ' . now()->toDateString()];
        $data[] = [''];
        $data[] = ['Date Réf', 'Type', 'Bénéficiaire', 'Agent', 'Montant'];

        $row = [];
        foreach ($this->devises as $devise) {
            $row[] = $devise->code;
        }
        $data[] = ['','','','',...$row];
        // Ajouter les données des mouvements
        foreach ($this->rapports as $rapport) {
            $row = [
                'datref' => $rapport['date_ref'],
                'type' => $rapport['type']. ': '. $rapport['libelle'],
                'auteur' => $rapport['auteur'],
                'agent' => $rapport['agent'],
            ];

            // Ajouter une colonne pour chaque devise
            foreach ($this->devises as $devise) {
                $row[$devise->code] = $rapport['devise'] === $devise->code ? $rapport['montant'] : 0;
            }

            $data[] = $row;
        }

        // Ajouter une ligne pour les totaux par devise
        $totals = [
            'datref' => '',
            'type' => 'Total',
            'auteur' => '',
            'agent' => '',
        ];

        foreach ($this->devises as $devise) {
            $totals[$devise->code] = $this->rapports
                ->where('devise', $devise->code)
                ->sum('montant');
        }

        $data[] = $totals;

        return collect($data);
    }

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A4:H4')->applyFromArray([
            'font' => ['bold' => true],
        ]);

        // Récupérer le nombre total de lignes en tenant compte de la ligne TOTAL
        $rowCount = $this->collection()->count(); // +5 pour inclure l'en-tête

        // Fusionner les cellules des en-têtes
        $sheet->mergeCells("A1:H1");
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells("A2:H2");
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells("A4:A5");
        $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells("B4:B5");
        $sheet->getStyle('B4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells("C4:C5");
        $sheet->getStyle('C4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells("D4:D5");
        $sheet->getStyle('D4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells("E4:H4");
        $sheet->getStyle('E4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("A1:H$rowCount")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle("A2:H$rowCount")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle("A4:H$rowCount")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Appliquer la largeur des colonnes
        foreach (range('A', 'H') as $column) { // Ajuster selon le nombre de colonnes
            $sheet->getColumnDimension($column)->setWidth(10); // Largeur fixe pour toutes les colonnes
        }

        // Appliquer la hauteur des lignes
        $lastRow = $sheet->getHighestRow(); // Dernière ligne de données
        for ($row = 4; $row <= $lastRow; $row++) { // Commencer après les titres
            $sheet->getRowDimension($row)->setRowHeight(20); // Hauteur fixe
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        return [];
    }
}
