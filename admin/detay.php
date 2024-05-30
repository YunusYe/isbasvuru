<?php
require("../inc/fonk.php"); //veri tabanı bağlantısı gerçekleştiriliyor

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Başvuru Detay</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-image: url('img/bg(4).jpg');
        }

    </style>
<body>
<form name="ogrenci" method="post" action=""> <!--Formumuzu oluşturuyoruz. -->
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-6">
                <h1>Başvuru Detay</h1>
            </div>

        </div>
        <div class="col-md-12">
            <a style="text-align: center;" class="btn btn-primary btn-block" href="index.php">Başvuru Formlarına Geri
                Dön</a>
            <div class="tab-content">
                <!-- Ad soyad bilgisini aldığımız tab-->
                <div role="tabpanel" class="tab-pane active">
                    <br/>
                    <?php
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];

                        $sorgu = $baglanti->query("select * from basvuru where id=$id");
                        $sonuc = $sorgu->fetch_assoc();
                    } else
                        header("location:index.php");
                    ?>

                    <div class="col-md-6">
                        <table class="table-condensed">
                            <tr>
                                <td>Adı ve Soyadı:</td>
                                <td><?php echo $sonuc['adSoyad'] ?></td>
                            </tr>
                            <tr>
                                <td>Doğum Yeri:</td>
                                <td><?php echo $sonuc['DogumYeri'] ?></td>
                            </tr>
                            <tr>
                                <td>Doğum Tarihi:</td>
                                <td><?php echo $sonuc['DogumTarihi'] ?></td>
                            </tr>
                            <tr>
                                <td>E-MAİL ADRESİ:</td>
                                <td><?php echo $sonuc['mail'] ?></td>
                            </tr>
                            <tr>
                                <td>Cep Telefonu:</td>
                                <td><?php echo $sonuc['CTelefon'] ?></td>
                            </tr>
                            <tr>
                                <td>Ev Telefonu:</td>
                                <td><?php echo $sonuc['ETelefon'] ?></td>
                            </tr>
                            <tr>
                                <td>Adres:</td>
                                <td><?php echo $sonuc['Adres'] ?></td>
                            </tr>
                            <tr>
                                <td>Doğum Yeri:</td>
                                <td><?php echo $sonuc['DogumYeri'] ?></td>
                            </tr>
                            <tr>
                                <td>Cinsiyet:</td>
                                <td><?php echo $sonuc['Cinsiyet'] ?></td>
                            </tr>
                            <tr>
                                <td>Medeni Hal:</td>
                                <td><?php echo $sonuc['MedeniHal'] ?></td>
                            </tr>
                            <tr>
                                <td>Ehliyet:</td>
                                <td><?php echo $sonuc['Ehliyet'] ?></td>
                            </tr>
                            <tr>
                                <td>Askerlik:</td>
                                <td><?php echo $sonuc['Askerlik'] ?></td>
                            </tr>
                            <tr>
                                <td>Başvuru Tarih ve Saat:</td>
                                <td style="color:red;"><?php echo $sonuc['BasvuruTarihi'] ?></td>
                            </tr>

                        </table>
                        <br>
                        <h4 style="text-align:center;">Eğitim Bilgileri</h4>
                        <table class="table table-responsive">

                            <thead>
                            <th>Okul Adı</th>
                            <th>Okul Mezun YILI</th>
                            </thead>
                            <tbody>
                            <?php
                            $sorgu = $baglanti->query("select d.okulAd, d.MezunYil from egitim d inner join basvuruegitim od on od.egitimid=d.id inner join basvuru o on o.id=od.basvuruid where o.id=$id");
                            $sayac = 0;
                            while ($sonuc = $sorgu->fetch_assoc()) {
                                $sayac++;
                                ?>
                                <tr>
                                    <td><?php echo $sonuc['okulAd'] ?></td>


                                    <td><?php echo $sonuc['MezunYil'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
</form>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>