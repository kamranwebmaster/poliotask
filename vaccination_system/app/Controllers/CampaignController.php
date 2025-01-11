<?php
namespace App\Controllers;

use App\Models\CampaignModel;

class CampaignController extends BaseController
{

    protected $db;
    protected $session;
    protected $userModel;

    public function __construct()
    {
        try {
            $this->db = \Config\Database::connect(); // Ensure database connection is working
            $this->session = \Config\Services::session();
         } catch (\Exception $e) {
            // Log and display the error
            log_message('error', $e->getMessage());
            echo "Error in constructor: " . $e->getMessage();
            exit;
        }
    }

    public function index()
    {
        if (!session()->get('loggedIn')) {
            return redirect()->to("/login");
        }
        try {
            $model = new CampaignModel();
            $campaigns = $model->findAll();

            // Debugging: Print the data to verify it's fetched correctly



            return view('compaign', ['campaigns' => $campaigns]);
        } catch (\Exception $e) {
            // Log the exception for troubleshooting
            log_message('error', $e->getMessage());

            // Show the error message directly for debugging purposes
            echo "Error: " . $e->getMessage();
            exit;
        }
    }


    public function create()
    {
        return view('create_campaign');
    }

    public function store()
    {
        $data = [
            'campaign_name' => $this->request->getPost('campaign_name'),
            'year' => $this->request->getPost('year'),
            'month' => $this->request->getPost('month'),
            'campaign_type' => $this->request->getPost('campaign_type'),
            'geographic_scope' => $this->request->getPost('geographic_scope'),
            'target_population' => $this->request->getPost('target_population')
        ];

        $model = new CampaignModel();
        $model->insert($data);

        return redirect()->to('/admin/dashboard');
    }
}
