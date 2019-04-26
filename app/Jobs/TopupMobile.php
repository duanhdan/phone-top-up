<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Model\Topup;

class TopupMobile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $params;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = $this->params;
        //insert topup
        $topup = new Topup($params);
        $topup->save();
        //call api topup
        if(!empty($topup->id)){
            $rand = rand(1,10);
            if($rand % 2 == 0){
                $topup->status = 1;
                $topup->result = 'Nạp tiền thành công';
            } else {
                $topup->status = 2;
                $topup->result = 'Nạp tiền không thành công';
            }

            $topup->save();
        }
    }
}
