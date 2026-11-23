<?php

namespace App\Controllers;

use App\Models\EstudiantesModel;

class Pages extends BaseController
{
    protected $helpers = ['url', 'form'];
    
    public function index(int $page = 1): string
    {
        $datos = $this->get_cursos($page);
        $pager = service('pager');
        $pager->setPath('cursos/page');
        $perPage = 20;
        $total = isset($datos->elements) ? $datos->paging->total : 0;
        $data['page'] = 'home';
        $data['cursos'] = isset($datos->elements) ? $datos->elements : array();
        $data['paginado'] = $pager->makeLinks($page, $perPage, $total, 'default_full', 3);
        return view('templates/header', $data)
            .view('pages/home', $data)
            .view('templates/footer', $data);
    }
    
    public function view($slug = false)
    {
        $datos = $this->get_curso($slug);
        $estudiantesModel = model('EstudiantesModel');
        $data['page'] = 'curso';
        $data['curso'] = $datos->elements[0];
        $data['registrados'] = $estudiantesModel->get_registrados($data['curso']->id);
        $data['usuarios'] = $estudiantesModel->get_disponibles($data['curso']->id);
        if (empty($data['curso'])) {
            show_404();
        }
        return view('templates/header', $data)
            .view('pages/curso', $data)
            .view('templates/footer', $data);
    }
    
    private function get_cursos(int $page = 1)
    {
        $start = 20 * ($page - 1);
        return $this->call_client(['fields' => 'photoUrl,description', 'start' => $start, 'limit' => 20]);
    }
    
    private function get_curso($slug = false)
    {
        return $this->call_client(['q' => 'slug', 'slug' => $slug, 'fields' => 'partnerLogo']);
    }
    
    private function call_client($params = [])
    {
        $datos = array();
        $client = service('curlrequest', ['baseURI' => 'https://api.coursera.org/api/', 'verify' => false]);
        $response = $client->request('GET', 'courses.v1', [
            'query' => $params,
            'http_errors' => false
            ]);
        if ($response->getStatusCode() == 200 and str_contains($response->header('content-type'), 'application/json')) {
            $datos = json_decode($response->getBody());
        }
        return $datos;
    }
}
