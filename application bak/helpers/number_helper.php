<?php

 if ( ! function_exists('rupiah()'))
 {
     function rupiah($angka){  
       $jumlah_desimal ="0";
       $pemisah_desimal =",";
       $pemisah_ribuan =".";
       return "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
     }
 }
?>
