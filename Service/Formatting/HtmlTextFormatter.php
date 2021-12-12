<?php

namespace Service\Formatting;

class HtmlTextFormatter implements Formatter
{

	public function format(string $text, string $tag = "p"): string
	{
		return "<{$tag}>". $text . "</{$tag}>";
	}
}