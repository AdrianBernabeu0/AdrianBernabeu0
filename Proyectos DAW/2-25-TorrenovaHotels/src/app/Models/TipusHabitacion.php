<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipusHabitacion extends Model
{
  use HasFactory;
  protected $fillable = [
    'nom',
    'preu_base'
];


//Funció per recollir l'habitació
public static function getTipusHabitacioByHabitacioId($idHabitacio)
{
    $tipusHabitacio = DB::table('habitacions')
        ->join('tipus_habitacions', 'habitacions.tipus_habitacions_id', '=', 'tipus_habitacions.id')
        ->where('habitacions.id', $idHabitacio)
        ->select(
            'tipus_habitacions.nom as NomTipusHabitacio',
            'tipus_habitacions.preu_base as PreuTipusHabitacio'
        )
        ->first();
    return $tipusHabitacio;
}
public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
    public function habitacion(): HasMany
    {
        return $this->hasMany(Habitacion::class);
    }
    public static function getTipusHabitacionsWithoutHotel()
    {
        $tipusHabitacions = DB::table('tipus_habitacions')
            ->whereNull('hotel_id')
            ->select('id', 'nom as NomTipusHabitacio', 'preu_base')
            ->orderBy('nom')
            ->get();
    
        return $tipusHabitacions;
    }

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
}
