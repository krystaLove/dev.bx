<?php

namespace Helper;

class Logger {
	private static string $text = "";
	private static string $file = __DIR__ ."\..\logs\log.txt";
	private static string $sep = "\n";

	public static function addMessageToLog($msg): void
	{
		echo "Message logged.";
		self::$text .= $msg . "\n";
	}

	public static function writeToFile(): void
	{
		if(self::$text !== '')
		{
			$res = file_put_contents(self::$file, self::$text . self::$sep, FILE_APPEND);
		}
	}
}