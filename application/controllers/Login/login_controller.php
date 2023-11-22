
<?php

class login_controller extends CI_Controller
{
    public function __construct(){
        // Appel du constructeur de la classe parente
        parent::__construct();

        // Si l'utilisateur n'est pas connecté, le redirige vers la page de connexion
        $this->session->userdata('admin_dashboard');
    }
 
    // Méthode de connexion
    public function login(){
        // Charge la vue de connexion
        $this->load->view('Template/login');
    }

    // Méthode de vérification des informations de connexion
    public function action(){
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Définition des délimiteurs d'erreur
        $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');

        // Si le formulaire est valide
        if ($this->form_validation->run() == TRUE) {
            // Charge le modèle de connexion
            $this->load->model('login_model');

            // Récupère l'email et le mot de passe saisis par l'utilisateur
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $where = array(
                'email' => $email,
                'password' => md5($password)
                );
            // Exécute la requête de connexion
            $q = $this->login_model->admin_login('personnel',$where);

            // Si la requête retourne 0 résultat
            if ($q->num_rows() == 0) {
                // L'utilisateur n'existe pas ou le mot de passe est incorrect
                $this->session->set_flashdata('error_message', 'Vérifiez votre email ou votre mot de passe puis réessayez.');
                return redirect('login');
            } elseif ($q->result() === FALSE) {
                // Une erreur s'est produite lors de la requête à la base de données
                $this->session->set_flashdata('error_message', 'Une erreur s\'est produite lors de la connexion. Veuillez réessayer plus tard.');
                return redirect('login');
            } else {
                // Récupère les données de l'administrateur
                foreach ($q->result() as $donner) {
                    $sess_data['email'] = $donner->email;
                    $sess_data['code_em'] = $donner->code_em;
                    $sess_data['noms'] = $donner->nom;
                    $sess_data['prenom'] = $donner->prenom;
                    $sess_data['role'] = $donner->role;
					$sess_data['position'] = "AezakmiHesoyamWhosyourdaddy"; 
                    $this->session->set_userdata($sess_data);
                }
                redirect('admin_dashboard');
            }
        }
        else
        {
            // Charge la vue de connexion
            $this->load->view('Template/login');
        }
    }

    // Méthode de déconnexion
    public function logout()
    {
        // Détruit la session
        $this->session->sess_destroy();
        // Redirige l'utilisateur vers la page de connexion
        return redirect('login');
    }
    

}