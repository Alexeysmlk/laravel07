<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HomeworkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:random {first=0} {last=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes a random number that needs to be guessed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $firstNumber = $this->argument('first');
        $lastNumber = $this->argument('last');
        $this->newLine();
        $this->question('This is a game with random numbers. You need to guess a random number from ' . $firstNumber
            . ' to ' . $lastNumber);
        $checkConfirm = $this->confirm('Do you want to change the choice of numbers?');
        if ($checkConfirm) {
            $firstNumber = $this->ask('What will be the first number?');
            $lastNumber = $this->ask('What will be the last number?');
            $this->line('Now you need to guess the number from ' . $firstNumber . ' to ' . $lastNumber);
        }
        $randomNumber = rand($firstNumber, $lastNumber);

        $number = $this->ask('What\'s your first guess?');
        while ($number != $randomNumber) {
            if ($number - $randomNumber < 0) {
                $this->warn('Your number is less than random number');
            } else {
                $this->warn('Your number is more than random number');
            }
            $number = $this->ask('Try again');
        }
        $this->question('Uh-huh! You guessed the number! Congratulations!');
        return Command::SUCCESS;
    }
}
