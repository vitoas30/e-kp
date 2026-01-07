<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappChannel
{
    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        return true;
    }

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        // 1. Get Phone Number
        $phone = null;
        if (method_exists($notifiable, 'routeNotificationForWhatsapp')) {
            $phone = $notifiable->routeNotificationForWhatsapp($notification);
        } elseif (isset($notifiable->phone)) { 
             $phone = $notifiable->phone;
        }

        // 2. Format Phone Number (08xx -> 628xx)
        if ($phone) {
             $phone = preg_replace('/[^0-9]/', '', $phone); // Remove non-numeric
             if (str_starts_with($phone, '08')) {
                 $phone = '62' . substr($phone, 1);
             }
        }

        if (!$phone) {
            Log::warning("Whatsapp Channel: No phone number found for user.");
            return;
        }

        // 3. Get Notification Content
        if (method_exists($notification, 'toWhatsapp')) {
            $message = $notification->toWhatsapp($notifiable);
        } else {
             $data = $notification->toArray($notifiable);
             $title = $data['title'] ?? 'Notification';
             $body = $data['message'] ?? '';
             $url = $data['url'] ?? '';
             
             $message = "*$title*\n\n$body";
             if ($url) {
                 $message .= "\n\nLink: $url";
             }
        }

        // 4. Send via Fonnte API (Free Tier Friendly)
        try {
            $token = trim(env('FONNTE_TOKEN')); 

            if (!$token) {
                Log::warning("Whatsapp Channel: FONNTE_TOKEN is missing in .env");
                return;
            }

            Log::info("Whatsapp Channel: Attempting to send to $phone with token " . substr($token, 0, 5) . "...");

            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', // Optional, default is 62
            ]);

            if ($response->successful()) {
                Log::info("Whatsapp Channel: Success! Response: " . $response->body());
            } else {
                Log::error("Whatsapp Channel: API Error. Status: " . $response->status() . " Body: " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("Whatsapp Channel Exception: " . $e->getMessage());
        }
    }
}
