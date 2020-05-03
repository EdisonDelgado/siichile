<?php

namespace Sii;

use GuzzleHttp\Client;
use Sii\Helpers\DOMParser;
use Sii\Helpers\Rut;

class Consulta
{
    const CAPTCHA_URL = '/cvc_cgi/stc/CViewCaptcha.cgi';
    const INFO_URL = '/cvc_cgi/stc/getstc';
    const BASE_URL = 'https://zeus.sii.cl';
    public $client = null;

    /**
     * helpers constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::BASE_URL]);
    }

    /**
     * Obtiene la información de un Rut de empresas desde el SII
     * @param Rut $rut Objeto rut new  Sii\helpers\Rut('12345678-9');
     * @return array|null array con datos del rut proporcionado
     */
    public function infoRut(Rut $rut)
    {

        $codigo = $this->codigoCaptcha();

        $response = $this->client->request(
            'POST',
            self::INFO_URL,
            [
                'form_params' => [
                    'RUT' => $rut->num,
                    'DV' => $rut->dv,
                    'PRG' => 'STC',
                    'OPC' => 'NOR',
                    'txt_code' => $codigo->txtCode,
                    'txt_captcha' => $codigo->txtCaptcha
                ]
            ]);

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            return DOMParser::extract($body->getContents());
        }
        return null;
    }


    /**
     * @return mixed|null
     */
    public function codigoCaptcha()
    {
        $response = $this->client->request('POST', self::CAPTCHA_URL, ['form_params' => ['oper' => 0]]);

        if ($response->getStatusCode() == 200) {
            $body = json_decode($response->getBody());
            $captcha = base64_decode($body->txtCaptcha);
            $body->txtCode = substr($captcha, 36, 4);
            return $body;
        }
        return null;
    }

}