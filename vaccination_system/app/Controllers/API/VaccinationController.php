<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\VaccinationModel;

class VaccinationController extends ResourceController
{
    protected $modelName = 'App\Models\VaccinationModel';
    protected $format    = 'json';

    public function submitData()
    {
        $data = $this->request->getJSON(true);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'campaign_id' => 'required|integer',
            'uc_id' => 'required|integer',
            'vaccinated_children' => 'required|integer',
            'missed_na' => 'required|integer',
            'missed_refusals' => 'required|integer',
        ]);

        if (!$validation->run($data)) {
            return $this->fail($validation->getErrors());
        }

        $this->model->insert($data);
        return $this->respond(['message' => 'Data submitted successfully']);
    }
}
