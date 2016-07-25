Dear <?php echo e($data->real_name); ?>,<br>

Email ini untuk verifikasi akun dolpini anda, lakukan konfirmasi dengan klik url dibawah ini

<br>

<a href="<?php echo e(url('/user/verifyByUser',[$data->id, $data->confirmation_code])); ?>">Verifikasi Akun saya, Sekarang!</a>


<br><br><br>



-----------DO NOT REPLY THIS EMAIL, THIS IS AUTOMATICALLY SENT BY DOLPINI SYSTEM--------------