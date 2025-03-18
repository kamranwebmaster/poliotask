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

    public function getCampaigns()
    {
 
        $builder = $this->db->table($this->table);
        $builder->select('campaigns.*, geodata.target AS target_p');
        $builder->join('geodata', 'geodata.prov = campaigns.prov AND geodata.union = campaigns.union', 'inner');
        $builder->groupBy(['geodata.prov', 'geodata.dist']);
        $builder->orderBy('geodata.prov', 'DESC'); // Sorting by prov in descending order
    
        $query = $builder->get(); 
    
        if (!$query) {
            // Log or print the last query error
            die($this->db->error()['message']); // Show SQL error
        }
    
        return $query->getResultArray();
         
         }


         public function getCoverageByLocation()
         {
      
            $db = \Config\Database::connect();
        $query = $db->query("
            
SELECT c.prov, c.district, c.tehsil, c.union, 
                   SUM(v.vaccinated_children) AS vaccinated, 
                   SUM(geodata.target) AS target_population
            FROM vaccination_data v
            
            
            JOIN campaigns c ON c.id = v.campaign_id
            
            
JOIN geodata ON (geodata.prov = c.prov 
            AND geodata.union = c.union  )
            
            GROUP BY c.prov, c.district, c.tehsil, c.union
        ");

        return $query->getResultArray();
              
              }

              public function getCoveragemissing()
              {
           
                 $db = \Config\Database::connect();
             $query = $db->query("
                 SELECT c.prov, c.district, c.tehsil, c.union, 
            SUM(geodata.target) AS target_population,
            SUM(v.vaccinated_children) AS vaccinated, 
            SUM(v.missed_na + v.missed_refusals) AS missed_children,
            SUM(CASE 
                    WHEN v.vaccinated_children > 0 
                         AND (v.missed_na > 0 OR v.missed_refusals > 0) 
                    THEN 1 
                    ELSE 0 
                END) AS covered_missed_children
     FROM vaccination_data v
     JOIN campaigns c ON c.id = v.campaign_id
     JOIN geodata ON geodata.prov = c.prov 
                AND geodata.union = c.union
     GROUP BY c.prov, c.district, c.tehsil, c.union;
     
             ");
     
             return $query->getResultArray();
                   
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
