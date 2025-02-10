<?php

namespace App\Filament\Resources\PatenteResource\Pages;

use App\Models\Rodado;
use App\Models\Patente;
use Filament\Forms\Form;
use App\Models\ViewRodado;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Contracts\HasForms;

use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\PatenteResource;
use Filament\Forms\Concerns\InteractsWithForms;

class UploadPatente extends Page
{
    use InteractsWithForms;
    protected static string $resource = PatenteResource::class;

    protected static string $view = 'filament.resources.patente-resource.pages.upload-patente';
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('imagen')
                    ->label('Imagen del vehículo')
                    ->multiple()
                    ->directory('patentes') // Carpeta donde se guardarán las imágenes
                    ->image() // Asegura que solo se suban imágenes
                    ->maxSize(2048) // Tamaño máximo en KB (2MB)
                    ->nullable(),
            ])
            ->statePath('data');
            
    }

    public function getActions(): array
    {
        return [
            Action::make('upload')
                ->label('Submit')
                ->color('success')
                ->action(fn () => $this->upload()), // Llama al método upload()
        ];
    }


    public function upload(): void
    {
        
        $formState = $this->form->getState();
        
        // Verifica si la clave 'imagen' existe
        if (!isset($formState['imagen']) || empty($formState['imagen'])) {
            Notification::make()
                ->title('Error')
                ->body('No se ha subido ninguna imagen.')
                ->danger()
                ->send();
            return;
        }

        // Obtiene la imagen subida
        $imagen = $formState['imagen'][0];


        // Mostrar el valor obtenido
        // dd($imagen);

        // Construye la URL completa del archivo
        $imagePath = storage_path('app/public/' . $imagen); // Ajusta la ruta si es necesario
        //dd($imagePath);
        // Enviar la imagen a FastAPI
        $response = Http::post('http://127.0.0.1:5000/detection_plate', [
            'image_path' => $imagePath,
            'confidence' => 0.25,
        ]);
        // $response = Http::get('http://127.0.0.1:5000/');

        // Manejo de respuesta
        if ($response->successful()) {

            $data = $response->json();

            if (isset($data['results'][0]['plate'])) {

                $plate = $data['results'][0]['plate'] ?? null;

                //dump($plate);

                // Obtener el rodado asociado al dominio
                $rodado = ViewRodado::where('dominio', strtoupper($plate))->first();

                if (isset($rodado['num'])) {
                    $patente  = Patente::where('dominio', strtoupper($plate))->first();
                
                    if ($patente) {
                        Notification::make()
                            ->title('Error')
                            ->body('La patente ya existe.')
                            ->danger()
                            ->send();
                        return;
                    } else {
                        // Crear una nueva patente con los datos del rodado
                        $patente = Patente::create([
                            'dominio' => $rodado['dominio'],
                            'fchregistro' => now(),
                            'marca' => $rodado['marca'],
                            'modelo' => $rodado['modelo'],
                            'marca_name' => $rodado['marca_nom'],
                            'modelo_name' => $rodado['modelo_nom'],
                            'anio' => $rodado['anio'],
                            'obj_id' => $rodado['obj_id'],
                            'imagen' => $imagePath,
                        ]);
                        $patente->save();
                        // Guardar los datos de la persona asociada al rodado
                        //$persona = Persona::where('id', $rodado['persona_id'])->first();
                        // Redirigir a la página de detalles de la patente
                        //return redirect()->route('filament.resources.patente.edit', ['record' => $patente->id]);
                    }
                }

                //dd($rodado);

                Notification::make()
                    ->title('Éxito')
                    ->body('Detección completada. Resultado: ' . json_encode($plate))
                    ->success()
                    ->send();
            }else{
                Notification::make()
                ->title('Error')
                ->body('No se pudo procesar el dominio.')
                ->danger()
                ->send();
            }
        } else {
            Notification::make()
                ->title('Error')
                ->body('No se pudo procesar la imagen.')
                ->danger()
                ->send();
        }
    }

}
