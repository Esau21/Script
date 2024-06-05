<?php

namespace App\Imports;

use App\Models\Documento;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Filefix implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();

        
        foreach ($collection as $item) {
            $document = DB::selectOne("SELECT * FROM documentos WHERE concat(documento_serial, documento_code) = ?", [
                $item['numero_documento']
            ]);

            if (is_null($document)) {
                dd('Error: el documento ' . $item['numero_documento'] . ' no existe en la base de datos');
            }

            $document = Documento::findOrFail($document->id);

            
            logger()->info('Fecha original: ' . $item['fecha']);

            $formattedDate = self::convertDateFormat($item['fecha']);

            
            logger()->info('Fecha formateada: ' . $formattedDate);

            $document->fecha_emision = $formattedDate;
            $document->save();
        }

        DB::commit();
    }

    
    public static function convertDateFormat($date)
    {
        try {
            // Crear una instancia de Carbon desde la fecha proporcionada en el formato 'd/m/Y'
            $carbonDate = Carbon::createFromFormat('m/d/Y', trim($date));

            // Convertir la fecha al formato MySQL 'Y-m-d'
            $formattedDate = $carbonDate->format('Y-m-d');

            return $formattedDate;
        } catch (\Exception $e) {
            // En caso de error, registrar el error y devolver null
            logger()->error('Error al convertir la fecha: ' . $date . ' - ' . $e->getMessage());
            return null;
        }
    }

    public function mapping(): array
    {
        return [
            'fecha' => 'A1',
            'numero_documento' => 'A2'
        ];
    }
}
