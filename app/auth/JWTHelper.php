<?php

namespace App\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTHelper
{
    // Secret key for signing JWT tokens
    private static $secretKey = 'your-secret-key'; // Change this to your actual secret key

    // Define JWT algorithm
    private static $algorithm = 'HS256';

    /**
     * Generate JWT token
     *
     * @param array $payload The data you want to encode into the JWT.
     * @param int $expiration The expiration time for the token in seconds. Default is 7 days.
     *
     * @return string The generated JWT token.
     */
    public static function generateToken(array $payload, int $expiration = 3600 * 24 * 7): string
    {
        // Set the expiration time
        $issuedAt = time();
        $expirationTime = $issuedAt + $expiration; // jwt valid for 1 hour from the issued time

        // Add the required fields to the payload
        $payload['iat'] = $issuedAt;  // Issued at: time when the token was generated
        $payload['exp'] = $expirationTime; // Expiration time

        try {
            // Encode the payload into a JWT using the secret key and algorithm
            $jwt = JWT::encode($payload, self::$secretKey, self::$algorithm);

            return $jwt;
        } catch (Exception $e) {
            // Handle any errors
            throw new Exception('Error generating JWT: ' . $e->getMessage());
        }
    }

    /**
     * Validate the JWT token and decode it
     *
     * @param string $jwt The JWT token to validate and decode.
     *
     * @return object|null The decoded payload if the token is valid, null otherwise.
     *
     * @throws Exception If the token is invalid or expired.
     */
    public static function validateToken(string $jwt)
    {
        try {
            // Decode the JWT using the secret key and the same algorithm
            $decoded = JWT::decode($jwt, new Key(self::$secretKey, self::$algorithm));

            // Ensure the return type is a stdClass object
            return (object) $decoded; // This casts the decoded array into an object if necessary
        } catch (Exception $e) {
            // Handle errors related to the token
            throw new Exception('Invalid or expired token: ' . $e->getMessage());
        }
    }
}
