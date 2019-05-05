<?php 
		if( !defined('BASEPATH')) exit('No direct script access allowed');
	
		class accessbase extends CI_Model{
		
			public function __construct(){
				parent::__construct();
				$this->load->database();
			}
		
			public function getListMetier()
			{
				$sql = "select * from profession";
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}

			public function getMetierById($idmetier)
			{
				$sql = "select * from profession where IDPROFESSION = ".$idmetier;
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}

			public function updateMetier($idmetier,$nommetier,$description,$h3,$contenuh3,$h4,$contenuh4,$h5,$contenuh5)
			{
				$sql = "update PROFESSION set NOMPROFESSION='".$nommetier."',DESCPROFESSION=\"".$description."\",TITREH3=\"".$h3."\",CONTENUH3=\"".$contenuh3."\",TITREH4=\"".$h4."\",CONTENUH4=\"".$contenuh4."\",TITREH5=\"".$h5."\",CONTENUH5=\"".$contenuh5."\" where IDPROFESSION='".$idmetier."'";
				$result = $this->db->query($sql);
				$this->db->close();
			}

			public function ajouterMetier($idmetier,$nommetier,$description,$h3,$contenuh3,$h4,$contenuh4,$h5,$contenuh5)
			{
				$sql = "insert into  PROFESSION(NOMPROFESSION,DESCPROFESSION,IMAGEPROFESSION,TITREH3,CONTENUH3,TITREH4,CONTENUH4,TITREH5,CONTENUH5,IDCATEGORIE) values( NOMPROFESSION='".$nommetier."',DESCPROFESSION=\"".$description."\",IMAGEPROFESSION=,TITREH3=\"".$h3."\",CONTENUH3=\"".$contenuh3."\",TITREH4=\"".$h4."\",CONTENUH4=\"".$contenuh4."\",TITREH5=\"".$h5."\",CONTENUH5=\"".$contenuh5."\" where IDPROFESSION='".$idmetier."'";
				$result = $this->db->query($sql);
				$this->db->close();
			}

			public function getIdMaxFilm()
			{
				$sql = "select max(IDFILM) as idmax from FILM";
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}

			public function getGenreFilm()
			{
				$sql = "select * from GENREFILM";
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}

			public function getSalle()
			{
				$sql = "select * from SALLE";
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}

			public function insertFilm($titre,$idgenre,$acteur,$duree,$sortie,$description)
			{
				$sql = "insert into FILM(TITREFILM,IDGENRE,ACTEUR,DUREE,IMAGEFILM,IMAGEFILM2,DATESORTIE,DESCRIPTIONFILM) values ('".$titre."',".$idgenre.",'".$acteur."',".$duree.",'image1','image2','".$sortie."',\"".$description."\")";
				$result = $this->db->query($sql);
				$this->db->close();
			}

			public function insertProgramme($date,$idfilm,$heure,$idsalle)
			{
				$sql = "insert into PROGRAMME(DATEFILM,HEUREDATE,MINUTEDATE,ESTFINI,IDSALLE,IDFILM) values ('".$date."',".$heure.",0,0,".$idsalle.",".$idfilm.")";
				$result = $this->db->query($sql);
				$this->db->close();
			}

			public function updateImage($idfilm,$nomimage)
			{
				$sql = "update film set IMAGEFILM='".$nomimage."' where IDFILM=".$idfilm."";
				$result = $this->db->query($sql);
				$this->db->close();
			}
			
			public function getListeFilm()
			{
				$sql = "select IDFILM,TITREFILM,GENRE,ACTEUR,DUREE from FILM f join GENREFILM g on f.IDGENRE=g.IDGENRE";
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}

			public function getFilmById($idfilm)
			{
				$sql = "select IDFILM,TITREFILM,GENRE,ACTEUR,DUREE,DATESORTIE,DESCRIPTIONFILM from FILM f join GENREFILM g on f.IDGENRE=g.IDGENRE where f.IDFILM=".$idfilm."";
				$result = $this->db->query($sql);
				$retour = $result->result_array();
				$this->db->close();
				return $retour;
			}
			
			public function updateFilm($idfilm,$titre,$acteur,$duree,$sortie,$description)
			{
				$sql = "update film set TITREFILM='".$titre."',ACTEUR='".$acteur."',DUREE=".$duree.",DATESORTIE=".$sortie.",DESCRIPTIONFILM=\"".$description."\" where IDFILM=".$idfilm."";
				$result = $this->db->query($sql);
				$this->db->close();
			}

			
	}