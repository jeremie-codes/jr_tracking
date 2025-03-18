<?php

namespace App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use App\Models\PlusieurMouvement;
use App\Models\Devise;
use App\Models\Article;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class CreateMouvement extends Page
{
    protected static string $resource = PlusieurMouvementResource::class;

    protected static string $view = 'filament.clusters.ecriture.resources.plusieur-mouvement-resource.pages.create-mouvement';

    // Déclaration des propriétés pour chaque champ du formulaire
    public $auteur;
    public $type;
    public $montant;
    public $devise_id;
    public $article_id;
    public $date_ref;

    public $auteur2;
    public $type_sortie;
    public $montant_sortie;
    public $devise_sortie;
    public $article_id2;
    public $date_ref2;

    protected function getFormSchema(): array
    {
        return [
            Wizard::make()
                ->steps([
                    $this->getStep1(),
                    $this->getStep2(),
                ])->nextAction(
                    fn (Action $action) => $action->label('Etape suivante'),
                )->previousAction(
                    fn (Action $action) => $action->label('Etape précédente'),
                )->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                    >
                        Soumettre
                    </x-filament::button>
                BLADE)))
        ];
    }

    private function getStep1(): Forms\Components\Wizard\Step
    {
        return Forms\Components\Wizard\Step::make('Entrée')
            ->schema([
                Section::make('')
                    ->schema([
                        TextInput::make('auteur')
                            ->label("Client/Operateur/Auteur/Libellé")
                            ->required()
                            ->reactive(),
                        Select::make('type')
                            ->required()
                            ->placeholder('Choisir')
                            ->reactive()
                            ->options([
                                'Consignation' => 'Consignation',
                                'Paiement dette' => 'Paiement dette',
                                'Manquant retrouvé' => 'Manquant retrouvé',
                                'Paiement commission' => 'Paiement commission',
                                'Approvisionnement' => 'Approvisionnement',
                                'Autres' => 'Autres',
                            ]),
                    ]),

                // Détail de l'entrée
                Section::make('Détail')
                    ->schema([
                        TextInput::make('montant')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Select::make('devise_id')
                            ->required()
                            ->options(Devise::pluck('code', 'id')->toArray())
                            ->placeholder('Choisir'),
                        Select::make('article_id')
                            ->label('Article')
                            ->required()
                            ->options(Article::pluck('name', 'id')->toArray())
                            ->visible(fn ($get) => $get('type') === 'Paiement commission' || $get('type') === 'Approvisionnement')
                            ->placeholder('Choisir'),
                        DatePicker::make('date_ref')
                            ->label("Date réference")
                            ->visible(fn ($get) => $get('type') === 'Paiement dette' || $get('type') === 'Manquant retrouvé')
                            ->required(),
                    ])->columns(2),

                // Remarque de l'entrée
                Section::make('')
                    ->schema([
                        Textarea::make("note")
                            ->label("Motif/Raison/commentaire")
                            ->rows(2)
                            ->visible(fn ($get) => $get('type') === 'Autres'),
                    ])->hidden(fn ($get) => $get('type') !== 'Autres'),
            ]);
    }

    private function getStep2(): Forms\Components\Wizard\Step
    {
        return Forms\Components\Wizard\Step::make('Sortie')
            ->schema([
                // Champ Auteur pour Sortie
                Section::make('')
                ->schema([
                    TextInput::make('auteur2')
                        ->label("Client/Operateur/Auteur/Libellé")
                        ->required()
                        ->reactive()
                        ->default(fn ($get) => $get('nature') === 'sortie' ? '' : null),
                    Select::make('type_sortie')
                        ->required()
                        ->placeholder('Choisir')
                        ->reactive()
                        ->options([
                            'Cession de fond' => 'Cession de fond',
                            'Dette' => 'Dette',
                            'Remboursement' => 'Remboursement',
                            'Excédent retrouvé' => 'Excédent retrouvé',
                            'Dépenses' => 'Dépenses',
                            'Autres' => 'Autres',
                        ]),
                ]),

            // Détail de la sortie
            Section::make('Détail')
                ->schema([
                    TextInput::make('montant_sortie')
                        ->numeric()
                        ->default(0)
                        ->required(),
                    Select::make('devise_sortie')
                        ->required()
                        ->options(Devise::pluck('code', 'id')->toArray())
                        ->placeholder('Choisir'),
                    Select::make('article_id2')
                        ->label('Article')
                        ->required()
                        ->options(Article::pluck('name', 'id')->toArray())
                        ->visible(fn ($get) => $get('type') === 'Cession de fond')
                        ->placeholder('Choisir'),
                    DatePicker::make('date_ref2')
                        ->label("Date réference")
                        ->visible(fn ($get) => $get('type') === 'Remboursement' || $get('type') === 'Excédent retrouvé')
                        ->required(),
                ])->columns(2),

            // Remarque de la sortie
            Section::make('')
                ->schema([
                    Textarea::make("note2")
                        ->label("Motif/Raison/commentaire")
                        ->rows(2)
                        ->visible(fn ($get) => $get('type') === 'Autres'),
                ])  ->hidden(fn ($get) => $get('type') !== 'Autres'),
            ]);
    }

    // Logique pour enregistrer les données des étapes individuellement
    public function submit()
    {
        // Premier tableau : données pour l'entrée
        $data1 = [
            'auteur' => $this->auteur,
            'nature' => 'entrée',
            'type' => $this->type,
            'montant' => $this->montant,
            'devise_id' => $this->devise_id,
            'article_id' => $this->article_id,
            'date_ref' => $this->date_ref,
            'id_ref' => 0, // On va le remplir après avoir créé le second enregistrement
        ];

        // Deuxième tableau : données pour la sortie
        $data2 = [
            'auteur' => $this->auteur2,
            'nature' => 'sortie',
            'type' => $this->type_sortie,
            'montant' => $this->montant_sortie,
            'devise_id' => $this->devise_sortie,
            'article_id' => $this->article_id2,
            'date_ref' => $this->date_ref2,
            'id_ref' => 0, // On va le remplir après avoir créé le premier enregistrement
        ];

        // D'abord, on crée l'entrée (premier enregistrement)
        $entry = PlusieurMouvement::create($data1);

        // Ensuite, on récupère l'ID de l'entrée et on l'ajoute au tableau de la sortie
        $data2['id_ref'] = $entry->id;  // Lier l'entrée à la sortie via l'ID de l'entrée

        // dd($data2);
        // Ensuite, on crée la sortie (deuxième enregistrement)
        $exit = PlusieurMouvement::create($data2);

        // Enfin, on met à jour l'entrée pour qu'elle pointe vers l'ID de la sortie
        $entry->update(['id_ref' => $exit->id]);

        Notification::make()
            ->title('Mouvenment créé avec succès !')
            ->color('success')
            ->duration(5000)
            ->success()
            ->send();

        return redirect(EntréeResource::getUrl('index'));

    }

}
