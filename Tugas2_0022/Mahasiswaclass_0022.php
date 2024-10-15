<?php
// Kelas Induk Mahasiswa
class Mahasiswa {
    public $nama;
    public $nim;

    // Constructor untuk inisialisasi nama dan nim
    public function __construct($nama, $nim) {
        $this->nama = $nama;
        $this->nim = $nim;
    }

    // Method untuk mencetak informasi dasar mahasiswa
    public function cetakInfo() {
        echo "Nama: " . $this->nama . "<br>";
        echo "NIM: " . $this->nim . "<br>";
    }
}

// Kelas MahasiswaKaryawan, turunan dari Mahasiswa
class MahasiswaKaryawan extends Mahasiswa {
    public $perusahaan;
    public $jamKerja;

    // Constructor dengan tambahan atribut perusahaan dan jam kerja
    public function __construct($nama, $nim, $perusahaan, $jamKerja) {
        parent::__construct($nama, $nim);
        $this->perusahaan = $perusahaan;
        $this->jamKerja = $jamKerja;
    }

    // Overriding method cetakInfo untuk menambahkan informasi kerja
    public function cetakInfo() {
        parent::cetakInfo();
        echo "Perusahaan: " . $this->perusahaan . "<br>";
        echo "Jam Kerja: " . $this->jamKerja . " jam/minggu<br>";
    }

    // Method untuk cek keseimbangan antara kuliah dan kerja
    public function cekKeseimbangan() {
        if ($this->jamKerja > 20) {
            echo "Mahasiswa ini mungkin kesulitan menyeimbangkan kuliah dan kerja.<br>";
        } else {
            echo "Mahasiswa ini mampu menyeimbangkan kuliah dan kerja dengan baik.<br>";
        }
    }
}

// Kelas MahasiswaAktif, turunan dari Mahasiswa
class MahasiswaAktif extends Mahasiswa {
    public $organisasi;
    public $jabatan;

    // Constructor dengan tambahan atribut organisasi dan jabatan
    public function __construct($nama, $nim, $organisasi, $jabatan) {
        parent::__construct($nama, $nim);
        $this->organisasi = $organisasi;
        $this->jabatan = $jabatan;
    }

    // Overriding method cetakInfo untuk menambahkan informasi organisasi
    public function cetakInfo() {
        parent::cetakInfo();
        echo "Organisasi: " . $this->organisasi . "<br>";
        echo "Jabatan: " . $this->jabatan . "<br>";
    }

    // Method untuk menunjukkan kepemimpinan mahasiswa
    public function cekKepemimpinan() {
        echo "Mahasiswa ini menjabat sebagai " . $this->jabatan . " di " . $this->organisasi . ".<br>";
    }
}

// Kelas MahasiswaOnline, turunan dari Mahasiswa
class MahasiswaOnline extends Mahasiswa {
    public $platform;
    public $jumlahKelas;

    // Constructor dengan tambahan atribut platform dan jumlah kelas
    public function __construct($nama, $nim, $platform, $jumlahKelas) {
        parent::__construct($nama, $nim);
        $this->platform = $platform;
        $this->jumlahKelas = $jumlahKelas;
    }

    // Method cetakInfo untuk menambahkan informasi platform online
    public function cetakInfo() {
        parent::cetakInfo();
        echo "Platform Online: " . $this->platform . "<br>";
        echo "Jumlah Kelas: " . $this->jumlahKelas . " kelas aktif<br>";
    }

    // Method untuk cek status aktif mahasiswa di platform online
    public function cekStatusAktif() {
        if ($this->jumlahKelas >= 5) {
            echo "Mahasiswa ini sangat aktif dalam platform online.<br>";
        } else {
            echo "Mahasiswa ini mengambil kelas online dalam jumlah wajar.<br>";
        }
    }
}

// Contoh penggunaan kelas

// Membuat objek MahasiswaKaryawan
echo "<h3>Mahasiswa Karyawan</h3>";
$mahasiswaKaryawan = new MahasiswaKaryawan("Rizky Pratama", "25.230.0022", "Tech Solutions", 22);
$mahasiswaKaryawan->cetakInfo();
$mahasiswaKaryawan->cekKeseimbangan();

echo "<br>";

// Membuat objek MahasiswaAktif
echo "<h3>Mahasiswa Aktif</h3>";
$mahasiswaAktif = new MahasiswaAktif("Dewi Lestari", "25.240.0022", "UKM Musik", "Ketua");
$mahasiswaAktif->cetakInfo();
$mahasiswaAktif->cekKepemimpinan();

echo "<br>";

// Membuat objek MahasiswaOnline
echo "<h3>Mahasiswa Online</h3>";
$mahasiswaOnline = new MahasiswaOnline("Aditya Suryo", "25.250.0022", "LinkedIn Learning", 7);
$mahasiswaOnline->cetakInfo();
$mahasiswaOnline->cekStatusAktif();
?>