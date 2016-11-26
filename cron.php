<?php
	require 'inc/funkcje.php';
	//SQ("TRUNCATE awb");
	//SQ("TRUNCATE records");
	//SQ("TRUNCATE files");
	//die;
file_put_contents('log_cron_manifesting_itx.txt',"### S T A R T ### ".date("Y-m-d H:i:s")."\r\n",FILE_APPEND);
session_start();
//require 'inc/funkcje.php';
pobierz_pliki_z_ftp(true); //pobiera,kasuje, zapisuje w processed pliki z FTP  - true - kasuje z FTP
wpisz_do_mysql(); //wpisuje do mysql: files,records,awb
dopisz_dest_xml_do_awb(); //dopisuej dest,facility,xml do awb
zrob_xmle_do_wysylki();//dopisuje do files pełne xml-e do wysylki - jeśli mają null w xml_to_dcs
wysylaj_do_dcs();// sprawdz dla files z sent=0 czy zrob full xml, wyslij maila, zapisz sent
file_put_contents('log_cron_manifesting_itx.txt',$a."\r\n"."### E N D ###".date("Y-m-d H:i:s")."#####"."\r\n",FILE_APPEND);

?>