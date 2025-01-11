<?php
namespace App\Controllers;

use App\Models\CampaignModel;

class FieldWorkerController extends BaseController
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



            return view('fdashboard', ['campaigns' => $campaigns]);
        } catch (\Exception $e) {
            // Log the exception for troubleshooting
            log_message('error', $e->getMessage());

            // Show the error message directly for debugging purposes
            echo "Error: " . $e->getMessage();
            exit;
        }

        return view('fdashboard', ['campaigns' => $campaigns]);
    }

    public function submitData()
{
    // Get the POST data
    $campaign_id = $this->request->getPost('campaign_id');
    $coverage = $this->request->getPost('coverage');

    // Validate the input fields
    if (!$campaign_id || !$coverage) {
        // Redirect with an error message if any required field is missing
        return redirect()->to('/field-worker/dashboard')->with('error', 'Campaign ID and coverage are required fields.');
    }

    // You can perform additional validation here for 'coverage' if needed, for example:
    // - Check if coverage is a valid number or percentage
    // - Validate the format of campaign ID if needed (e.g., check if it exists in the database)
    
    // Example: Check if the campaign_id exists in the database (assuming you have a model for Campaigns)
    $campaignModel = new \App\Models\CampaignModel();
    $campaign = $campaignModel->find($campaign_id);
    //print_r( $campaign );exit;

    if (!$campaign) {
        // If the campaign is not found, show an error
        return redirect()->to('/field-worker/dashboard')->with('error', 'Invalid campaign ID.');
    }

    // Assuming you have a model for storing coverage data, e.g., CoverageModel
    $coverageModel = new \App\Models\CoverageModel();

    // Insert the data (You can add more fields as required)
    $data = [
        'campaign_id' => $campaign_id,
        'coverage' => $coverage,
        'submitted_by' => session()->get('user_id'),  // Use the logged-in user's ID
        'submitted_at' => date('Y-m-d H:i:s'),  // Timestamp for when the data is submitted
    ];
   // print_r( $data );exit;

    // Save the data in the database
    if ($coverageModel->save($data)) {
//          echo $this->db->getLastQuery(); // Display the last executed query
// exit;
        // Redirect with a success message
        return redirect()->to('/field-worker/dashboard')->with('success', 'Data submitted successfully');
    } else {
        // Handle any errors that occurred while saving the data
        return redirect()->to('/field-worker/dashboard')->with('error', 'Failed to submit data. Please try again.');
    }
}

}
