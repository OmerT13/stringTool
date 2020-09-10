<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Exception;

class Stringify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stringify {inString?} {location?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output upper case, lower case, and a CSV file of given string';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // Welcome/Exit Messages
        $this->welcomeMsg = "Welcome to the ".basename(get_class($this))." Console Command!";
        $this->exitMsg = basename(get_class($this))." will exit now";

        // CSV Options
        $this->separator = ',';
        $this->fileName = basename(get_class($this));
        $this->ext = 'csv';

        // Error Messages
        $this->errorPrefix = "Error: ";
        $this->errorNoAlphabet = "Input must contain at least one alphabet character";
        $this->errorCSVwrite = "Unable to write CSV File. Refer to the following line for the error"; 
        $this->errorDelimeter = "Input is not allowed to include the delimeter (".$this->separator.")";
        $this->errorDefaultMsg = "Something went wrong";
        
    }

    function errorMessageRender($message) {
        return $this->errorPrefix.$message;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->welcomeMsg);

        if (Stringify::initializeIn()) {
            Stringify::processOut();
        }

    }

    public function initializeIn() {

        $inputArr = $this->arguments();

        if (isset($inputArr['inString'])) {
            $this->inStr = $inputArr['inString'];
        } else {
            $this->inStr = $this->ask('Please Input a String');
        }

        if (isset($inputArr['location'])) {
            $this->fileName = $inputArr['location'].'/'.$this->fileName;
        }
        
        try {
            
            if(!preg_match("/[a-z]/i", $this->inStr)){
                throw new Exception(Stringify::errorMessageRender($this->errorNoAlphabet));
            }
            
            if(strpos($this->inStr, $this->separator) !== false){
                throw new Exception(Stringify::errorMessageRender($this->errorDelimeter));
            }
        }
        catch(Exception $e)
		{
			$this->error($e->getMessage());
            $this->info($this->exitMsg);
            return false;
        }
        return true;
    }

    public function processOut() {
        if (Stringify::capitalizeStr()) {
            $this->line($this->capStr);
        }
        
        if (Stringify::upperLowerStr()) {
            $this->line($this->upLoStr);
        }

        if (Stringify::CSVstr()) {
            $this->line('CSV created!');
            // $this->line($this->filePath);
        } else {
            return false;
        }

        return true;
    }
    
    private function upperLowerStr() {
        $this->upLoStr = preg_replace_callback(
            // catch every pair of letters
            '!([a-zA-Z])([a-zA-Z])!',
            function ($matches) {
                return strtolower($matches[1]) . strtoupper($matches[2]);
            },
            $this->inStr);
            
        return true;
    }
    
    private function capitalizeStr() {
        $this->capStr = strtoupper($this->inStr);
        return true;
    }

    private function CSVstr() {
        // Split the string into an array then implode it back with commas as a glue
        $strArr = str_split($this->inStr);
        $strCommas = implode($this->separator,$strArr);
        $fileName = $this->fileName.'.'.$this->ext;
        $filePath = base_path().'/'.$fileName;
        try {
            file_put_contents($filePath,$strCommas);
        } catch (Exception $e) {
            $this->error(Stringify::errorMessageRender($this->errorCSVwrite));
            $this->error($e->getMessage());
            $this->info($this->exitMsg);
            return false;
        }

        if (file_exists($filePath)) { 
            $this->filePath = $filePath;
            return true;
        } else {
            $this->error(Stringify::errorMessageRender($this->errorDefaultMsg));
        }
    }
}
