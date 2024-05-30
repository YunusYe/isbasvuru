<?php
require("inc/fonk.php"); //veri tabanı bağlantısı gerçekleştiriliyor


if (isset($_POST['kaydet'])) {

    //Başvuran Kişinin adi ve soyadı bilgileri veritabaına yazılıyor
    $sonuc = $baglanti->query(sprintf("INSERT INTO basvuru (adSoyad,DogumYeri,DogumTarihi,mail,CTelefon,ETelefon,Adres,Cinsiyet,MedeniHal,Ehliyet,Askerlik) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", ($_POST['adSoyad']), ($_POST['dyeri']), ($_POST['dyili']), ($_POST['mail']), ($_POST['cnumara']), ($_POST['enumara']), ($_POST['adres']), ($_POST['cins']), ($_POST['medeni']), ($_POST['ehliyet']), ($_POST['askerlik'])));

    //Eğitim alanı için gerekli alanlar doldurulduysa kontrol ediyoruz
    if ($_POST['okul_adi']) {

        //en son eklenen id alıyoruz
        $eklenen_kisi_adi = $baglanti->insert_id;

        //alanlar metin kutuları kadar döngü oluşturuyoruz.
        foreach ($_POST['okul_adi'] as $key => $value) {

            //Eğitim bilgilerini döngü içinde sırayla kaydediyoruz.
            $baglanti->query(sprintf("INSERT INTO egitim (okulAd, MezunYil) VALUES ('%s','%s')", $value, $_POST['mezun_yili'][$key]));
            $eklenen_egitim_id = $baglanti->insert_id;

            //basvuruegitim tablomuzda basvuru egitim ilişki bilgilerini tutuyoruz

            $baglanti->query(sprintf("INSERT INTO basvuruegitim (basvuruid, egitimid) VALUES ('%s','%s')",
                ($eklenen_kisi_adi), ($eklenen_egitim_id)));
        }
    }

    $baglanti->close(); //bağlantımızı sonlandırıyoruz
    header("location:index.php"); // index.php sayfasına geri dönüyoruz.
}
?>

<?php

/*Formda kullandığımız her eleman için bir değişken oluşturup varsayılan değerleri ekliyoruz.*/
$adSoyad = "";
$mail = "";
$cnumara = "";
$enumara = "";
$adres = "";
$cins = "Kadın";
$medeni = "Bekar"; //Cinsiyet kısmı için varsayılan değeri Kadın atadım
$ehliyet = "YOK";
$askerlik = "Yapılmadı";
$dyili = 0;


?>
<!DOCTYPE html>
<html>
<head>


    <script src="js/TelefonMaske.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <style>
        body {
            background-image: url('img/bg(7).jpg');
        }


    </style>


</head>
<body>


