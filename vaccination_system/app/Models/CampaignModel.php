<?php
namespace App\Models;

use CodeIgniter\Model;

class CampaignModel extends Model
{
    protected $table = 'campaigns';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'year', 'month', 'type', 'geographic_scope'];
    // Get all campaigns (Admin)
    public function getAllCampaigns()
    {
        return $this->db->get('campaigns')->result_array();
    }

    // Insert new campaign
    public function insertCampaign($data)
    {
        $this->db->insert('campaigns', $data);
    }

    // Get campaigns by UC
    public function getCampaignsByUC($uc_id)
    {
        $this->db->where('geographic_scope', $uc_id);
        return $this->db->get('campaigns')->result_array();
    }

    // Insert coverage data
    public function insertCoverageData($data)
    {
        $this->db->insert('coverage_data', $data);
    }
}
