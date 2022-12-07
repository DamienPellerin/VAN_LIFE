<?php

require_once(__DIR__ . '/../config/config.php');

class JWT{


    public static function set(mixed $element){
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        $payload = json_encode($element);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET_KEY, true);

        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $token;
    }

    public static function get(string $token){

        $tokenParts = explode('.', $token);

        $payloadDecoded = base64_decode($tokenParts[1]);

        $payloadArray = json_decode($payloadDecoded);

        if($payloadArray->valid<time()){

            return false;
        }

        $tokenToCheck = self::set($payloadArray);

        if($tokenToCheck == $token){
            $element = json_decode(base64_decode($tokenParts[1]));
            return $element;
        } else {
            return false;
        }

    }

}