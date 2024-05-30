<?php
$baglanti = new mysqli('localhost', 'root', 'mehmet3458', 'basvuruformu');
if (mysqli_connect_error()) //Eğer hata varsa yazdırıyoruz
{
    echo mysqli_connect_error();
    exit; //eğer bağlantıda hata varsa PHP çalışmasını sonlandırıyoruz.
}
$baglanti->set_charset("utf8");
?>