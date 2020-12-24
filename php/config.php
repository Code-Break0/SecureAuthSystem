<?php

	// Database Credentials
	define("DB_HOST", 'localhost');
	define("DB_DATABASE", 'yt');
	define("DB_USERNAME", 'root');
	define("DB_PASSWORD", 'root');

	// Email Credentials
	define("SMTP_HOST", 'mail.mydomain.com');
	define("SMTP_PORT", 465);
	define("SMTP_USERNAME", 'name@mydomain.com');
	define("SMTP_PASSWORD", '<my password>');
	define("SMTP_FROM", 'noreply@mydomain.com');
	define("SMTP_FROM_NAME", 'Code Break');

	// Global Variables
	define("MAX_LOGIN_ATTEMPTS_PER_HOUR", 5);
	define("MAX_EMAIL_VERIFICATION_REQUESTS_PER_DAY", 3);
	define("MAX_PASSWORD_RESET_REQUESTS_PER_DAY", 3);
	define("CSRF_TOKEN_SECRET", '<change me to something random>');

	// Code we want to run on every page/script
	date_default_timezone_set("UTC"); 
	// error_reporting(0);
	session_set_cookie_params(['samesite' => 'Strict']);
	