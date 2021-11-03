<?php

abstract class Pegawai{
  public $Nama;
  public $TTL;
  public $Jenis_kelamin;
  public $Level_karyawan;
  public $Status;
  public $Gaji;
  public $list_gaji_kotor = array("Junior" => 2000000,"Amateur" => 3500000,"Senior" => 5000000);
  abstract public function __construct($Nama, $TTL, $Jenis_kelamin, $Level_karyawan);
  abstract protected function con_Gaji();
}

class Pegawai_Fulltime extends Pegawai
{
  public function __construct($Nama, $TTL, $Jenis_kelamin, $Level_karyawan){
    $this->Nama = $Nama;
    $this->TTL = $TTL;
    $this->Jenis_kelamin = $Jenis_kelamin;
    $this->Level_karyawan = $Level_karyawan;
    $this->Status = "Fulltime";
  }

  public function con_Gaji(){
    return $this->list_gaji_kotor[$this->Level_karyawan];
  }
}

class Pegawai_Parttime extends Pegawai{
  public function __construct($Nama, $TTL, $Jenis_kelamin, $Level_karyawan){
    $this->Nama = $Nama;
    $this->TTL = $TTL;
    $this->Jenis_kelamin = $Jenis_kelamin;
    $this->Level_karyawan = $Level_karyawan;
    $this->Status = "Parttime";
  }

  public function con_Gaji(){
    return $this->list_gaji_kotor[$this->Level_karyawan] / 2;
  }
}