<?php
require("../inc/fonk.php"); //veri tabanı bağlantısı gerçekleştiriliyor
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>

    <style>
        body {
            background-image: url('img/bg(6).jpg');
        }
    </style>
</head>
<body>

<div class="container">

    <div class="col-md-12"><br>
        <table style="background-color: white;" id="myTable" class="table table-bordered table-condensed">
            <thead>
            <tr>
                <th>Adı Soyadı</th>
                <th>E-Mail Adresi</th>
                <th>Doğum Tarihi</th>
                <th>Doğum Yeri</th>
                <th>Cep Telefonu</th>
                <th></th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //Ogrenci tablosundan tüm veriyi çekiyoruz
            //Çekilen veriyi tablo halinde yazdırıyoruz
            //düzenle ve sil linklerini ekliyoruz
            $sorgu = $baglanti->query("select * from basvuru");
            while ($sonuc = $sorgu->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $sonuc["adSoyad"] ?></td>
                    <td><?php echo $sonuc["mail"] ?></td>
                    <td><?php echo $sonuc["DogumTarihi"] ?></td>
                    <td><?php echo $sonuc["DogumYeri"] ?></td>
                    <td><?php echo $sonuc["CTelefon"] ?></td>
                    <td><a class="btn btn-danger" href='detay.php?id=<?php echo $sonuc["id"] ?>'>Başvuru Detay
                        </a></td>
                    <td>

                        </a>
                        <a data-toggle="modal" href="#" data-target="#sil<?php echo $sonuc["id"] ?>">
                            <img height="25" width="25" src="img/sil.png"/></a>
                        <!-- Modal -->
                        <div class="modal fade" id="sil<?php echo $sonuc["id"] ?>" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Başvuru sil</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h2 style="color: red; text-align: center">Önemli Uyarı !</h2>

                                        <h4 style="text-align: center"><b><?php echo $sonuc["adSoyad"] ?><br></b> Adlı
                                            kişinin başvurusunu silmek istediğinizden emin misiniz?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                            Vazgeç
                                        </button>
                                        <a href="sil.php?id=<?php echo $sonuc["id"] ?>" class="btn btn-danger">Sil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/rg-1.0.0/datatables.min.css"/>

<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/rg-1.0.0/datatables.min.js"></script>

<script>
    $('#myTable').DataTable({
        language: {
            info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
            infoEmpty: "Gösterilecek hiç kayıt yok.",
            loadingRecords: "Kayıtlar yükleniyor.",
            zeroRecords: "Tablo boş",
            search: "Arama:",
            infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
            buttons: {
                copyTitle: "Panoya kopyalandı.",
                copySuccess: "Panoya %d satır kopyalandı",
                copy: "Kopyala",
                print: "Yazdır",
            },

            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        responsive: true
    });
</script>
</body>
</html>