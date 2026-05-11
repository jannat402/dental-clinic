<?php

namespace App\Console\Commands;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ArchiveInactiveUsers extends Command
{
    protected $signature = 'users:archive-inactive';
    protected $description = 'Arxiva clients inactius durant més de 24 mesos';

    public function handle(): void
    {
        $limit = Carbon::now()->subMonths(24);

        $inactius = Cliente::where('ultima_actividad', '<', $limit)
            ->orWhereNull('ultima_actividad')
            ->where('fecha_carga', '<', $limit)
            ->get();

        $count = 0;
        foreach ($inactius as $client) {
            $client->update(['estat' => 'arxivat']);
            $count++;
        }

        $this->info("S'han arxivat {$count} clients inactius.");
    }
}
