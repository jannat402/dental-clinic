<?php

namespace App\Services;

use App\Models\Auditoria;

class AuditService
{
    public function registrar(
        string $accio,
        string $entitatType,
        int $entitatId,
        ?array $valorsAnteriors = null,
        ?array $valorsNous = null,
        ?string $usuariType = null,
        ?int $usuariId = null
    ): Auditoria {
        return Auditoria::create([
            'usuario_type' => $usuariType,
            'usuario_id' => $usuariId,
            'accio' => $accio,
            'entitat_type' => $entitatType,
            'entitat_id' => $entitatId,
            'valors_anteriors' => $valorsAnteriors,
            'valors_nous' => $valorsNous,
        ]);
    }

    public function registrarAdmin(int $adminId, string $accio, string $entitatType, int $entitatId, ?array $old = null, ?array $new = null): Auditoria
    {
        return $this->registrar($accio, $entitatType, $entitatId, $old, $new, 'administrativo', $adminId);
    }

    public function registrarDoctor(int $doctorId, string $accio, string $entitatType, int $entitatId, ?array $old = null, ?array $new = null): Auditoria
    {
        return $this->registrar($accio, $entitatType, $entitatId, $old, $new, 'doctor', $doctorId);
    }
}
