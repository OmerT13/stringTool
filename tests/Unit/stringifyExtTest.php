<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class stringifyExtTest extends TestCase
{
    public function testArgumentStringInput()
    {
        $this->artisan("stringifyExt", ["inString" => "Hello World"])
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsOutput("HELLO WORLD")
            ->expectsOutput("hElLo wOrLd")
            ->expectsOutput("CSV created!")
            ->expectsOutput("hello world")
            ->expectsOutput("hElLo WoRlD")
            ->expectsOutput("hELLO wORLD")
            ->assertExitCode(0);        
    }
    public function testPromptedStringInput()
    {
        $this->artisan("stringifyExt")
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsQuestion("Please Input a String","Hello World")
            ->expectsOutput("HELLO WORLD")
            ->expectsOutput("hElLo wOrLd")
            ->expectsOutput("CSV created!")
            ->expectsOutput("hello world")
            ->expectsOutput("hElLo WoRlD")
            ->expectsOutput("hELLO wORLD")
            ->assertExitCode(0);        
    }
    
    public function testArgumentNonAlphabeticInput()
    {
        $this->artisan("stringifyExt", ["inString" => "12#$%$345"])
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsOutput("Error: Input must contain at least one alphabet character")
            ->expectsOutput("StringifyExt will exit now")
            ->assertExitCode(0);       
    }
    
    public function testPromptedNonAlphabeticInput()
    {
        $this->artisan("stringifyExt")
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsQuestion("Please Input a String","12#$%$345")
            ->expectsOutput("Error: Input must contain at least one alphabet character")
            ->expectsOutput("StringifyExt will exit now")
            ->assertExitCode(0);         
    }
    
    public function testArgumentMixedInput()
    {
        $this->artisan("stringifyExt", ["inString" => "Hello World543%$#"])
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsOutput("HELLO WORLD543%$#")
            ->expectsOutput("hElLo wOrLd543%$#")
            ->expectsOutput("CSV created!")
            ->expectsOutput("hello world543%$#")
            ->expectsOutput("hElLo WoRlD543%$#")
            ->expectsOutput("hELLO wORLD543%$#")
            ->assertExitCode(0);        
        }
        
    public function testPromptedMixedInput()
    {

        $this->artisan("stringifyExt")
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsQuestion("Please Input a String","Hello World543%$#")
            ->expectsOutput("HELLO WORLD543%$#")
            ->expectsOutput("hElLo wOrLd543%$#")
            ->expectsOutput("CSV created!")
            ->expectsOutput("hello world543%$#")
            ->expectsOutput("hElLo WoRlD543%$#")
            ->expectsOutput("hELLO wORLD543%$#")
            ->assertExitCode(0);        
    }

    public function testArgumentMixedInputWithSemicolon()
    {
        // String passed as stringify is called
        $this->artisan("stringifyExt", ["inString" => "Hello; World543%$#"])
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsOutput("Error: Input is not allowed to include the delimeter (;)")
            ->expectsOutput("StringifyExt will exit now")
            ->assertExitCode(0);        
    }
    
    public function testPromptedMixedInputWithSemicolon()
    {
        // String passed as stringify is called
        $this->artisan("stringifyExt")
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsQuestion("Please Input a String","Hello; World543%$#")
            ->expectsOutput("Error: Input is not allowed to include the delimeter (;)")
            ->expectsOutput("StringifyExt will exit now")
            ->assertExitCode(0);       
    }

    public function testWithCsvNotPermitted()
    {
        // String passed as stringify is called
        $this->artisan("stringifyExt", ["inString" => "Hello World","location" => "output"])
            ->expectsOutput("Welcome to the StringifyExt Console Command!")
            ->expectsOutput("HELLO WORLD")
            ->expectsOutput("hElLo wOrLd")
            ->expectsOutput("Error: Unable to write CSV File. Refer to the following line for the error")
            ->assertExitCode(0);         
    }  
        
}
