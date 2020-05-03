<?php
require_once __DIR__ . '/vendor/autoload.php';


if(\Sii\Helpers\Rut::validar('93834000-5')){

    $rut = new \Sii\Helpers\Rut('93834000-5');
    $consulta = new Sii\Consulta();
    echo '<pre>'.var_export($consulta->infoRut($rut), true).'</pre>';

}else{
    echo 'RUT inválido';
}
