<?php

if (!function_exists('overWriteEnvFile')) {
    function overWriteEnvFile($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $value = '"' . trim($value) . '"';
            $fileContent = file_get_contents($path);

            // Check if the key already exists in the .env file
            if (strpos($fileContent, $key . '=') !== false) {
                $fileContent = preg_replace(
                    '/^' . preg_quote($key, '/') . '=.*/m',
                    $key . '=' . $value,
                    $fileContent
                );
            } else {
                $fileContent .= PHP_EOL . $key . '=' . $value;
            }

            file_put_contents($path, $fileContent);
        }
    }
}

if (!function_exists('trimDomain')) {
    function trimDomain($url)
    {
        // Helper function to trim the domain from the URL
        return parse_url($url, PHP_URL_HOST);
    }
}


if (!function_exists('versionOfPhp')) {
    function versionOfPhp()
    {
        return (float) phpversion();  // Returns the PHP version as a float (e.g., 8.0 or 7.4)
    }
}
