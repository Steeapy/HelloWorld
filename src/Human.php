<?php
declare (strict_types=1);

namespace HelloWorld;

class Human
{
	public function sayHello(string $name): void
	{
	   $this->say("Hallo, ich bin $name");
	}

	public function sayAge(int $age): void
	{
	    $this->say("Ich bin $age Jahre alt\n");
	}

	public function sayProfession(string $profession): void
	{
	    $this->say("Ich arbeite als $profession\n");
	}

	private function say(string $sentence): void
	{
		echo $sentence;
	}
}

