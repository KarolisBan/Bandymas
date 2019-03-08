<?php

	class Users{ /* klase */
		public $User = array(
			"vienas@vienas.com" => '$2y$10$yRObQdAPyCyV0FA/zoZbneyf57A0a4OioryiiV0HPM8EYhtYaIEVi', 	// vienas1
			"du@du.com" => '$2y$10$00cFCAkvr.jQKbCyg0fUVeZqthBNLDx/gj34Qua1wcTG9smwHrNTu', 			// du2
			"trys@trys.com" => '$2y$10$sDrr8iX/OHxNfzabV/sKhekFeaL2ZHnYPbjeMi1b2LGEQdM43jjF.', 		// trys3
			"keturi@keturi.com" => '$2y$10$upk/pkDn35GpbVjeWJ4V.uAaHD5GjrT/s8KfWbYRFsET5dvKXpcJW', 	// keturi4
			"penki@penki.com" => '$2y$10$ddkAypS9Amzqetgx2voTROoaI0HCMeBs874U7nyAP60nPlLRUUNQC'  	// penki5
		); /* duomenu masyvas tiesiog */
		
		public function get_user_pass($index){ /* is masyvo paima passworda hashinta (indekstas - emailas) */
			if(isset($this->User[$index])) { /* tikrina ar masyve yra tokia reiksme */
				return $this->User[$index]; /* grazina passworda */
			}
			else {
				return false; /* nieko */
			}
		}
	}
	
	$Users = new Users; /* viskas */

?>