<?php
require_once './app/model/professionalsModel.php';
require_once './app/view/apiView.php';

class professionalsController {
    private $model;
    private $apiView;
    private $data;

    public function __construct() {
        $this->model = new professionalsModel();
        $this->apiView = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function showAll($params = NULL) {
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        if (isset($_GET['sortBy']) && isset($_GET['order'])) { 
            try {
                $sortBy = $_GET['sortBy'];
                $order = $_GET['order'];
                $professionals = $this->model->sortByOrder($sortBy, $order);
                return $this->apiView->response($professionals, 200);
            } catch (InvalidArgumentException $e) {
                return $this->apiView->response($e->getMessage(), 400);
            }
        } else {
            $professionals = $this->model->getAll($limit, $offset);
            $totalProfessionals = $this->model->getTotalCount(); 
            $totalPages = ceil($totalProfessionals / $limit); 

            $response = [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalProfessionals,
                'items' => $professionals,
            ];

            return $this->apiView->response($response, 200);
        } 
    }

    public function showProfesionalById($params = NULL) {
        $id = $params[':ID'];
        $professional = $this->model->getById($id);

        if ($professional) {
            return $this->apiView->response($professional, 200);
        } else {
            return $this->apiView->response("Profesional not found", 404);
        }
    }

    public function add() {
        $professionalData = $this->getData();
    
        if (isset($professionalData->name) && isset($professionalData->last_name) && isset($professionalData->specialty) && isset($professionalData->incorporation)) {
            $id = $this->model->insert($professionalData->name, $professionalData->last_name, $professionalData->specialty, $professionalData->incorporation);
            if ($id) {
                return $this->apiView->response("Professional added with ID $id", 201);
            } else {
                return $this->apiView->response("Error when add professional", 500);
            }
        } else {
            return $this->apiView->response("Incomplete data", 400);
        }
    }

    public function delete($params = NULL) {
        $id = $params[':ID'];
        $result = $this->model->deleteById($id);
    
        if ($result) {
            return $this->apiView->response("Professional with ID $id deleted", 200);
        } else {
            return $this->apiView->response("Professional not found", 404);
        }
    }

    public function update($params = NULL) {
        $id = $params[':ID'];
        $professionalData = $this->getData();
    
        if (isset($professionalData->name) && isset($professionalData->last_name) && isset($professionalData->specialty) && isset($professionalData->incorporation)) {
            $result = $this->model->updateById($id, $professionalData->name, $professionalData->last_name, $professionalData->specialty, $professionalData->incorporation);
            if ($result) {
                return $this->apiView->response("Professional with ID $id updated", 200);
            } else {
                return $this->apiView->response("Professional not found", 404);
            }
        } else {
            return $this->apiView->response("Incomplete data", 400);
        }
    }
    
    public function filterByYear($params) {
        $year = $params[':year']; 

        if (is_numeric($year) && $year > 1900 && $year <= date("Y")) {
            $result = $this->model->filterByYear($year);
            if ($result) {
                $this->apiView->response($result);
            } else {
                $this->apiView->response("No professionals were found incorporated in the specified year.", 404);
            }
        } else {
            $this->apiView->response("Invalid year. Please enter a valid year..", 400);
        }
    }
}