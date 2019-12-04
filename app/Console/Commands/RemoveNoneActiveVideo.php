<?php

namespace App\Console\Commands;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveNoneActiveVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemoveNoneActiveVideo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command To Remove None Active Video';

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
     * @return mixed
     */
    public function handle()
    {
        $expDate = Carbon::now()->subDays(30);

        $videos = Video::where("view_count", 0)->where('created_at', "<", $expDate)->get();
        foreach ($videos as $video) {
            $video->delete();
        }
    }
}
