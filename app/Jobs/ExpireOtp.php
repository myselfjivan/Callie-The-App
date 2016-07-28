<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpireOtp extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(expireUserOtp $request) {
        //
        $enterdMobile = $request->get('mobile');
        try {
            $otps = \App\Otp::where('mobile', $enterdMobile)->get();
            foreach ($otps as $otp) {
                $otp->otp = NULL;
            }
            if ($otp->save())
                return $otp;
            else {
                return $this->response->error('error_job_failed_could_not_flush_otp', 500);
            }
        } catch (\PDOException $e) {
            return $e;
        }
    }

}
