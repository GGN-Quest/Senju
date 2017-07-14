<?php
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	FICHIER 'cores/settings.database.php'
======================================================

*/
	
if(!class_exists('_GGN')){exit('Classe Native introuvable');}
if(!class_exists('_GGNDB')){_GGN::wCnsl('Classe "NativeDB" introuvable');}
if(!isset($database)){_GGN::wCnsl('Variable "database" introuvable');}



/* Type de connexion à la base de donnée (pdo, mysql, mysqli) */
	
	$database->mode('-pdo');
	
/*

Configuration de l'accès à la base de donnée
->log : 
	  Serveur
	, Nom_d_utilisateur
	, Mot_de_passe
	, Nom_de_la_base_de_donnee
	, prefixe_des_tables


*/	


	$database->log('localhost', 'root', '', 'ggn_core_fwks', 'ggn_');
	
	
	

