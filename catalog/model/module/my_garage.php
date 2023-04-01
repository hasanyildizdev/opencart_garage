<?php
namespace Opencart\Catalog\Model\Module;
use \Opencart\System\Helper as Helper;
class MyGarage extends \Opencart\System\Engine\Model {

    public function getGarage(int $garage_id) : array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "my_garage` WHERE `garage_id` = '" . (int)$garage_id . "'");
        return $query->rows;
    }

    public function getGarages(int $customer_id) : array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "my_garage` WHERE `customer_id` = '" . (int)$customer_id . "'");
        return $query->rows;
    }

    public function deleteGarage(int $garage_id) {
        $query = $this->db->query("DELETE FROM `" . DB_PREFIX . "my_garage` WHERE `garage_id` = '" . (int)$garage_id . "'");
    }

    public function getBrand(int $vehicle_brand_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_brand` WHERE `vehicle_brand_id` = '" . (int)$vehicle_brand_id . "'");
        return $query->row;
    }

    public function getModel(int $vehicle_model_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_model` WHERE `vehicle_model_id` = '" . (int)$vehicle_model_id . "'");
        return $query->rows;
    }

    public function getEngine(int $vehicle_engine_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_engine` WHERE `vehicle_engine_id` = '" . (int)$vehicle_engine_id . "'");
        return $query->rows;
    }

    public function getBody(int $vehicle_body_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_body` WHERE `vehicle_body_id` = '" . (int)$vehicle_body_id . "'");
        return $query->rows;
    }

    public function getYear(int $vehicle_year_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_year` WHERE `vehicle_year_id` = '" . (int)$vehicle_year_id . "'");
        return $query->rows;
    }
}