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
?>
<?php

$datas = array(
  new Pegawai_Fulltime('Lalu', '12 November 2000', 'Laki-laki', 'Senior'),
  new Pegawai_Parttime('Hendro', '3 Mei 2000', 'Laki-laki', 'Junior'),
  new Pegawai_Fulltime('Cahyati', '14 Januari 2001', 'Perempuan', 'Amateur'),
  new Pegawai_Parttime('sinta', '12 Desember 1999', 'Perempuan', 'Senior'),
)
?>

<!DOCTYPE html>
<html lang="en"
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tugas Praktikum 4</title>
  </head>

  <body>
    <h1>DATA PEGAWAI PAK JOY</h1>
    <div style="width: 10%">
      <select id="filter">
        <option value="">Semua Pegawai</option>
        <option value="Fulltime">Fulltime</option>
        <option value="Parttime">Parttime</option>
      </select>
    </div>
    <table id="table_karyawan">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Tempat Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Level karyawan</th>
          <th>Status</th>
          <th>Gaji Karyawan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datas as $index => $data) { ?>
          <tr class="<?= $data->Status ?>">
            <td><?= $index + 1 ?></td>
            <td><?= $data->Nama ?></td>
            <td><?= $data->TTL ?></td>
            <td><?= $data->Jenis_kelamin ?></td>
            <td><?= $data->Level_karyawan ?></td>
            <td><?= $data->Status ?></td>
            <td><?= $data->con_Gaji() ?></td>
          </tr>
          
        <?php } ?>
      </tbody>
    </table>
    <script>
      const rating = document.getElementById("filter");
      const elements = document.querySelectorAll("tbody>tr");
      rating.addEventListener("change", function() {
        let value = rating.value;
        if (!value) {
          elements.forEach((element) => {
            let elementClass = element.className.slice(0, 8);
            element.className = elementClass;
          })
        }else if (value == "Parttime") {
          elements.forEach((element) => {
            let elementClass = element.className.slice(0, 8);
            element.className = (elementClass == "Parttime") ? "Parttime" : "Fulltime Hidden";
          })
        }
         else if (value == "Fulltime") {
          elements.forEach((element) => {
            let elementClass = element.className.slice(0, 8);
            element.className = (elementClass == "Fulltime") ? "Fulltime" : "Parttime Hidden";
          })
        } 
        
        let index = 1
        elements.forEach(element => {
          if(!element.className.includes("Hidden")){
            element.querySelectorAll('td')[0].innerHTML = `${index}`;
            index++;
          }
        })
      })
    </script>
  </body>
</html>