<?php

namespace App\Jobs;

use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class BalanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected array $arguments)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->arguments['email'];
        $amount = $this->arguments['amount'];
        $description = $this->arguments['description'];

        DB::transaction(static function () use ($description, $amount, $email) {

            $user = User::where('email', $email)->first();
            $balance = Balance::where('user_id' , $user?->id)->lockForUpdate()->first();

            if (!$balance || $balance->balance + $amount < 0) {
                return;
            }

            $balance->balance += $amount;
            $balance->save();

            Transaction::create([
                'balance_id'  => $user->balance->id,
                'description' => $description,
                'amount'      => $amount,
                'balance'     => $balance->balance,
            ]);
        });
    }
}
