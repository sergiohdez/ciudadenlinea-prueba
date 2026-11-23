<?php

namespace App\Models;

use CodeIgniter\Model;

class EstudiantesModel extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombres', 'apellidos', 'cedula', 'genero', 'email'];
    protected array $casts = ['id' => 'int', 'cedula' => 'int'];
    protected $validationRules = [
        'nombres' => 'trim|htmlspecialchars|required|min_length[5]|max_length[40]',
        'apellidos' => 'trim|htmlspecialchars|required|min_length[5]|max_length[40]',
        'cedula' => 'required|min_length[8]|max_length[25]|is_natural_no_zero|is_unique[estudiante.cedula,id,{id}]',
        'genero' => 'required|exact_length[1]|in_list[M,F]',
        'email' => 'required|is_unique[estudiante.email,cedula,{cedula}]|min_length[5]|max_length[50]|valid_email'
        ];
    
    public function get_estudiantes($id = false) {
        return $id === false ? $this->findAll() : $this->find($id);
    }
    
    public function get_registrados($id = false) {
        return $this->whereIn('id', $this->get_estudiantes_curso($id))->findAll();
    }

    public function get_disponibles($id = false) {
        return $this->whereNotIn('id', $this->get_estudiantes_curso($id))->findAll();
    }
    
    private function get_estudiantes_curso($id = false)
    {
        $registrosModel = model('RegistrosModel');
        $registrados = $registrosModel->get_registrados($id);
        $ids = array_column($registrados, 'id_estudiante');
        return count($ids) == 0 ? array(-1) : $ids;
    }
}