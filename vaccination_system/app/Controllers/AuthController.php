<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $db;
    protected $session;
    protected $userModel;

    public function __construct()
    {
        try {
            $this->db = \Config\Database::connect(); // Ensure database connection is working
            $this->session = \Config\Services::session();
            $this->userModel = new UserModel(); // Corrected to use `UserModel`
        } catch (\Exception $e) {
            // Log and display the error
            log_message('error', $e->getMessage());
            echo "Error in constructor: " . $e->getMessage();
            exit;
        }
    }

    public function login()
    {
         
         $this->session = \Config\Services::session();

        return view('login');
    }

    public function do_login()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->session = \Config\Services::session();
    
        $email = $this->request->getVar('user_email');
        $password = $this->request->getVar('user_password');
    
        // Validation rules
        $rules = [
            'user_email' => 'required|valid_email',
            'user_password' => 'required'
        ];
    
        // Validate fields
        if (!$this->validate($rules)) {
            $this->session->setFlashdata('login_error', 'Email and Password are required fields.');
            return redirect()->to('/login')->withInput();
        }
    
        // Verify account
        $user = $this->userModel->validateUser($email);
        if (empty($user)) {
            $this->session->setFlashdata('login_error', 'This account does not exist in our system.');
          //  echo $this->db->getLastQuery(); // Display the last executed query
//exit;
            return redirect()->to('/login')->withInput();
        }
    
        // Verify password
        if (!password_verify($password, $user->user_password)) {
            $this->session->setFlashdata('login_error', 'Invalid password. Please try again.');
            return redirect()->to('/login')->withInput();
        }
    
        // Set session data
        $sessiondata = [
            'user_fullname' => $user->user_fullname,
            'user_email' => $email,
            'loggedIn' => true,
            'user_id' => $user->user_id,
            'role_id' => $user->role_id,
            'district' => $user->district
        ];
        $this->session->set($sessiondata);
    
      //  print_r( $sessiondata);exit;
        // Redirect based on role
        if ($user->role_id == 1) {  // Admin
            return redirect()->to('/admin/dashboard');
        } else {  // Field Worker
            return redirect()->to('/field-worker/dashboard');
        }
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
