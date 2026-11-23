<?php

namespace App\Controllers;

use App\Models\EstudiantesModel;
use App\Models\RegistrosModel;

class Estudiantes extends BaseController
{
    protected $helpers = ['url', 'form'];
    
    public function create() {
        $data['page'] = 'registro';
        $data['errors'] = array();
        if ($this->request->is('post')) {
            $rules = [
                'nombres' => [
                    'label' => 'Nombres',
                    'rules' => 'trim|htmlspecialchars|required|min_length[5]|max_length[40]',
                    'errors' => [
                        'required' => 'El campo %s es requerido',
    			        'min_length' => 'El campo {field} debe tener mínimo {param} caracteres',
    			        'max_length' => 'El campo {field} debe tener máximo {param} caracteres',
                    ]
                ],
                'apellidos' => [
                    'label' => 'Apellidos',
                    'rules' => 'trim|htmlspecialchars|required|min_length[5]|max_length[40]',
                    'errors' => [
                        'required' => 'El campo %s es requerido',
            			'min_length' => 'El campo {field} debe tener mínimo {param} caracteres',
            			'max_length' => 'El campo {field} debe tener máximo {param} caracteres',
                    ]
                ],
                'cedula' => [
                    'label' => 'Identificación',
                    'rules' => 'trim|required|is_unique[estudiante.cedula,id,{id}]|min_length[8]|max_length[25]|is_natural_no_zero',
                    'errors' => [
                        'required' => 'El campo %s es requerido',
                        'is_unique' => 'Ya existe un estudiante con la misma identificación',
            			'min_length' => 'El campo {field} debe tener mínimo {param} caracteres',
            			'max_length' => 'El campo {field} debe tener máximo {param} caracteres',
            			'is_natural_no_zero' => 'El campo {field} debe ser un número mayor a cero',
                    ]
                ],
                'genero' => [
                    'label' => 'Género',
                    'rules' => 'required|exact_length[1]|in_list[M,F]',
                    'errors' => [
                        'required' => 'El campo %s es requerido',
                        'exact_length' => 'El campo {field} debe tener exactamente {param} caracter',
                        'in_list' => 'El campo {field} solo acepta los valores {param}'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email|is_unique[estudiante.email,cedula,{cedula}]|min_length[5]|max_length[50]',
                    'errors' => [
                        'required' => 'El campo %s es requerido',
                        'valid_email' => 'El %s no es válido',
                        'is_unique' => 'Ya existe un estudiante con el mismo email',
        			    'min_length' => 'El campo {field} debe tener mínimo {param} caracteres',
        			    'max_length' => 'El campo {field} debe tener máximo {param} caracteres',
                     ]
                 ]
            ];
            $form_data = $this->request->getPost(array_keys($rules));
            $data['msg'] = '';
            if ($this->validateData($form_data, $rules) === false) {
                $data['errors'] = $this->validator->getErrors();
            } else {
                $validData = $this->validator->getValidated();
                $estudiantesModel = model('EstudiantesModel');
                $result = $estudiantesModel->insert($validData);
                if ($result === false)
                {
                    $data['errors'] = $estudiantesModel->errors();
                }
                else {
                    $data['msg'] = 'Registro de estudiante exitoso';
                }
            }
        }
        return view('templates/header', $data)
            .view('pages/registro', $data)
            .view('templates/footer', $data);
    }
    
    public function register() {
        $rules = [
            'id_curso' => 'required',
            'estudiantes' => [
                'label' => 'Estudiantes',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Se debe seleccionar al menos un estudiante']
                ]
            ];
        $form_data = $this->request->getPost(array_keys($rules));
        if ($this->validateData($form_data, $rules) === false) {
            $data['error'] = true;
            $data['msg'] = $this->validator->getError('estudiantes');
        } else {
            $validData = $this->validator->getValidated();
            $formData = array_map(
                fn($idEst) => ['id_curso' => $validData['id_curso'], 'id_estudiante' => $idEst],
                $validData['estudiantes']
            );
            $registrosModel = model('RegistrosModel');
            $result = $registrosModel->insertBatch($formData);
            if ($result === false)
            {
                $data['error'] = true;
                $data['msg'] = $registrosModel->errors();
            }
            else {
                $data['error'] = false;
                $data['msg'] = 'Registro de estudiante exitoso';
            }
        }
        echo json_encode($data);
    }
}
