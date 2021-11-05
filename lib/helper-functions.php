<?php

function cutString(string $str, int $length) : string
{
	if(strlen($str) <= $length)
	{
		return $str;
	}

	return mb_substr($str, 0, $length) . "...";
}

function getFileName(string $filePath) : string
{
	return basename($filePath, ".php");
}

function escape(string $str) : string
{
	return htmlspecialchars($str, ENT_QUOTES);
}