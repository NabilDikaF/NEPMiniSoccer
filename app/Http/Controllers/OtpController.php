<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Mail\OtpRegistrationMail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users,email']
        ], [
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email')
            ], 422);
        }

        $email = $request->email;
        
        // Generate 5-digit OTP
        $otp = rand(10000, 99999);
        
        // Simpan OTP ke Session dengan batas waktu 5 menit (300 detik)
        Session::put('register_otp_' . $email, [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5)
        ]);

        // Kirim email
        try {
            Mail::to($email)->send(new OtpRegistrationMail($otp));
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            // Jika gagal kirim email (misal koneksi SMTP belum diset)
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email OTP. Pastikan email valid atau hubungi admin.' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $email = $request->email;
        $inputOtp = $request->otp;

        $sessionData = Session::get('register_otp_' . $email);

        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi OTP tidak ditemukan atau sudah kedaluwarsa. Silakan minta kode baru.'
            ], 400);
        }

        if (now()->greaterThan($sessionData['expires_at'])) {
            Session::forget('register_otp_' . $email);
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP sudah kedaluwarsa. Silakan minta kode baru.'
            ], 400);
        }

        if ((string)$sessionData['otp'] !== (string)$inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah.'
            ], 400);
        }

        // Jika berhasil
        Session::put('register_otp_verified_' . $email, true);
        Session::forget('register_otp_' . $email); // Hapus OTP yang sudah dipakai

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil diverifikasi!'
        ]);
    }

    public function sendResetOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email']
        ], [
            'email.exists' => 'Email tidak ditemukan di sistem kami.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email')
            ], 422);
        }

        $email = $request->email;
        $otp = rand(10000, 99999);
        
        Session::put('reset_otp_' . $email, [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5)
        ]);

        try {
            Mail::to($email)->send(new \App\Mail\ResetPasswordMail($otp));
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP Reset Password telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email OTP. Pastikan email valid atau hubungi admin.'
            ], 500);
        }
    }

    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $email = $request->email;
        $inputOtp = $request->otp;

        $sessionData = Session::get('reset_otp_' . $email);

        if (!$sessionData) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi OTP tidak ditemukan atau sudah kedaluwarsa. Silakan minta kode baru.'
            ], 400);
        }

        if (now()->greaterThan($sessionData['expires_at'])) {
            Session::forget('reset_otp_' . $email);
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP sudah kedaluwarsa. Silakan minta kode baru.'
            ], 400);
        }

        if ((string)$sessionData['otp'] !== (string)$inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah.'
            ], 400);
        }

        Session::put('reset_otp_verified_' . $email, true);
        Session::forget('reset_otp_' . $email);

        return response()->json([
            'success' => true,
            'message' => 'OTP berhasil diverifikasi! Silakan masukkan password baru Anda.'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 8 karakter.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $email = $request->email;

        if (!Session::get('reset_otp_verified_' . $email)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum memverifikasi OTP untuk email ini.'
            ], 403);
        }

        $user = User::where('email', $email)->first();
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        Session::forget('reset_otp_verified_' . $email);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah. Silakan login kembali.'
        ]);
    }
}
