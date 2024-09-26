<?php

$query = [
    "TRUNCATE TABLE users",
];

foreach($query as $q) {
    $dbNew->query($q);
    echo $q . "\n";
}


$query = "SELECT * FROM users ORDER BY id ASC";
$res = $dbOld->query($query);

while ($obj = $dbOld->fetch_object($res))
{
    $kode_ppk = $obj->id;
    $name = $dbNew->escape_string($obj->name);

    $id_level = $obj->id_level;
    empty($id_level) ? $id_level = 'NULL' : $id_level;

    $email = $dbNew->escape_string($obj->email);
    $email_real = $dbNew->escape_string($obj->email_real);
    $password = $obj->password;

    $is_ppk = $obj->is_ppk;
    empty($is_ppk) ? $is_ppk = 'NULL' : $is_ppk;

    $is_pp = $obj->is_pp;
    empty($is_pp) ? $is_pp = 'NULL' : $is_pp;

    $is_pkualitas = $obj->is_pkualitas;
    empty($is_pkualitas) ? $is_pkualitas = 'NULL' : $is_pkualitas;

    $is_tutor = $obj->is_tutor;
    empty($is_tutor) ? $is_tutor = 'NULL' : $is_tutor;

    $undang = $obj->undang;
    empty($undang) ? $undang = 'NULL' : $undang;

    $internasional = $obj->internasional;
    empty($internasional) ? $internasional = 'NULL' : $internasional;

    $remember_token = $obj->remember_token;

    $created_at = $obj->created_at;
    if ($created_at == '0000-00-00 00:00:00' || empty($created_at)) {
        $created_at = "NULL";
    }
    else {
        $created_at = "'$obj->created_at'";
    }

    $updated_at = $obj->updated_at;
    if ($updated_at == '0000-00-00 00:00:00' || empty($updated_at)) {
        $updated_at = "NULL";
    }
    else {
        $updated_at = "'$obj->updated_at'";
    }

    $email_verified_at = $obj->email_verified_at;
    if ($email_verified_at == '0000-00-00 00:00:00' || empty($email_verified_at)) {
        $email_verified_at = "NULL";
    }
    else {
        $email_verified_at = "'$obj->email_verified_at'";
    }

    $andro_user = $obj->andro_user;
    $andro_password = $obj->andro_password;
    

    $query = "INSERT INTO users VALUES (
        $kode_ppk,
        '$name',
        $id_level,
        '$email',
        '$email_real',
        '$password',
        $is_ppk,
        $is_pp,
        $is_pkualitas,
        $is_tutor,
        $undang,
        $internasional,
        '$remember_token',
        $created_at,
        $updated_at,
        $email_verified_at,
        '$andro_user',
        '$andro_password'
    )";

    $dbNew->query($query);

    echo 'user email: ' . $email . PHP_EOL;
}
