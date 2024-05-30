<?php
if ($_GET["id"]) {
    require("../inc/fonk.php"); //veri tabanı bağlantısını sağlıyoruz

    //Get ile gelen id integer türüne pars edip değişkende tutuyoruz
    $ogrid = (int)$_GET["id"];

    //basvuruegitim veri tabanından ogrenci bilgilerini siliyoruz
    $baglanti->query("DELETE FROM basvuruegitim WHERE  basvuruid=$ogrid");

    //egitim veri tabanından basvuruya ait egitim bilgilerini siliyoruz
    // burada egitim veri tabanında ogrenci bilgisi eşleşmeyenleri siliyoruz
    $baglanti->query("DELETE d FROM egitim d WHERE NOT EXISTS (SELECT * FROM basvuruegitim WHERE egitimid = d.id)");

    //Son olarak basvuru tablosundan ogrenci bilgisini siliyoruz
    $baglanti->query("DELETE FROM basvuru WHERE  id=$ogrid");

    //index sayfamıza geri dönüyoruz.
    header("location:index.php");
}
//Eğer get ile veri gelmemişse index sayfasına dönüyoruz
header("location:index.php");