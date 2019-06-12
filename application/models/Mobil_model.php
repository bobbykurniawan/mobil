<?php 

class Mobil_model extends CI_model
{
	public function getMobil($id = null){
		if ($id === null) {
			return $this->db->get('barang')->result_array();
		}else{
			return $this->db->get_where('barang', ['id' => $id])->result_array();
		}
	}

	public function deleteMobil($id){
		$this->db->delete('barang', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function createMobil($data){
		$this->db->insert('barang', $data);
		return $this->db->affected_rows();
	}

	public function updateMobil($data, $id){
		$this->db->update('barang', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}