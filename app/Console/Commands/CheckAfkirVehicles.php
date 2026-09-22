<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BankData; // Pastikan ini disesuaikan dengan nama Model Anda
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AfkirNotificationMail;

class CheckAfkirVehicles extends Command
{
    protected $signature = 'afkir:check';
    protected $description = 'Cek armada yang mendekati masa afkir dan kirim notifikasi email';

    public function handle()
    {
        $semuaArmada = BankData::where('aktif_tidak_aktif', 'Aktif')
            ->whereNotNull('transportir')
            ->where('transportir', '!=', '')
            ->get();
            
        $armadaMendekatiAfkir = [];

        foreach ($semuaArmada as $armada) {
            $statusTrailer = $armada->peringatan_afkir_trailer['class'] ?? 'success';
            $statusHead = $armada->peringatan_afkir_head['class'] ?? 'success';

            if (in_array($statusTrailer, ['warning', 'danger']) || in_array($statusHead, ['warning', 'danger'])) {
                $armadaMendekatiAfkir[] = $armada;
            }
        }

        if (count($armadaMendekatiAfkir) > 0) {
            $users = User::all();
            
            foreach ($users as $user) {
                Mail::to($user->email)->send(new AfkirNotificationMail($armadaMendekatiAfkir));
            }

            $this->info('Notifikasi email berhasil dikirim.');
        } else {
            $this->info('Tidak ada armada yang mendekati afkir di tabel Bank Data.');
        }
    }
}