<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
 
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

 
    protected $allowedFields = ['username', 'password', 'role_id'];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createUser($param  )
    {

        
      $user= $this->verifyUser($param['user_email'] ,$param['user_password'] );
    
      if (  $user->resultID->num_rows == 0)  
{ 
     
     
        $builder = $this->db->table($this->table);
       
        $passwords = password_hash($param['user_password'], PASSWORD_BCRYPT);
        $temp_holder = [
            'user_fullname' => $param['user_fullname'], 
            'user_email' => $param['user_email'], 
            'user_password' =>$passwords
        ]; 
 
        $builder->insert($temp_holder); 
       /// $builder->insert('users',$temp_holder);
    
    //    error_reporting(E_ALL);
    //    ini_set('display_errors', 1);
     //  echo $this->db->getLastQuery();   exit;
   // var_dump($_POST);  die();
   
        return true;
    }
    else return false;
    }

 

    public function verifyUser($email, $password)
    {
        return $this->table($this->table)->where('user_email', $email)->get();
    }

    public function validateUser($email)
    {
        return $this->table($this->table)->where('user_email', $email)->get()->getRow();
    }

       

    public function getUsersById($id)
    {
        $builder = $this->db->table($this->table); 
        $builder->select('user.*,
        SUBSTRING_INDEX(user.user_fullname, " ", 1) AS first_name,
        SUBSTRING_INDEX(user.user_fullname, " ", -1) AS last_name,
        user_profile.contact_number, user_profile.district, user_profile.contact_number, user_profile.account_type, roles.id as role_id, roles.name as role_name');
        $builder->join('user_profile', 'user_profile.user_profile_Id = user.user_id', 'left');
        $builder->join('roles', 'roles.id = user.role_id', 'inner');
        $builder->where('user.user_id', $id);
        $query = $builder->get();
        return $query->getRow();

        
    }

    public function getTotalFilteredUsers($name, $district, $phone, $email, $role)
    {
        $builder = $this->db->table($this->table);
        $this->applyFilters($builder, $name, $district, $phone, $email, $role);
        return $builder->countAllResults();
    }

 

    // Helper function to apply search filters
    private function applyFilters($builder, $name, $district, $phone, $email, $role)
    {
        if ($name) $builder->like('user.user_fullname', $name);
        if ($district) $builder->like('user_profile.district', $district);
        if ($phone) $builder->like('user_profile.contact_number', $phone);
        if ($email) $builder->like('user.user_email', $email);
        if ($role) $builder->like('roles.name', $role);

        //
    }
}
