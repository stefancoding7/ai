<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use OpenAI\Laravel\Facades\OpenAI;

class TestAiSelf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-ai-self';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'write me good book title',
        ]);

        echo $result['choices'][0]['text']; 
    }
}
