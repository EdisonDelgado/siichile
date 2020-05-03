# Información tributaria de terceros SII

Obtiene  pública porporcionada por el servicio de impuestos internos mediante un Rut chileno desde la página [SII](https://zeus.sii.cl/cvc/stc/stc.html)



### Instalación 

```
composer require
```

### Ejemplo de uso


```
if(\Sii\Helpers\Rut::validar('93834000-5')){

    $rut = new \Sii\Helpers\Rut('93834000-5');
    $consulta = new Sii\Consulta();
    echo '<pre>'.var_export($consulta->infoRut($rut), true).'</pre>';

}else{
    echo 'RUT inválido';
}
```

---