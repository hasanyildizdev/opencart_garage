<?php
namespace Opencart\Catalog\Model\Module;
use \Opencart\System\Helper as Helper;
class Garage extends \Opencart\System\Engine\Model {
    public function getBrand(int $vehicle_brand_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_brand` WHERE `vehicle_brand_id` = '" . (int)$vehicle_brand_id . "'");
        return $query->rows;
    }
    public function getBrands() : array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_brand`");
        return $query->rows;
    }

    public function getModel(int $vehicle_model_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_model` WHERE `vehicle_model_id` = '" . (int)$vehicle_model_id . "'");
        return $query->rows;
    }
    public function getModels() : array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_model`");
        return $query->rows;
    }

    public function getEngine(int $vehicle_engine_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_engine` WHERE `vehicle_engine_id` = '" . (int)$vehicle_engine_id . "'");
        return $query->rows;
    }
    public function getEngines(): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_engine`");
        return $query->rows;
    }

    public function getBody(int $vehicle_body_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_body` WHERE `vehicle_body_id` = '" . (int)$vehicle_body_id . "'");
        return $query->rows;
    }
    public function getBodies(): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_body`");
        return $query->rows;
    }

    public function getYear(int $vehicle_year_id): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_year` WHERE `vehicle_year_id` = '" . (int)$vehicle_year_id . "'");
        return $query->rows;
    }
    public function getYears(): array{
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "as_vehicle_year`");
        return $query->rows;
    }

    public function addGarage(int $customer_id, array $data): int {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "my_garage` SET `customer_id` = '" . (int)$customer_id . "', `garage_id` = '" . (string)$data['garage_id']. "', `vehicle_brand_id` = '" . (string)$data['vehicle_brand_id'] . "', `vehicle_model_id` = '" . (string)$data['vehicle_model_id'] . "', `vehicle_year_id` = '" . (string)$data['vehicle_year_id'] . "', `vehicle_engine_id` = '" . (string)$data['vehicle_engine_id'] . "', `vehicle_body_id` = '" . (string)$data['vehicle_body_id'] ."'" );
        $garage_id = $this->db->getLastId();
        return $garage_id;
    }

}