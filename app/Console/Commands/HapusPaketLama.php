<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HapusPaketLama extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paket:hapus-lama';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus paket yang sudah diambil lebih dari 30 hari yang lalu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tanggalBatas = Carbon::now()->subDays(30);
        $jumlahDihapus = DB::table('pakets')->where('status', 'sudah diambil')->where('updated_at', '<', $tanggalBatas)->delete();
        $this->info("Berhasil menghapus $jumlahDihapus paket yang sudah diambil lebih dari 30 hari yang lalu.");
    }
}
