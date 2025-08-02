<?php
/**
 * Environment Variables Helper
 * 
 * This file provides functions to load and access environment variables
 * from the .env file. It can be included in any PHP file that needs
 * to access environment variables.
 */

// Load environment variables from .env file
function loadEnv($path) {
	if (!file_exists($path)) {
		return false;
	}
	
	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($lines as $line) {
		if (strpos($line, '#') === 0) {
			continue; // Skip comments
		}
		
		if (strpos($line, '=') !== false) {
			list($key, $value) = explode('=', $line, 2);
			$key = trim($key);
			$value = trim($value);
			
			// Remove quotes if present
			if (preg_match('/^(["\'])(.*)\1$/', $value, $matches)) {
				$value = $matches[2];
			}
			
			$_ENV[$key] = $value;
			putenv("$key=$value");
		}
	}
	return true;
}

// Get environment variable with optional default value
function getEnvVar($key, $default = null) {
	// First check $_ENV array
	if (isset($_ENV[$key])) {
		return $_ENV[$key];
	}
	
	// Then check getenv()
	$value = getenv($key);
	if ($value !== false) {
		return $value;
	}
	
	// Return default if not found
	return $default;
}

// Initialize environment variables if not already loaded
if (!isset($_ENV['GOOGLE_MAPS_API_KEY']) || !isset($_ENV['GOOGLE_CALENDAR_API_KEY'])) {
	$envPath = __DIR__ . '/../.env';
	loadEnv($envPath);
}
?> 