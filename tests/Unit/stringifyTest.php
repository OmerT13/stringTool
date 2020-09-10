<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class stringifyTest extends TestCase
{

    public function testArgumentStringInput()
    {
        // String passed as stringify is called
        $this->artisan("stringify", ["inString" => "Hello World"])
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsOutput("HELLO WORLD")
            ->expectsOutput("hElLo wOrLd")
            ->expectsOutput("CSV created!")
            ->assertExitCode(0);        
    }
    public function testPromptedStringInput()
    {
        // String passed as stringify is called
        $this->artisan("stringify")
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsQuestion("Please Input a String","Hello World")
            ->expectsOutput("HELLO WORLD")
            ->expectsOutput("hElLo wOrLd")
            ->expectsOutput("CSV created!")
            ->assertExitCode(0);        
    }
    
    public function testArgumentNonAlphabeticInput()
    {
        // String passed as stringify is called
        $this->artisan("stringify", ["inString" => "12#$%$345"])
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsOutput("Error: Input must contain at least one alphabet character")
            ->expectsOutput("Stringify will exit now")
            ->assertExitCode(0);       
    }
    
    public function testPromptedNonAlphabeticInput()
    {
        // String passed as stringify is called
        $this->artisan("stringify")
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsQuestion("Please Input a String","12#$%$345")
            ->expectsOutput("Error: Input must contain at least one alphabet character")
            ->expectsOutput("Stringify will exit now")
            ->assertExitCode(0);         
    }
    
    public function testArgumentMixedInput()
    {
        // String passed as stringify is called
        $this->artisan("stringify", ["inString" => "Hello World543%$#"])
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsOutput("HELLO WORLD543%$#")
            ->expectsOutput("hElLo wOrLd543%$#")
            ->expectsOutput("CSV created!")
            ->assertExitCode(0);        
        }
        
        public function testPromptedMixedInput()
        {
            // String passed as stringify is called
            $this->artisan("stringify")
                ->expectsOutput("Welcome to the Stringify Console Command!")
                ->expectsQuestion("Please Input a String","Hello World543%$#")
                ->expectsOutput("HELLO WORLD543%$#")
                ->expectsOutput("hElLo wOrLd543%$#")
                ->expectsOutput("CSV created!")
                ->assertExitCode(0);        
        }
        
 
    public function testArgumentMixedInputWithComma()
    {
        // String passed as stringify is called
        $this->artisan("stringify", ["inString" => "Hello, World543%$#"])
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsOutput("Error: Input is not allowed to include the delimeter (,)")
            ->expectsOutput("Stringify will exit now")
            ->assertExitCode(0);        
    }
    
    public function testPromptedMixedInputWithComma()
    {
        // String passed as stringify is called
        $this->artisan("stringify")
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsQuestion("Please Input a String","Hello, World543%$#")
            ->expectsOutput("Error: Input is not allowed to include the delimeter (,)")
            ->expectsOutput("Stringify will exit now")
            ->assertExitCode(0);       
    }

    public function testWithCsvNotPermitted()
    {
        // String passed as stringify is called
        $this->artisan("stringify", ["inString" => "Hello World","location" => "output"])
            ->expectsOutput("Welcome to the Stringify Console Command!")
            ->expectsOutput("HELLO WORLD")
            ->expectsOutput("hElLo wOrLd")
            ->expectsOutput("Error: Unable to write CSV File. Refer to the following line for the error")
            ->assertExitCode(0);         
    }
}
