<?php

namespace bitflix\core;

class Response
{
	public function setStatusCode(int $statusCode): void
	{
		http_response_code($statusCode);
	}

	public function redirect(string $url): void
	{
		header("Location: $url");
	}
}