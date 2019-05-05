<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controle extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function addMoovie()
	{
		$page="ajoutFilm";
		$idmax = $this->accessbase->getIdMaxFilm();
		$listgenre = $this->accessbase->getGenreFilm();
		$listsalle = $this->accessbase->getSalle();
		$idsuivant = 1 + $idmax[0]['idmax'];
		// $listMetier = $this->accessbase->getListMetier();
		$rep = array('page'=>$page,'idsuivant'=>$idsuivant,'listgenre' => $listgenre,'listsalle'=>$listsalle);
		$this->load->view('index',$rep);
	}

	public function manageMoovie()
	{
		$page="metier";
		$listMetier = $this->accessbase->getListMetier();
		$rep = array('page'=>$page,'listMetier'=>$listMetier);
		$this->load->view('index',$rep);
	}

	public function ajouterFilm()
	{
		$titre=$this->input->get('titre');
		$idgenre=$this->input->get('idgenre');
		$acteur=$this->input->get('acteur');
		$duree=$this->input->get('duree');
		// $imageprincipale=$this->input->get('');
		// $imagesecondaire=$this->input->get('');
		$sortie=$this->input->get('sortie');
		$description=$this->input->get('description');
		$datediffusion=$this->input->get('datediffusion');
		$heurediffusion=$this->input->get('heurediffusion');
		$idsalle=$this->input->get('salle');
		$idfilm=$this->input->get('idfilm');

		$img=$this->input->get('image1');

		// echo($datediffusion);

		$this->accessbase->insertFilm($titre,$idgenre,$acteur,$duree,$sortie,$description);
		$this->accessbase->insertProgramme($datediffusion,$idfilm,$heurediffusion,$idsalle);
		$idmax = $this->accessbase->getIdMaxFilm();
		redirect('Controle/pageAjoutImage/'.$idmax[0]['idmax']);
		// echo('debut');
		// $config['upload_path']='./uploads';
		// //$config['allowed_types']='jpg|png';
		// $this->load->library('upload',$config);
		// if(!$this->upload->do_upload('image1'))
		// {
		// 	echo('erreur');
		// 	$error = array('error'=>$this->upload->display_errors());
		// 	var_dump($error);
		// }
		// else{
		// 	echo('succes');
		// 	$data=array('upload_data'=>$this->upload->data());
		// }
		// echo('fin');
	}

	public function pageAjoutImage($idfilm)
	{
		$page="pageAjoutImage";
		// $listMetier = $this->accessbase->getListMetier();
		$rep = array('page'=>$page,'idfilm'=>$idfilm);
		$this->load->view('index',$rep);	
	}

	public function test()
	{
		
		$config['upload_path']='./uploads';
		$config['allowed_types']='jpg|png|jpeg';
		$config['max_width']='5000';
		$config['max_height']='5000';
		$this->load->library('upload',$config);
		
		if(!$this->upload->do_upload('monimage'))
		{
			echo('erreur');
			$error = array('error'=>$this->upload->display_errors());
			var_dump($error);
		}
		else{
			echo('succes');
			$data=array('upload_data'=>$this->upload->data());
		}
		$nomfichier=$this->upload->data('file_name');
	}

	public function upload1($idmax)
	{
		
		$config['upload_path']='./uploads';
		$config['allowed_types']='jpg|png|jpeg';
		$config['max_width']='5000';
		$config['max_height']='5000';
		$this->load->library('upload',$config);
		
		if(!$this->upload->do_upload('image1'))
		{
			echo('erreur');
			$error = array('error'=>$this->upload->display_errors());
			var_dump($error);
		}
		else{
			echo('succes');
			$data=array('upload_data'=>$this->upload->data());
		}
		$nomfichier=$this->upload->data('file_name');
		$this->accessbase->updateImage($idmax,$nomfichier);

	}

	public function gestionfilm()
	{
		$page = "gestionfilm";
		$listfilm = $this->accessbase->getListeFilm();
		$rep = array('page'=>$page,'listfilm'=>$listfilm);
		$this->load->view('index',$rep);	
	}

	public function modifierfilm($idfilm)
	{
		$page = "modificationfilm";
		$film = $this->accessbase->getFilmById($idfilm);
		$rep = array('page'=>$page,'film'=>$film);
		$this->load->view('index',$rep);
	}

	public function updateFilm($idfilm)
	{
		$titre=$this->input->get('titre');
		$acteur=$this->input->get('acteur');
		$duree=$this->input->get('duree');
		$sortie=$this->input->get('sortie');
		$description=$this->input->get('description');
		$this->accessbase->updateFilm($idfilm,$titre,$acteur,$duree,$sortie,$description);
		redirect('Controle/modifierfilm/'.$idfilm);
	}


	


	// public function listeMetier()
	// {
	// 	$page="metier";
	// 	$listMetier = $this->accessbase->getListMetier();
	// 	$rep = array('page'=>$page,'listMetier'=>$listMetier);
	// 	$this->load->view('index',$rep);
	// }

	// public function getModification($idmetier)
	// {
	// 	$page="modificationMetier";
	// 	$metier = $this->accessbase->getMetierById($idmetier);
	// 	$rep = array('page'=>$page,'metier'=>$metier);
	// 	$this->load->view('index',$rep);
	// }

	// public function updateMetier($idmetier)
	// {
	// 	$nommetier = $this->input->get('nommetier');
	// 	$description = $this->input->get('description');
	// 	$h3 = $this->input->get('h3');
	// 	$contenuh3 = $this->input->get('contenuh3');
	// 	$h4 = $this->input->get('h4');
	// 	$contenuh4 = $this->input->get('contenuh4');
	// 	$h5 = $this->input->get('h5');
	// 	$contenuh5 = $this->input->get('contenuh5');
	// 	$this->accessbase->updateMetier($idmetier,$nommetier,$description,$h3,$contenuh3,$h4,$contenuh4,$h5,$contenuh5);
	// 	redirect('Controle/getModification/'.$idmetier);
	// }
	
	// public function getFormulaireAjoutMetier()
	// {
	// 	$page="ajoutMetier";
	// 	// $metier = $this->accessbase->getMetierById($idmetier);
	// 	$rep = array('page'=>$page);
	// 	$this->load->view('index',$rep);
	// }

}