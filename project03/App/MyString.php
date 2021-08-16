<?php
namespace App;

class MyString
{
    public function __construct(
        private string $str = ''
    ) {}

    public function rebuild(String $str)
    {
        $this->str = $str;

        $this->checkFirstOfString();
        $this->makeSpace();
        $this->makeCoefficientOne();

        return $this->str;
    }

    private function checkFirstOfString() 
    {
        if (
            $this->str[0] != '-' && 
            $this->str[0] != '+'
            ){
            $this->str = '+' . $this->str;
        } 
    }

    private function makeSpace() 
    {
        $this->str = str_replace(['-', '+'], [' -', ' +'], $this->str);
    }

    private function makeCoefficientOne() 
    {
        $this->str = str_replace(['-x', '+x'], ['-1x', '+1x'], $this->str);
    }
}