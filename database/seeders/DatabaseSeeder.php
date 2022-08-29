<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('secret'),
        ]);
        
        \App\Models\Blog::create([
            'title' => 'My First Blog',
            'content' => '<div><b><font face="Arial" size="6">HOMEMADE BOBA TEA</font></b></div><div><b><font face="Arial" size="4"><br></font></b></div><div><font face="Arial" size="4">I’m a huge fan of of <u>Taiwanese</u> tea-based <i>boba (bubble)</i> milk tea, It’s the perfect afternoon pick me up on a warm day. A homemade <i>boba</i> milk tea chilled with those chewy, sweet tapioca balls is <b>SO YUM!</b> It’s addicting.&nbsp;</font></div><div><font face="Arial" size="4"><br></font></div><div><font face="Arial" size="4"><a href="https://sayyes.com/" style="">Read More</a></font></div>',
        ]);
    }
}
