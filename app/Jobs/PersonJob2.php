<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Faker\Factory;

class PersonJob2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
           $faker = Factory::create();
           $jumlahData = 50;
           for ($i=0; $i < $jumlahData; $i++) { 
               $data = [
                   'nama' => $faker->name,
                   'email' => $faker->unique()->email()
               ];
               \App\Models\PersonFaker::create($data);
           }
       } catch (\Exception $e) {
           Log::error('Failed to generate fake data: ' . $e->getMessage());
           $this->fail($e);
       }
   }
}
