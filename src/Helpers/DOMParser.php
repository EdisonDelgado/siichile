<?php

namespace Sii\Helpers;
use voku\helper\HtmlDomParser;

class DOMParser
{
    /**
     * Extrae los datos desde el html que entrega el SII
     * @param $html
     * @return array  array vacío en caso de fallo
     */
    public static function extract($html)
    {
        $return = [];
        $dom = HtmlDomParser::str_get_html($html);
        $contenedor = $dom->findOneOrFalse('#contenedor');

        if ($contenedor) {
            $rows = $contenedor->find('table', 0)->findMulti('tr');
            //echo $contenedor; die();
            $return['nombre'] = $contenedor->find('div', 5)->plaintext;
            $return['rut'] = $contenedor->find('div', 7)->plaintext;
            $return['fecha_iniciacion'] = trim(str_replace('Fecha de Inicio de Actividades:', '', $contenedor->find('span', 2)->plaintext));

            $giros = [];
            foreach ($rows as $index => $tr) {
                if ($index > 0) {
                    $giros[$index]['actividad'] = $tr->find('td', 0)->plaintext;
                    $giros[$index]['codigo'] = $tr->find('td', 1)->plaintext;
                    $giros[$index]['categoria'] = $tr->find('td', 2)->plaintext;
                    $giros[$index]['afecta_iva'] = $tr->find('td', 3)->plaintext;
                    $giros[$index]['fecha'] = $tr->find('td', 4)->plaintext;
                }
            }
            $return['giros'] = $giros;
        }

        return $return;
    }

}