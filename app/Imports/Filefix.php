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
            /* dd($item['numero_documento']); */
            $document = DB::selectOne("SELECT  * from documentos where concat (documento_serial,documento_code)=?", [
                $item['numero_documento']
            ]);

            if(is_null($document)){
                dd('error el documento' . $item['numero_documento'] . 'No exite en la base de datos');
            }
            $document = Documento::findOrfail($document->id);
            $document->fecha_emision = self::convertDateFormat($item['fecha']);
            $document->save();
            
        }

        DB::commit();

    }

    public static function convertDateFormat($date)
    {
        // Crear una instancia de Carbon desde la fecha proporcionada
        $carbonDate = Carbon::createFromFormat('m/d/Y', trim($date));

        // Convertir la fecha al formato deseado
        $formattedDate = $carbonDate->format('Y-m-d');

        return $formattedDate;
    }

    public function mapping(): array
    {
        return [
            'fecha' => 'A1',
            'numero_documento' => 'A2'
        ];
    }
}
