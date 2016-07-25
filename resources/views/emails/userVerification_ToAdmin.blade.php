Dear Admin,<br>

Ada akun baru dengan nick_name {{$data->nick_name}} ({{$data->real_name}}), jika mau langsung melakukan konfirmasi, klik link dibawah ini.

<br>

<a href="{{url('/user/verifyByUser',[$data->id, $data->confirmation_code])}}">Verifikasi Akun nya, Sekarang!</a>


<br><br><br>



-----------DO NOT REPLY THIS EMAIL, THIS IS AUTOMATICALLY SENT BY DOLPINI SYSTEM--------------