<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class SignatureHelper
{
    const PUBLIC_KEY_EC = "-----BEGIN PUBLIC KEY-----
MFYwEAYHKoZIzj0CAQYFK4EEAAoDQgAEyKHDQeE/tq46kAWeKriJ99oHrsax9H8v
u1C1VcZE179DDIzHbtp4daPt9AvTd24pUH3oYfeJdsay9TIyhtO7Hw==
-----END PUBLIC KEY-----
";
    const PRIVATE_KEY_EC = "-----BEGIN EC PRIVATE KEY-----
MHQCAQEEIApfm7x3Axf7Nt1ks2/8/6lNFNG6Eaet8DwJOscve9j+oAcGBSuBBAAK
oUQDQgAEyKHDQeE/tq46kAWeKriJ99oHrsax9H8vu1C1VcZE179DDIzHbtp4daPt
9AvTd24pUH3oYfeJdsay9TIyhtO7Hw==
-----END EC PRIVATE KEY-----";

    // Algorithms
    const DEFAULT_ALGORITHMS_FLAG = OPENSSL_ALGO_SHA256;
    const DEFAULT_METHOD_ENCRYPT = "aes-256-cbc";
    const DEFAULT_PASSWORD_ENCRYPT = "NFNG6BBAAK";
    const BASE64_IV = "abT5aj4qx+BrryNp0HlFwg==";

    protected static $instance;

    private function __construct()
    {

    }

    /**
     * Get instance
     *
     *
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * This function generate signature
     *
     * @param string $data
     * @param mixed $privateKeyPem
     *
     * @see \openssl_sign()
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function generateSignature($data, $privateKeyPem)
    {
        if (!is_string($data)) {
            throw new \Exception('Data to generate signature must be string.');
        }

        if (empty($privateKeyPem)) {
            throw new \Exception('Private key must has value.');
        }

        if (is_string($privateKeyPem)) {
            $privateKeyPem = openssl_get_privatekey($privateKeyPem);
        }

        $isSuccess = openssl_sign($data, $signature, $privateKeyPem, self::DEFAULT_ALGORITHMS_FLAG);

        if (!$isSuccess) {
            throw new \Exception('There is problem when generate signature: ' . $data);
        }

        return $signature;
    }

    /**
     * This function handle verify signature
     *
     * @param string $data
     * @param string $signature
     * @param string $publicKey
     *
     * @see \openssl_verify()
     *
     * @return int
     *
     * @throws \Exception
     *
     */
    public static function verifySignature($data, $signature, $publicKey)
    {
        if (!is_string($data)) {
            throw new \Exception('Data to verify signature must be string.');
        }

        if (empty($publicKey)) {
            throw new \Exception('Public key must has value.');
        }

        if (is_string($publicKey)) {
            $publicKey = openssl_get_publickey($publicKey);
        }

        return openssl_verify($data, $signature, $publicKey, self::DEFAULT_ALGORITHMS_FLAG);
    }

    /**
     * Encrypt
     *
     * @param string $string
     *
     * @return mixed
     *
     */
    public static function encryptData($string)
    {
        $iv = base64_decode(self::BASE64_IV);

        return openssl_encrypt($string, self::DEFAULT_METHOD_ENCRYPT, self::DEFAULT_PASSWORD_ENCRYPT, 0, $iv);
    }

    /**
     * Decrypt
     *
     * @param string $encryptedData
     *
     * @return mixed
     *
     */
    public static function decryptData($encryptedData)
    {
        $iv = base64_decode(self::BASE64_IV);

        return openssl_decrypt($encryptedData, self::DEFAULT_METHOD_ENCRYPT, self::DEFAULT_PASSWORD_ENCRYPT, 0, $iv);
    }
}