<div class="container">

    <form name="egitim" method="post" action="">

        <table class="table table-responsive">
            <tr>
                <td colspan="2">
                    <h2 style="background-color: powderblue">İŞ BAŞVURU FORMU</h2>
                <td>
            <tr>

                <td>Adınız ve Soyadınız</td>
                <td>
                    <input type="text" name="adSoyad" class="form-control" placeholder="Adınız ve Soyadınız" required/>
                </td>
            </tr>
            <tr>
                <td>Doğum Yeri Ve Tarihi</td>
                <td>
                    <input type="text" name="dyeri" class="form-control" placeholder="Doğum Yerinizi Giriniz" required/>
                </td>

                <td>
                    <select name="dyili" class="form-control" required>
                        <option value="0">YIL</option>
                        <?php
                        /*
                        Doğum yılı içinde bir döngü yardımı ile liste elemanlarını (option)
                        ekliyoruz. Eğer bir değer seçilmiş ise bunu if yardımı ile kontrol edip
                        selected kodunu ekliyoruz ki o değer seçili gelsin.
                        */
                        $j = date("Y");//yılı verir
                        while ($j > 1920) {
                            if ($j == $dyili)
                                echo "<option value='$j' selected>$j</option>";
                            else
                                echo "<option value='$j'>$j</option>";
                            $j--;
                        }

                        ?>
                    </select>

                </td>
            </tr>

            <tr>
                <td>Mail Adresiniz</td>
                <td>
                    <input type="email" name="mail" placeholder="aaa@gmail.com" class="form-control" required/>
                </td>

            </tr>
            <tr>
                <td>Cep Telefon Numarası</td>
                <td>
                    <input type="text" name="cnumara" placeholder="(5##)#######"
                           onkeyup="javascript:backspacerUP(this,event);" class="form-control" required/>
                </td>

            </tr>
            <tr>
                <td>Ev Telefon Numarası</td>
                <td>
                    <input type="text" name="enumara" placeholder="(212)#######"
                           onkeyup="javascript:backspacerUP(this,event);" class="form-control"/>
                </td>

            </tr>
            <tr>
                <td>Adres</td>
                <td>
                    <textarea class="form-control" name="adres" placeholder="Mahalle , Sokak / Cadde , NO , İL , İLÇE"
                              id="adres" rows="3" required></textarea>

                </td>

            </tr>

            <tr>
                <td>Cinsiyetiniz</td>
                <td>
                    <label><input type="radio" name="cins"
                                  value="Kadın" <?php echo $cins == "Kadın" ? "checked" : "" ?>>
                        Kadın </label>
                    <label><input type="radio" name="cins"
                                  value="Erkek" <?php echo $cins == "Erkek" ? "checked" : "" ?>>
                        Erkek </label>
                </td>
            </tr>
            <tr>
                <td>Medeni Haliniz</td>
                <td>
                    <label><input type="radio" name="medeni"
                                  value="Bekar" <?php echo $medeni == "Bekar" ? "checked" : "" ?>>
                        Bekar </label>
                    <label><input type="radio" name="medeni"
                                  value="Evli" <?php echo $medeni == "Evli" ? "checked" : "" ?>>
                        Evli </label>
                    <label><input type="radio" name="medeni"
                                  value="Boşanmış" <?php echo $medeni == "Boşanmış" ? "checked" : "" ?>>
                        Boşanmış </label>

                </td>
            </tr>
            <tr>
                <td>EHLİYET</td>
                <td>
                    <label><input type="radio" name="ehliyet"
                                  value="YOK" <?php echo $ehliyet == "YOK" ? "checked" : "" ?>>
                        YOK </label>

                    <label><input type="radio" name="ehliyet"
                                  value="VAR" <?php echo $ehliyet == "VAR" ? "checked" : "" ?>>
                        VAR </label>

                </td>
            </tr>
            <tr>
                <td>ASKERLİK DURUMU</td>
                <td>
                    <label><input type="radio" name="askerlik"
                                  value="Yapılmadı" <?php echo $askerlik == "Yapılmadı" ? "checked" : "" ?>>
                        Yapılmadı </label>
                    <label><input type="radio" name="askerlik"
                                  value="Muaf" <?php echo $askerlik == "Muaf" ? "checked" : "" ?>>
                        Muaf </label>
                    <label><input type="radio" name="askerlik"
                                  value="Yapıldı" <?php echo $askerlik == "Yapıldı" ? "checked" : "" ?>>
                        Yapıldı </label>

                </td>
            </tr>


            </tr>
            <br>
            <br>

        </table>
        <table class="table table-responsive">

            <div role="tabpanel" class="tab-pane" id="egitimtab">
                <br/>

                <div class="col-md-7">
                    <table id="egitim" class="table table-condensed">

                        <thead>
                        <tr>

                            <th>
                                <h4>Eğitim Bilgileri</h4>
                            </th>
                        </tr>
                        <tr>
                            <th><strong>Okul Sayısı</strong></th>
                            <th>Okul Adı</th>
                            <th>Okul Mezun YILI</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <!-- tablonun body kısmında varsayılan olarak 1. Okulu ekliyoruz
                        metin kutularını dizi olarak ekliyoruz (alanlar[]).-->
                            <th><strong>Okul 1</strong></th>
                            <td><input id="okul_adi_" name="okul_adi[]" type="text" class="form-control" required></td>
                            <td><input id="mezun_yili_" name="mezun_yili[]" type="text" class="form-control" required>
                            </td>
                            <td></td>

                        </tr>

                        </tbody>

                        <!-- footer kısmında okul ekle butonu yerleştiriyoruz-->
                        <tfoot>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td><p id="ekle"><a style="color:white;" class="btn btn-primary">&raquo; Yeni Okul Ekle
                                </a></p>


                        </td>


                        </tfoot>

                    </table>
                    <tr>
                        <td><h6 style="text-align:center; background-color:powderblue;  ">©Copyright yunus yeşilyurt</h6></td>

                    </tr>

                    <input id="kaydet" name="kaydet" type="submit" value="İŞ BAŞVURU FORMUNU GÖNDER"
                           class="btn btn-primary btn-block"/>
                    <br>
                    <br>


                </div>
            </div>
        </table>


    </form>

</div>
</div>
</div>
</div>


<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">


    var sayac = 1; //kaçıncı okul bilgisini tutuyoruz
    $(function () {
        $('#ekle').click(function () {
            sayac += 1;
            $('#egitim tbody').append(
                '<tr><th><strong>Okul ' + sayac + '</strong></th><td><input id="okul_adi_' + sayac + '" name="okul_adi[]' + '" type="text" class="form-control" required/></td>'
                + '<td><input id="mezun_yili_' + sayac + '" name="mezun_yili[]' + '" type="text" class="form-control" required/></td>' +
                '<td><a href="#" class="sil btn btn-danger">Sil</a></td></tr>');
        });
        //sil bağlantısına tıklanınca çalışacak jquery kodumuz
        //sil tıklandığında tablodaki bulunduğu tr yi siliyoruz
        $('#egitim').on("click", ".sil", function (e) { //user click on remove text
            e.preventDefault();
            $(this).closest("tr").remove();
        })
    });
    //panellerin geçişini sağlıyor.
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
</body>
</html>