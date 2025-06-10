<?php

namespace App\Listeners;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AddDynamicMenuItems
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BuildingMenu $event): void
    {
        $periodoActivo = DB::table('PeriodosAcademicos')
            ->where('fecha_inicio', '<=', now())
            ->where('fecha_fin', '>=', now())
            ->exists();
        
        if ($periodoActivo) {
            $event->menu->addBefore('administracion_header', 
            [
                'text' => 'Periodo Académico Activo',
                'url' => url('/periodo-academico'),
                'icon' => 'fas fa-calendar',
            ]);
        } else {
            $event->menu->addBefore('administracion_header', 
            [
                'text' => 'Iniciar periodo académico',
                'url' => url('/periodo-academico'),
                'icon' => 'fas fa-calendar-plus',
            ]);
        }
    }
}
