<?php
class Entities_model extends CI_Model {
        
	public function get_entities($username = FALSE) {
	    if ($username === FALSE) {
	    
	    	$query = $this->db->get('entities');
		    return $query->result_array();
		}
		$query = $this->db->get_where('entities', array('username' => $username));
		return $query->row_array();
	}
		
		
		//TODO penser à refactor :est-ce qu'il faut renvoyer l'entité ou bien boolean
		//sinon renommer la func
	public function login($email, $password) {
		$query = $this->db->get_where('entities', 
			array(
				'email' 	=> $email,
				'password' 	=> $password
			)
		);
			//print_r($query->row_array());
		return $query->row_array();	
	}
	
	
	//TODO penser au cas où deux utilisateur choisissent 
	//le même username puisqu'il est dispo lors du formulaire
	// mais qu'après avoir validé avec le password la création, un seul pourra avoir ce username.
	
	//TODO penser à voir s'il faut vérifier que toutes les données sont présente ou pas
	public function new_user($user_data){
		return $this->db->insert('entities', $user_data);
	}
	
}

