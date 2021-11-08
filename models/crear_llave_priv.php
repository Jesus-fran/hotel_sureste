<?php

$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);


// Crea la llave privada
$res = openssl_pkey_new($config);
openssl_pkey_export($res, $out);

$archivo = fopen('llaves/llave_privada.txt','a+');
fputs($archivo, $out);
fclose($archivo);

$archivo = "llaves/llave_privada.txt"; 
header ("Content-Disposition: attachment; filename=".$archivo); 
header ("Content-Type: application/octet-stream"); 
header ("Content-Length: ".filesize($archivo)); 
readfile($archivo);

