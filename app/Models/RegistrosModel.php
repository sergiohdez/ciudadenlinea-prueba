<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrosModel extends Model
{
    protected $table = 'registro';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_estudiante', 'id_curso'];
    protected array $casts = ['id_estudiante' => 'int'];
    protected $validationRules = [
        'id_estudiante' => 'required|max_length[10]|numeric',
        'id_curso' => 'required|max_length[25]'
        ];
    
    public function get_registrados($id = false)
    {
        if ($id === false) {
            return array();
        }
        return $this->where('id_curso', $id)->findAll();
    }
}