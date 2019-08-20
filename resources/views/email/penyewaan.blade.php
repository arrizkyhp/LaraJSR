<table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
  <tr>
    <td align="center">

      <table border="0" cellspacing="0" cellpadding="0">
           <tr>
             <br>
             <center>
                <td>
                    <br>
                    <div align="center">
                    <img class="align-content" align="center"  src="{{ asset('front/img/logo.png') }}" width="180px" >
                    </div>
                    <hr>
                </td>
            </center>
        </tr>
        <tr>
          <center><td><p>Hallo {{ $penyewaan->pelanggan->nama_pelanggan }}</p></td></center>
        </tr>
         <tr>
          <center><td><p>Terima Kasih Sudah Menggunakan Jasa Catering Jembar Sari Rasa <br>Berikut ini Nota Penyewaan anda :</p></td></center><br>



        </tr>

      </table>
       <table border="0" cellspacing="0" cellpadding="0">
                 <tr>
                     <br>
                    <center><td align="center" style="border-radius: 3px;" bgcolor="#28a745"><a href="{{ route('sewa.print',$penyewaan->id_penyewaan)  }}" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; text-decoration: none;border-radius: 3px; padding: 12px 18px; border: 0px solid #e9703e; display: inline-block;">Cek Nota &rarr;</a></td></center>
                </tr>
        </table>
    </td>
  </tr>
</table>

