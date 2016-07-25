<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Whole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {

// USER
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('confirmation_code');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', array('user', 'admin'));
            $table->enum('gender', array('male', 'female'));
            $table->date('birth_date');
            $table->string('nick_name');
            $table->string('real_name');
            $table->text('img');
            $table->enum('show_as', array('real', 'nick','anonim'));
            $table->tinyInteger('email_notif');//0 or 1
            $table->tinyInteger('auto_accept_follower');//0 or 1
            $table->timestamp('premium_until');
            $table->string('mobile_phone');
            $table->string('viewer');
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });
//ENDUSER

//notif
        Schema::create('notif', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('activity_id')->unsigned()->nullable();
            $table->string('activity_id_type')->nullable();
            $table->text('activity_remark');//remark buat nentuin

            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('parent_id_type')->nullable();
            $table->text('parent_remark');//remark buat nentuin
   
            $table->enum('flag', array('seen', 'unseen'));

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id','u_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

//end notif

//badwords
        Schema::create('badwords', function (Blueprint $table) {
            $table->increments('id');

            $table->string('word');
            $table->string('replace_to');

            $table->timestamps();
            $table->softDeletes();
        });

//end notif


//FOLLOW
         Schema::create('follow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('follow_user_id')->unsigned();
            $table->timestamp('accepted_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id','u_id');
            $table->index('follow_user_id','f_u_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follow_user_id')->references('id')->on('users')->onDelete('cascade');
        });
//ENDFOLLOW


//POSTING

        //hashtags
        Schema::create('tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag_name');
            $table->timestamps();
            $table->softDeletes();
        });

        //header
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type', array('artikel', 'rating', 'debat'));
            $table->string('title');
            $table->text('header_content');
            //general itu default, reported itu udah pernah di report, safe itu sudah dipastikan admin bahwa itu aman.
            $table->enum('status', array('general', 'reported', 'safe'));
            $table->tinyInteger('lock_by_admin');

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id','u_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

            //post hastag
            Schema::create('post_tag', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_id')->unsigned();
                $table->integer('tag_id')->unsigned();
                $table->timestamps();
                $table->softDeletes();

                $table->index('post_id','p_id');
                $table->index('tag_id','t_id');
                $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
                $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');
            });

            //post detail
            Schema::create('post_detail', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_id')->unsigned();
                $table->enum('type', array('youtube', 'url', 'text', 'image'));
                $table->text('content'); //url isinya url, article isinya artikel2. foto ya isinya foto
                $table->string('extension');
                $table->text('description');

                $table->timestamps();
                $table->softDeletes();

                $table->index('post_id','p_id');
                $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
            });
            //post flag
            Schema::create('post_flag', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->integer('post_id')->unsigned();
                $table->enum('flag_type', array('like', 'dislike', 'report'));
                $table->text('reason');

                $table->timestamps();
                $table->softDeletes();

                $table->index('user_id','u_id');
                $table->index('post_id','p_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
            });


            //post KUBU
            Schema::create('post_kubu', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_id')->unsigned();
                $table->string('label');
                $table->text('description'); //url isinya url, article isinya artikel2. foto ya isinya foto
                $table->string('position');

                $table->timestamps();
                $table->softDeletes();

                $table->index('post_id','p_id');
                $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
            });

            //post Subscribe
            Schema::create('post_subscribe', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_id')->unsigned();
                $table->integer('user_id')->unsigned();

                $table->timestamps();
                
                $table->index('user_id','u_id');
                $table->index('post_id','p_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
            });

            //reply kubu
            Schema::create('reply_kubu', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_kubu_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->text('text'); //url isinya url, article isinya artikel2. foto ya isinya foto
                //general itu default, reported itu udah pernah di report, safe itu sudah dipastikan admin bahwa itu aman.
                $table->enum('status', array('general', 'reported', 'safe'));

                $table->timestamps();
                $table->softDeletes();

                $table->index('post_kubu_id','p_k_id');
                $table->index('user_id','u_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('post_kubu_id')->references('id')->on('post_kubu')->onDelete('cascade');
            });


            //reply detail
            Schema::create('reply_detail', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('reply_kubu_id')->unsigned();
                $table->enum('type', array('youtube', 'url', 'text', 'image'));
                $table->text('content'); //url isinya url, article isinya artikel2. foto ya isinya foto
                $table->string('extension');
                $table->text('description');

                $table->timestamps();
                $table->softDeletes();

                $table->index('reply_kubu_id','r_k_id');
                $table->foreign('reply_kubu_id')->references('id')->on('reply_kubu')->onDelete('cascade');
            });

            // //reply flag
            Schema::create('reply_flag', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('reply_kubu_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->enum('flag_type', array('like', 'dislike', 'report'));
                $table->text('reason'); 

                $table->timestamps();
                $table->softDeletes();

                $table->index('user_id','u_id');
                $table->index('reply_kubu_id','r_k_id');
                $table->foreign('reply_kubu_id')->references('id')->on('reply_kubu')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
//END POSTING

}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reply_flag');

        Schema::drop('reply_detail');

        Schema::drop('reply_kubu');

        Schema::drop('post_kubu');

        Schema::drop('post_flag');

        Schema::drop('post_detail');

        Schema::drop('post_tag');

        Schema::drop('post_subscribe');

        Schema::drop('post');

        Schema::drop('tag');

        Schema::drop('follow');

        Schema::drop('notif');

         Schema::drop('badwords');

        Schema::drop('users');
    }
}
