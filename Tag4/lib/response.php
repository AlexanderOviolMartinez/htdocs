<?php
namespace lib;

abstract class response
{
    /**
     * Include an error page based on the provided error code.
     *
     * @param int $code The error code to determine which page to load.
     */
    public static function errorJSON( string $code)
    {
        $filePath = "./404/$code.html";

        // Check if the error page exists
        if (file_exists($filePath)) {
            http_response_code($code); // Set the appropriate HTTP response code
            include $filePath;
        } else {
            // Handle case where error page doesn't exist
            http_response_code(500); // Internal Server Error
            echo "An unexpected error occurred. Please try again later.";
        }
    }

    /**
     * Send a success response in JSON format.
     *
     * @param mixed $data The data to send in the response.
     */
    public static function successJSON($data)
    {
        http_response_code(200); // Set success status code
        header('Content-Type: application/json'); // Set the content type to JSON
        echo json_encode($data); // Encode and output the data as JSON
    }
}
