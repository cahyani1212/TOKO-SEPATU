<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    protected $telegram;

    // Konstruktor untuk inisialisasi Telegram API
    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    // Method untuk memastikan bot aktif
    public function handle()
    {
        return response()->json(['status' => 'Bot handler is working!']);
    }

    // Method untuk mengirim pesan
    public function sendMessage(Request $request)
    {
        $chatId = $request->input('chat_id'); // ID chat penerima pesan
        $message = $request->input('message'); // Pesan yang akan dikirim

        try {
            $response = $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
            ]);

            return response()->json(['status' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            Log::error('Telegram Bot Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Method untuk mendapatkan pembaruan menggunakan getUpdates
    public function getUpdates(Request $request)
{
    // Ambil ID pembaruan terakhir dari session (atau bisa menggunakan database)
    $lastUpdateId = session('last_update_id', 0);

    try {
        // Ambil pembaruan terbaru dari Telegram
        $updates = $this->telegram->getUpdates([
            'offset' => $lastUpdateId + 1, // Ambil hanya pembaruan baru
            'limit' => 100,                // Batasi jumlah pembaruan
            'timeout' => 1,                // Timeout untuk respon cepat
        ]);

        foreach ($updates as $update) {
            $message = $update['message'] ?? null;

            if ($message) {
                $chatId = $message['chat']['id'];
                $text = $message['text'] ?? '';

                // Logika untuk merespons pesan
                if ($text === '/start') {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Hallo! Selamat datang di bot Upik Cabon Store. Ada yang bisa saya bantu?',
                    ]);
                } else {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Anda mengatakan: $text",
                    ]);
                }
            }

            // Simpan ID terakhir yang diproses ke session
            $lastUpdateId = $update['update_id'];
            session(['last_update_id' => $lastUpdateId]);
        }

        return response()->json(['status' => 'success', 'message' => 'Updates processed successfully!']);
    } catch (\Exception $e) {
        Log::error('Telegram Bot GetUpdates ErrJalankan metode getUpdates menggunakan endpoint API Anda dan tes pengiriman pesan dengan mengetikkan /start.
        or: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

    // Method untuk mengirim pesan otomatis ke semua chat yang ada
    public function sendAutoMessage(Request $request)
    {
        $message = $request->input('message', 'Pesan otomatis dari sistem'); // Pesan default
        $responses = [];

        try {
            $updates = $this->telegram->getUpdates(); // Ambil semua pembaruan terbaru

            foreach ($updates as $update) {
                $chatId = $update['message']['chat']['id'] ?? null;

                if ($chatId) {
                    // Kirim pesan ke setiap chat yang ditemukan
                    $response = $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => $message,
                    ]);

                    $responses[] = [
                        'chat_id' => $chatId,
                        'status' => 'success',
                        'response' => $response,
                    ];
                }
            }

            return response()->json(['status' => 'complete', 'responses' => $responses]);
        } catch (\Exception $e) {
            Log::error('Telegram Bot AutoMessage Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function getMessages(Request $request)
{
    try {
        $updates = $this->telegram->getUpdates();

        foreach ($updates as $update) {
            $message = $update['message'] ?? null;

            if ($message) {
                $chatId = $message['chat']['id'];
                $text = $message['text'] ?? '';

                // Kirim pesan berdasarkan teks
                if ($text === '/start') {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Halo! Selamat datang di bot Upik Cabon store, ada yang bisa kami bantu.',
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Messages processed successfully!']);
    } catch (\Exception $e) {
        Log::error('Telegram Bot Error: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
}
