<?php
namespace Opencart\Catalog\Controller\Module;
use \Opencart\System\Helper as Helper;
class MyGarage extends \Opencart\System\Engine\Controller {
    public function index(): void {
		$this->load->language('module/my_garage');
        $this->load->model('module/my_garage');

        $this->document->setTitle($this->language->get('meta-title'));
        
        if ($this->customer->isLogged()) {
            $showSignInButton = false;
		} else {
            $showSignInButton = true;
	    } 

        $data = array();
        $brands =  array();
        $models =  array();
        $engines =  array();
        $bodies =  array();
        $yearsStart =  array();
        $yearsEnd =  array();
        $data['garages'] = array();
        $garages = $this->model_module_my_garage->getGarages($this->customer->getId());
        $data["garage_count"] = count($garages);
        //  $garages = $this->model_module_my_garage->getGarage(1);

        if( count($garages) > 0 ) {
            $dontShowNoVehicle = true;
            foreach($garages as $key => $garage){
                array_push($data['garages'],$garages[$key]);
            } 
        }
        else {
            $dontShowNoVehicle = false;
        } 

        foreach ($garages as $key => $garage) {
            $vehicle_brand_id = (int) $garages[$key]["vehicle_brand_id"];
            $vehicle_model_id = (int) $garages[$key]["vehicle_model_id"];  
            $vehicle_engine_id = (int) $garages[$key]["vehicle_engine_id"];
            $vehicle_body_id = (int) $garages[$key]["vehicle_body_id"];
            $vehicle_year_id = (int) $garages[$key]["vehicle_year_id"];

            $brand =  $this->model_module_my_garage->getBrand($vehicle_brand_id);
            $model =  $this->model_module_my_garage->getModel($vehicle_model_id);
            $engine =  $this->model_module_my_garage->getEngine($vehicle_engine_id);
            $body =  $this->model_module_my_garage->getBody($vehicle_body_id);
            $year =  $this->model_module_my_garage->getYear($vehicle_year_id);
            
            array_push($brands,$brand["brand"]);
            array_push($models,$model[0]['model']);
            array_push($engines,$engine[0]["engine"]);
            array_push($bodies,$body[0]["body"]);
            array_push($yearsStart,$year[0]["start"]);
            array_push($yearsEnd,$year[0]["end"]);
        }

        $data['brands'] = $brands;
        $data['models'] = $models;
        $data['engines'] = $engines;
        $data['bodies'] = $bodies;
        $data['yearsStart'] = $yearsStart;
        $data['yearsEnd'] = $yearsEnd;

        $data['dontShowNoVehicle'] = $dontShowNoVehicle;
        $data['showSignInButton'] = $showSignInButton;
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer_futures'] = $this->load->controller('common/footer_futures');
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        if ($this->customer->isLogged()) {
            $data['garage'] = $this->url->link('module/garage', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token']);
        } else {
            $data['garage'] = $this->url->link('module/garage');
        }

        //$data['deleteGarage'] = $this->model_module_my_garage->deleteGarage();
        
        $this->response->setOutput($this->load->view('module/my_garage', $data ));
    }
}