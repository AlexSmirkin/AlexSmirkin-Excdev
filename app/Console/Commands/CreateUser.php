<?php

namespace App\Console\Commands;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name : Имя пользователя} {email : E-mail} {password : Пароль}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавление пользователя';

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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->error('Whoops! The given options are invalid.');

            collect($validator->errors()->all())
                ->each(fn($error) => $this->line($error));
            exit;
        }

        $user = User::create([
            'name'     => $this->argument('name'),
            'email'    => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
        ]);

        Balance::create([
            'user_id'     => $user->id,
            'description' => '',
            'balance'     => 0,
        ]);
    }
}
