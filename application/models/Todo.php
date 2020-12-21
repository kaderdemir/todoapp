<?php 

class Todo extends CI_Model
{
	
	public function insertProvider($data)
	{
		$this->db->empty_table('provider');
		return $this->db->insert_batch("provider",$data); 
	}

	public function getProviders() {
		$this->db->select("provider_name");
		$this->db->group_by("provider_name");
		return $this->db->get("provider")->result();
	}

	public function getProvidersData($data) {
		 
		if ($data != "false") { 
		 	$this->db->where("provider_name",$data);
		 } 
		return $this->db->get("provider")->result();
	}

	public function getDevelopers()
	{ 
		return $this->db->get("developers")->result();
	}

	public function getDeveloper($dev)
	{  
        $this->db->select("provider.provider_name, provider.title, provider.time");
        $this->db->join("developers","provider.difficulty = developers.difficulty","INNER");
        $this->db->where("provider.difficulty",$dev);
		return $this->db->get("provider")->result();
	}
}

?>