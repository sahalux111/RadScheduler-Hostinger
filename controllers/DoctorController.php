<?php
include_once '../config/db.php';
include_once '../models/Availability.php';

class DoctorController {
    public function getAvailability($doctor_id) {
        return Availability::getByUserId($doctor_id);
    }
}
?>
