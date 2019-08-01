<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Pesanan;
use App\Penyewaan;

class EmailController extends Controller
{
    public function kirimEmail($id)
    {

        $data['pesanan'] = Pesanan::findOrFail($id);
        $email = Pesanan::where('id_pesanan', $id)->first();


        Mail::send('email.pesanan', $data, function ($message) use ($email, $id) {
            $message->subject('Nota Pesanan', $id);
            $message->from('hello@arrizkyhp.id', 'Jembar Sari Rasa');
            $message->to($email->pelanggan->email);
        });
        alert()->success('Berhasil ', 'Email Berhasil dikirim')->persistent(' Close ');
        return redirect()->back();
    }

    public function kirimEmailSewa($id)
    {

        $data['penyewaan'] = Penyewaan::findOrFail($id);
        $email = Penyewaan::where('id_penyewaan', $id)->first();


        Mail::send('email.penyewaan', $data, function ($message) use ($email, $id) {
            $message->subject('Nota Penyewaan', $id);
            $message->from('hello@arrizkyhp.id', 'Jembar Sari Rasa');
            $message->to($email->pelanggan->email);
        });
        alert()->success('Berhasil ', 'Email Berhasil dikirim')->persistent(' Close ');
        return redirect()->back();
    }
}