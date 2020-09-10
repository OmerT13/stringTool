<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StringifyExt extends Stringify
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stringifyExt {inString?} {location?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An extension of Stringify that outputs lowercase, an second way for case alternation, and a case-reversed form of the string';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->separator = ';';
        $this->errorDelimeter = "Input is not allowed to include the delimeter (".$this->separator.")";
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
            $continue = Stringify::processOut();
        } else {
            $continue = false;
        }

        if ($continue) {
            if (StringifyExt::lowerStr()) {
                $this->line($this->lowStr);
            }
            
            if (StringifyExt::alternateStr()) {
                $this->line($this->altStr);
            }

            if (StringifyExt::reverseCaseStr()) {
                $this->line($this->revCaseStr);
            }
        }
    }

    private function alternateStr() {
        $letter_count = 0;
        $this->altStr = '';
        for ($i=0; $i<strlen($this->inStr); $i++) {
            if (!preg_match('![a-zA-Z]!', $this->inStr[$i])) {
                $this->altStr .= $this->inStr[$i];
            } else if ($letter_count++ & 1) {
                $this->altStr .= strtoupper($this->inStr[$i]);
            } else {
                $this->altStr.= strtolower($this->inStr[$i]);
            }
        }
            
        return true;
    }

    private function lowerStr() {
        $this->lowStr = strtolower($this->inStr);
        return true;
    }

    private function reverseCaseStr() {
        $this->revCaseStr = strtolower($this->inStr) ^ strtoupper($this->inStr) ^ $this->inStr;
        return true;
    }

}
