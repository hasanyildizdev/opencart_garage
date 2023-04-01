<?php
namespace Opencart\Catalog\Controller\Module;
use \Opencart\System\Helper as Helper;
class Garage extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$this->load->language('module/garage');

/*         if (!$this->customer->isLogged() || (!isset($this->request->get['customer_token']) || !isset($this->session->data['customer_token']) || ($this->request->get['customer_token'] != $this->session->data['customer_token']))) {
			$this->session->data['redirect'] = $this->url->link('account/order', 'language=' . $this->config->get('config_language'));

			$this->response->redirect($this->url->link('account/login', 'language=' . $this->config->get('config_language')));
		} */

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('module/garage');

        //$brand = $this->model_module_garage->getBrand(1);
        //$model = $this->model_module_garage->getModel(1);
        //$engine = $this->model_module_garage->getEngine(1);
        //$body = $this->model_module_garage->getBody(1);
        //$year = $this->model_module_garage->getYear(1);

        $brands = $this->model_module_garage->getBrands();
        $models = $this->model_module_garage->getModels();
        $engines = $this->model_module_garage->getEngines();
        $bodies = $this->model_module_garage->getBodies();
        $years = $this->model_module_garage->getYears();

        $data = array();
        $data['Brands'] = array();
        $data['Models'] = array();
        $data['Engines'] = array();
        $data['Bodies'] = array();
        $data['Years'] = array();

        foreach($brands as $key => $brand){
            array_push($data['Brands'],$brands[$key]["brand"]);
        }
        foreach($models as $key => $model){
            array_push($data['Models'],$models[$key]["model"]);
        }
        foreach($engines as $key => $engine){
            array_push($data['Engines'],$engines[$key]["engine"]);
        }
        foreach($bodies as $key => $body){
            array_push($data['Bodies'],$bodies[$key]["body"]);
        }
        foreach($years as $key => $year){
            array_push($data['Years'],$years[$key]["start"]."-".$years[$key]["end"]);
        }
        
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer_futures'] = $this->load->controller('common/footer_futures');
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$data['save'] = $this->url->link('module/garage|save', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token']);
        $data['back'] = $this->url->link('module/my_garage', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token']);

        $this->response->setOutput($this->load->view('module/garage', $data));
    }

	public function save(): void {
		$this->load->language('module/garage');
        
        $json = [];

		if (!$this->customer->isLogged() || (!isset($this->request->get['customer_token']) || !isset($this->session->data['customer_token']) || ($this->request->get['customer_token'] != $this->session->data['customer_token']))) {
			$this->session->data['redirect'] = $this->url->link('account/address', 'language=' . $this->config->get('config_language'));

			$this->response->redirect($this->url->link('account/login', 'language=' . $this->config->get('config_language')));
		}
/* 
		if (isset($this->request->get['garage_id'])) {
			$this->load->model('module/garage');

			$garage_info = $this->model_moduel_garage->getGarage($this->request->get['garage_id']);
		}

        if (!empty($garage_info)) {
			$data['firstname'] = $address_info['firstname'];
		} else {
			$data['firstname'] = '';
		} */


        if (!$json) {
			$keys = [
				'customer_id',
				'garage_id',
                'vehicle_brand_id',
                'vehicle_model_id',
                'vehicle_engine_id',
                'vehicle_body_id',
                'vehicle_year_id',
			];

			foreach ($keys as $key) {
				if (!isset($this->request->post[$key])) {
					$this->request->post[$key] = '';
				}
			}
		}

        // Add Garage
        if (!$json) {
            $this->load->model('module/garage');

            if (!isset($this->request->get['garage_id'])) {
                $this->model_module_garage->addGarage($this->customer->getId(), $this->request->post);
            }
            else {
                $this->model_module_garage->editGarage($this->request->post['garage_id'], $this->request->post);
                $json['success'] = $this->language->get('text_successa');
            }
            $json['redirect'] = $this->url->link('module/my_garage', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token'], true);
        }
        
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}