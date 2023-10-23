<?php

namespace App\Console\Commands;

use App\Jobs\BalanceJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class BalanceUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance {email : E-mail} {amount : Сумма списания/пополнения} {description : Описание}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Списание или пополнения счета пользователя';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $validator = Validator::make($this->arguments(), [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'amount' => ['required', 'numeric'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $this->error('Whoops! The given options are invalid.');

            collect($validator->errors()->all())
                ->each(fn($error) => $this->line($error));
            exit;
        }

        BalanceJob::dispatch($this->arguments());
    }
}
