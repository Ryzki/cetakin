<?php
/**
 *
 * @package CodeIgniter
 * @category Helpers
 * @author Andre Hardika (andrehardika@gmail.com)
 */
 if ( ! function_exists('dateFormat'))
 {
 	function dateFormat($type, $tanggal) {  
 		$bulan = array (1 =>   'Januari',
 					'Februari',
 					'Maret',
 					'April',
 					'Mei',
 					'Juni',
 					'Juli',
 					'Agustus',
 					'September',
 					'Oktober',
 					'November',
 					'Desember'
 				);
 		$bulan_singkat = array (1 =>   'Januari',
 					'Feb',
 					'Mar',
 					'Apr',
 					'Mei',
 					'Jun',
 					'Jul',
 					'Agt',
 					'Sep',
 					'Okt',
 					'Nov',
 					'Des'
 				);
 		$hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

 		$split = explode('-', $tanggal);
 		$split_waktu = explode(' ', $tanggal);
 		$tgl = explode(' ', $split[2]);
 		$tanggal = strtotime($tanggal);

 		switch ($type) {
 				case 0: //12, Maret 2017
 				return $split[2] . ', ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
 				break;

 				case 1: //Bulan singkat
 				return $bulan_singkat[ (int)$split[1] ];
 				break;

 				case 2: //Tanggal aja
 				return $split[2];
 				break;

 				case 3: // Senin, 12 Maret 2017
 				return $hari[date('w', $tanggal)].', '.$tgl[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' ' . $split_waktu[1];
 				break;

 				default:
 				return $split[2] . ', ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
 				break;
 		}
 	}
 }
?>
