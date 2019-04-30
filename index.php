<?php

/* HÜRRİYET.COM APİ KEY DENEME PROJE
   #ALP BOZDAĞ TARAFINDAN KODLANMIŞTIR.
   #TARİH : 29.04.2019
   
   #PROJENİN YAYINLANMA AMACI, JSON FORMATLI BİR DOSYANIN PHP ÜZERİNDEN
   #PARÇALANMASI, DEĞİŞKENE AKTARILMASI, ÇEKİLMESİ GİBİ BİR ÇOK FONKSİYONUN ANLAŞILMASIDIR.
   
   ## KAYNAK KODLARI İSTEDİĞİNİZ YERDE KULLANABİLİRSİNİZ,
   ## KOLAY GELSİN.

*/




// PHP DİLİNDE $ İŞARETİNİ DEĞİŞKEN ATAMASI YAPARKEN KULLANDIĞIMIZ İÇİN, BURADA $ İŞARETİNİ BİR DEĞİŞKENE ATIYORUM Kİ KULLANABİLEYİM.

$dollar = '$';
$api_key = "API KEYİNİZ";

//TOP=5 KISMINI TOP = X OLARAK DEĞİŞTİREBİLİRSİNİZ, NE KADAR FAZLA YAZARSANIZ O KADAR FAZLA HABER ÇEKER.
$url = 'https://api.hurriyet.com.tr/v1/articles?'.$dollar.'top=5&apikey='.$api_key;


//DOSYANIN İÇERİĞİNİ ÇEKİYORUZ.
$api_dosya = file_get_contents($url);

//ÇEKTİĞİMİZ DOSYANIN JSON FORMATINDA OLDUĞUNU SÖYLÜYORUZ VE JSON ŞEKLİNDE DECODE ETMESİNİ İSTİYORUZ.
$bul = json_decode($api_dosya,true);

?>


<html>

<head>

    <title>HABER API</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

</head>
<body>

<div class="container">
    
	<!--ÜST KISIMDA BULUNAN SON DAKİKA YAZISI, VE KAYAN HABERLER.-->
	<center><marquee SCROLLAMOUNT = 9 direction=right><?php echo $bul[1]['Title'].'<font color="red"> | </font>'.$bul[2]['Title'].'<font color="red"> | </font>'.$bul[3]['Title'].'<font color="red"> | </font>'.$bul[4]['Title'];?></marquee></center>
    
	<span class="son-dakika">SON DAKİKA</span>


    <?php

    echo "";

	//HABERLERİN LİSTELENDİĞİ DİV VE FOR DÖNGÜMÜZ.

    for($i = 0; $i < count($bul);$i++){

        $saat = $bul[$i]["CreatedDate"];
        $saat_cevir = gmdate($saat);

    echo "
    <div class='haber-listele'>
        <br /> 
    <center><img src='{$bul[$i]['Files'][0]['FileUrl']}'/></center>
    <div class='img-ustu-yazi'><a target='_blank' href='{$bul[$i]['Url']}'>{$bul[$i]['Title']}</a></div>
    <br /><center><span class='tarih'>TARİH : {$saat_cevir}</span><a class='link' target='_blank' href='http://www.hurriyet.com.tr/{$bul[$i]['Path']}'>{$bul[$i]['Path']}</a></center><br/><br />
    
    <center><h2 style='color:#fe0000'>{$bul[$i]['Title']}</h2></center>
    <br />
    <hr style='margin: 0 auto;' width='620px' />
    <br />
    <div class='icerik-yazi'><center><p>{$bul[$i]['Description']}</p></center><br />
        <a target='_blank' class='oku' href='{$bul[$i]['Url']}'>Okumaya Devam Et ...</a>
        
        <br />
        <br />
        <br />
        <br />
        <hr style='margin: 0 auto;' width='620px' />
        
        <br />
    </div><br>
    
    
</div>";
    }

    ?>



</div>




</body>


</html>
