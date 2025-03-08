<?php

declare(strict_types=1);

namespace App\Model\Logic;

use Elliptic\EC as EllEC;
use kornrunner\Keccak;

final class SecureLogic
{
    /**
     * Verifies an Ethereum signature for a given message, signature, and address.
     *
     * @param string $message The message that was signed.
     * @param string $signature The signature to verify.
     * @param string $address The Ethereum address to compare with the recovered address.
     * @return bool Returns true if the signature is valid for the given message and address, false otherwise.
     */
    public static function verifyEthSign($message, $signature, $address): bool
    {
        // Calculate the hash of the message
        $msglen = strlen($message);
        $hash = Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);

        // Extract the r, s, and recovery id (recid) components from the signature
        $sign = ["r" => substr($signature, 2, 64), "s" => substr($signature, 66, 64)];
        $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;

        // Validate the recid to ensure it's either 0 or 1
        if ($recid != ($recid & 1)) {
            return false;
        }

        // Recover the public key from the hash, r, s, and recid
        $ec = new EllEC("secp256k1");
        $pubkey = $ec->recoverPubKey($hash, $sign, $recid);

        // Convert the public key to an Ethereum address and compare it with the provided address
        return strtolower($address) == self::pubKeyToAddress($pubkey);
    }

    /**
     * Converts a public key to an Ethereum address.
     *
     * @param mixed $pubkey The public key to convert.
     * @return string The Ethereum address corresponding to the public key.
     */
    private static function pubKeyToAddress($pubkey)
    {
        // Convert the public key to hexadecimal format and remove the prefix
        // Hash the public key using Keccak-256 and take the last 20 bytes (40 characters)
        // Prefix the result with "0x" and return it in lowercase
        return strtolower("0x" . substr(Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24));
    }

    /**
     * Encrypts a text using a simple encryption algorithm.
     *
     * @param string $txt The text to encrypt.
     * @param string $key The encryption key.
     * @return string The encrypted text.
     */
    public static function encrypt($txt, $key = "str")
    {
        // Append the key to the text
        $txt = $txt . $key;

        // Define a character set for encryption
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+_#%&!@";

        // Generate a random number to select a character from the character set
        $nh = rand(0, 64);
        $ch = $chars[$nh];

        // Generate a modified key using the key and the selected character
        $mdKey = md5($key . $ch);
        $mdKey = substr($mdKey, $nh % 8, ($nh % 8) + 7);

        // Base64 encode the text
        $txt = base64_encode($txt);

        // Encrypt the text using the modified key and character set
        $tmp = "";
        $i = 0;
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = ($nh + strpos($chars, $txt[$i]) + ord($mdKey[$k++])) % 64;
            $tmp .= $chars[$j];
        }

        // URL encode the encrypted text
        return urlencode(base64_encode($ch . $tmp));
    }

    /**
     * Decrypts an encrypted text using a simple encryption algorithm.
     *
     * @param string $txt The encrypted text to decrypt.
     * @param string $key The decryption key.
     * @return string The decrypted text.
     */
    public static function decrypt($txt, $key = "str")
    {
        // Decode the URL encoded and base64 encoded text
        $txt = base64_decode(urldecode($txt));

        // Define a character set for decryption
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+_#%&!@";

        // Extract the first character of the encrypted text, which determines the starting point in the character set
        $ch = $txt[0];
        $nh = strpos($chars, $ch);

        // Generate a modified key using the key and the first character of the encrypted text
        $mdKey = md5($key . $ch);
        $mdKey = substr($mdKey, $nh % 8, ($nh % 8) + 7);

        // Remove the first character from the encrypted text
        $txt = substr($txt, 1);

        // Decrypt the text using the modified key and character set
        $tmp = "";
        $i = 0;
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = strpos($chars, $txt[$i]) - $nh - ord($mdKey[$k++]);
            while ($j < 0) {
                $j += 64;
            }
            $tmp .= $chars[$j];
        }

        // Trim the decrypted text to remove the appended key and return it
        return trim(base64_decode($tmp), $key);
    }
}
