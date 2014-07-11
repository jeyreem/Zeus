<?php

class CarouselController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$carouselMapper = new Application_Model_CarouselMapper();
		$carousel = $carouselMapper->fetchAll();

		$this->view->assign('carousel', $carousel);
	}

	public function readAction()
	{
		$params = $this->getRequest()->getParams();

		$carouselMapper = new Application_Model_CarouselMapper();
		$carousel = $carouselMapper->find($params['id']);

		$this->view->assign("carousel", $carousel);
	}
	public function createAction()
	{
		//Form
		$form = new Application_Form_Carousel();
		$this->view->formCarousel = $form;

		if($this->getRequest()->isPost()){
			//Récupération des données
			$data = $this->getRequest()->getPost();
			//Validation des données par le Form
			if($form->isValid($data)){
				//Transfert des données dans un objet carousel
				$carousel = new Application_Model_Carousel();
				$carousel->setNoteCarousel($data['note_carousel'])
                                                ->setComCarousel($data['com_carousel']);
                                
				//Instance du Mapper
				$carouselMapper = new Application_Model_CarouselMapper();
				//Save des données
				$carouselMapper->save($carousel);
				//Réponse à la vue
				$this->view->success = 'Enregistrement effectué';
			}
		}
	}
}