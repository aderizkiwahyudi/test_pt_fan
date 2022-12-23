<!DOCTYPE html>
<html>
    <head>
        <title>Test ke 1</title>
    </head>
<body>

<?php

#NOMOR 1

function hitungJumlahPasang($num = []){
	$num_temp = [];

    $jumlah = 0;

    $arr = array_count_values($num);

    foreach($num as $n){
        if(!in_array($n, $num_temp)){
            $num_temp[] = $n;
        }
    }

    foreach($num_temp as $nt){
        $bagi = floor($arr[$nt]/2);
        $jumlah += $bagi;
    }

    echo $jumlah;
}

#NOMOR 2

function cekPanjangKalimat($kalimat = ''){
	
$words = explode(' ', $kalimat);

$count = 0;
foreach($words as $w){
	if(preg_match('/^[A-Z,.?-]+$/i', $w)){
    	$count += 1;
    }
}

echo 'Jumlah kata : ' . $count;
}
?>
<h3>Nomor 1</h3>

<p>Jumlah Pasang : <?= hitungJumlahPasang([5, 7, 7, 9, 10, 4, 5, 10, 6, 5]) ?> </p>

<p>Jumlah Pasang : <?= hitungJumlahPasang([10, 20, 20, 10, 10, 30, 50, 10, 20]) ?> </p>

<p>Jumlah Pasang : <?= hitungJumlahPasang([6, 5, 2, 3, 5, 2, 2, 1, 1, 5, 1, 3, 3, 3, 5]) ?> </p>

<p>Jumlah Pasang : <?= hitungJumlahPasang([1, 1, 3, 1, 2, 1, 3, 3, 3, 3]) ?> </p>

<h3>Nomor 2</h3>

<p><?= cekPanjangKalimat("Kemarin Shopia per[gi ke mall.") ?></p>

<p><?= cekPanjangKalimat(" Saat meng*ecat tembok, Agung dib_antu oleh Raihan.") ?></p>

<p><?= cekPanjangKalimat("Berapa u(mur minimal[ untuk !mengurus ktp?") ?></p>

<p><?= cekPanjangKalimat("Masing-masing anak mendap(atkan uang jajan ya=ng be&rbeda.") ?></p>

</body>
</html>
