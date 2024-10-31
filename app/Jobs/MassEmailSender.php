<?php

namespace App\Jobs;

use App\Mail\TestEmail;
use App\Traits\SendEmailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MassEmailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SendEmailTrait;

    private $bitacora_id;
    private $data;
    private $subject;
    private $to;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$bitacora_id,$subject,$to)
    {
        $this->data = $data;
        $this->bitacora_id = $bitacora_id;
        $this->subject = $subject;
        $this->to = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendBrevoEmail($this->data,$this->bitacora_id,$this->subject,$this->to);
    }

}
