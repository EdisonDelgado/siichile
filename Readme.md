# Información tributaria de terceros SII

Obtiene  pública porporcionada por el servicio de impuestos internos mediante un Rut chileno desde la página [SII](https://zeus.sii.cl/cvc/stc/stc.html)



### Instalación vía composer

```
composer require edelgado/sii
```

### Ejemplo de uso


```
<?php
require_once __DIR__ . '/vendor/autoload.php';


if(\Sii\Helpers\Rut::validar('93834000-5')){

    $rut = new \Sii\Helpers\Rut('93834000-5');
    $consulta = new Sii\Consulta();
    echo '<pre>'.var_export($consulta->infoRut($rut), true).'</pre>';

}else{
    echo 'RUT inválido';
}

```

---