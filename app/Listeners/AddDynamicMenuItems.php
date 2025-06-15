<?php

namespace App\Listeners;

use App\Models\Institucion;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AddDynamicMenuItems
{
    public array $institucionEnabledMenu;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->institucionEnabledMenu = config('adminlte.institucion_enabled_menu', []);
    }

    /**
     * Handle the event.
     */
    public function handle(BuildingMenu $event): void
    {
        $institucion = Institucion::find(1);
        $periodoActivo = DB::table('PeriodosAcademicos')
            ->where('fecha_inicio', '<=', now())
            ->where('fecha_fin', '>=', now())
            ->exists();
        if ($institucion && count($this->institucionEnabledMenu) > 0) {
            $event->menu->add(...$this->institucionEnabledMenu);
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
}
