<?php
namespace Opencart\Catalog\Controller\Common;
class FooterFutures extends \Opencart\System\Engine\Controller {
	public function index(): string {
		$this->load->language('common/footer_futures');
		return $this->load->view('common/footer_futures');
	}
}
