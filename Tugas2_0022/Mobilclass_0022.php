<?php
// Definisi kelas induk Mobil
class Mobil {
    public $nama;
    public $merk;

    // Constructor untuk inisialisasi
    public function __construct($nama, $merk) {
        $this->nama = $nama;
        $this->merk = $merk;
    }

    // Method untuk mencetak informasi mobil
    public function cetakInfo() {
        echo "Nama: " . $this->nama . "</br>";
        echo "Merk: " . $this->merk . "</br>";
    }
}

// Definisi kelas turunan MobilSport dari Mobil
class MobilSport extends Mobil {
    public $speed;

    // Constructor untuk inisialisasi dengan atribut tambahan speed
    public function __construct($nama, $merk, $speed) {
        parent::__construct($nama, $merk);
        $this->speed = $speed;
    }

    // Method tambahan khusus MobilSport
    public function turbo() {
        echo "Turbo mode diaktifkan! Kecepatan meningkat hingga " . $this->speed . " km/h. </br>";
    }
}

// Definisi kelas turunan CityCar dari Mobil
class CityCar extends Mobil {
    public $model;

    // Constructor untuk inisialisasi dengan atribut tambahan model
    public function __construct($nama, $merk, $model) {
        parent::__construct($nama, $merk);
        $this->model = $model;
    }

    // Method tambahan khusus CityCar
    public function irit() {
        echo "CityCar ini sangat irit bahan bakar. </br>";
    }

    // Method tambahan untuk sensor
    public function sensor() {
        echo "Sensor parkir diaktifkan. </br>";
    }
}

// Contoh penggunaan kelas
// Membuat objek MobilSport
$mobilSport = new MobilSport("Lamborghini Aventador", "Lamborghini", 350);
$mobilSport->cetakInfo();
$mobilSport->turbo();

echo "</br>";

// Membuat objek CityCar
$cityCar = new CityCar("Yaris", "Toyota", "2024");
$cityCar->cetakInfo();
$cityCar->irit();
$cityCar->sensor();

?>
