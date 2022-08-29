### Command 


```php 

$ php artisan || php artisan --list
$ php artisan make:command UserListCommand

created a new command file : ./app/Console/Commands/UserListCommand.php

<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


/**
 *
*/
class UserListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list';


    /**
     * The console command description.
     *
     * @var string
    */
    protected $description = 'List all users from users table';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $headers = ["ID", "Name", "Email"];

        $users = User::select('id', 'name', 'email')->get();

        $this->table($headers, $users);

    }
}


Registration command UserListCommand in console Kernel :
./app/Console/Kernel.php 


<?php

namespace App\Console;

use App\Console\Commands\UserListCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        UserListCommand::class
    ];


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

$ php artisan --list
$ php artisan users:list

+-----+-----------------------------+----------------------------------+-------------------------------------------------------------------------+
| ID  | Name                        | Email                            |                                                                         |
+-----+-----------------------------+----------------------------------+-------------------------------------------------------------------------+
| 1   | Larry Kreiger               | chegmann@example.net             | https://ui-avatars.com/api/?name=L+K&color=7F9CF5&background=EBF4FF     |
| 2   | Prof. D'angelo Morar        | adolphus95@example.org           | https://ui-avatars.com/api/?name=P+D+M&color=7F9CF5&background=EBF4FF   |
| 3   | Dillan Satterfield          | corwin.eugene@example.org        | https://ui-avatars.com/api/?name=D+S&color=7F9CF5&background=EBF4FF     |
| 4   | Trevor Kertzmann            | sandy34@example.org              | https://ui-avatars.com/api/?name=T+K&color=7F9CF5&background=EBF4FF     |
| 5   | Garry Cummerata             | hoppe.darlene@example.org        | https://ui-avatars.com/api/?name=G+C&color=7F9CF5&background=EBF4FF     |
| 6   | Lucious Price               | maxine.mcclure@example.org       | https://ui-avatars.com/api/?name=L+P&color=7F9CF5&background=EBF4FF     |
| 7   | Emerson Bogisich            | daniela.jacobi@example.com       | https://ui-avatars.com/api/?name=E+B&color=7F9CF5&background=EBF4FF     |
| 8   | Terry D'Amore MD            | daphne.dicki@example.net         | https://ui-avatars.com/api/?name=T+D+M&color=7F9CF5&background=EBF4FF   |
| 9   | Dr. Alicia Pacocha I        | clementine70@example.com         | https://ui-avatars.com/api/?name=D+A+P+I&color=7F9CF5&background=EBF4FF |
| 10  | Morton Breitenberg DDS      | hkoch@example.org                | https://ui-avatars.com/api/?name=M+B+D&color=7F9CF5&background=EBF4FF   |
| 11  | Ethyl Hoppe                 | margot92@example.net             | https://ui-avatars.com/api/?name=E+H&color=7F9CF5&background=EBF4FF     |
| 12  | Prof. Deven Little          | pearlie.kshlerin@example.com     | https://ui-avatars.com/api/?name=P+D+L&color=7F9CF5&background=EBF4FF   |
| 13  | Dr. Helmer Ryan             | weissnat.modesta@example.com     | https://ui-avatars.com/api/?name=D+H+R&color=7F9CF5&background=EBF4FF   |
| 14  | Dr. Lindsey Carter          | elenor30@example.net             | https://ui-avatars.com/api/?name=D+L+C&color=7F9CF5&background=EBF4FF   |
| 15  | Hal Lockman IV              | rcummings@example.com            | https://ui-avatars.com/api/?name=H+L+I&color=7F9CF5&background=EBF4FF   |
| 16  | Dr. Caleb Kertzmann Jr.     | bratke@example.net               | https://ui-avatars.com/api/?name=D+C+K+J&color=7F9CF5&background=EBF4FF |
| 17  | Christina Koss              | dorris90@example.org             | https://ui-avatars.com/api/?name=C+K&color=7F9CF5&background=EBF4FF     |
| 18  | Miss Arlene Oberbrunner PhD | yolson@example.com               | https://ui-avatars.com/api/?name=M+A+O+P&color=7F9CF5&background=EBF4FF |
| 19  | Davonte Ankunding           | athena.heidenreich@example.net   | https://ui-avatars.com/api/?name=D+A&color=7F9CF5&background=EBF4FF     |
| 20  | Dr. Wyman Cole              | fletcher.tremblay@example.net    | https://ui-avatars.com/api/?name=D+W+C&color=7F9CF5&background=EBF4FF   |
| 21  | Bettye Daugherty V          | fsauer@example.net               | https://ui-avatars.com/api/?name=B+D+V&color=7F9CF5&background=EBF4FF   |
| 22  | Mandy Gaylord               | mathilde.daugherty@example.com   | https://ui-avatars.com/api/?name=M+G&color=7F9CF5&background=EBF4FF     |
| 23  | Dr. Hassan Bauch            | bridget07@example.com            | https://ui-avatars.com/api/?name=D+H+B&color=7F9CF5&background=EBF4FF   |
| 24  | Juliet Fritsch              | lockman.verda@example.org        | https://ui-avatars.com/api/?name=J+F&color=7F9CF5&background=EBF4FF     |
| 25  | Stan Metz                   | elisabeth67@example.com          | https://ui-avatars.com/api/?name=S+M&color=7F9CF5&background=EBF4FF     |
| 26  | Rahsaan Feest               | chase.windler@example.net        | https://ui-avatars.com/api/?name=R+F&color=7F9CF5&background=EBF4FF     |
| 27  | Guiseppe Beahan             | hassie.witting@example.org       | https://ui-avatars.com/api/?name=G+B&color=7F9CF5&background=EBF4FF     |
| 28  | Thea Jast PhD               | serena.kirlin@example.com        | https://ui-avatars.com/api/?name=T+J+P&color=7F9CF5&background=EBF4FF   |
| 29  | Mr. Virgil Langworth        | nturner@example.org              | https://ui-avatars.com/api/?name=M+V+L&color=7F9CF5&background=EBF4FF   |
| 30  | Dr. Jaclyn Prosacco         | olin.mcdermott@example.org       | https://ui-avatars.com/api/?name=D+J+P&color=7F9CF5&background=EBF4FF   |
| 31  | Dr. Darian Weber            | bethany78@example.com            | https://ui-avatars.com/api/?name=D+D+W&color=7F9CF5&background=EBF4FF   |
| 32  | Afton Steuber               | ruth14@example.org               | https://ui-avatars.com/api/?name=A+S&color=7F9CF5&background=EBF4FF     |
| 33  | Brayan Zemlak               | cmcdermott@example.net           | https://ui-avatars.com/api/?name=B+Z&color=7F9CF5&background=EBF4FF     |
| 34  | Verda Skiles                | alberta24@example.net            | https://ui-avatars.com/api/?name=V+S&color=7F9CF5&background=EBF4FF     |
| 35  | Monte Keebler               | bradtke.hershel@example.org      | https://ui-avatars.com/api/?name=M+K&color=7F9CF5&background=EBF4FF     |
| 36  | Prof. Jennings Abbott IV    | john75@example.org               | https://ui-avatars.com/api/?name=P+J+A+I&color=7F9CF5&background=EBF4FF |
| 37  | Prof. Meda Hill Jr.         | bahringer.verdie@example.net     | https://ui-avatars.com/api/?name=P+M+H+J&color=7F9CF5&background=EBF4FF |
| 38  | Cletus Lowe                 | russel.charlie@example.com       | https://ui-avatars.com/api/?name=C+L&color=7F9CF5&background=EBF4FF     |
| 39  | Prof. Tyree Leannon II      | tmaggio@example.net              | https://ui-avatars.com/api/?name=P+T+L+I&color=7F9CF5&background=EBF4FF |
| 40  | Hailee Bahringer            | asia31@example.org               | https://ui-avatars.com/api/?name=H+B&color=7F9CF5&background=EBF4FF     |
| 41  | Mrs. Nedra Langosh          | bruce.lindgren@example.com       | https://ui-avatars.com/api/?name=M+N+L&color=7F9CF5&background=EBF4FF   |
| 42  | Danny Beier                 | bonita.schoen@example.com        | https://ui-avatars.com/api/?name=D+B&color=7F9CF5&background=EBF4FF     |
| 43  | Ayden Rippin                | kmayer@example.net               | https://ui-avatars.com/api/?name=A+R&color=7F9CF5&background=EBF4FF     |
| 44  | Alexandria Grant DDS        | gail.rolfson@example.net         | https://ui-avatars.com/api/?name=A+G+D&color=7F9CF5&background=EBF4FF   |
| 45  | Hermann Stracke             | agnes.frami@example.net          | https://ui-avatars.com/api/?name=H+S&color=7F9CF5&background=EBF4FF     |
| 46  | Lilla O'Connell             | sharris@example.com              | https://ui-avatars.com/api/?name=L+O&color=7F9CF5&background=EBF4FF     |
| 47  | Dr. Harvey Powlowski PhD    | emmy25@example.net               | https://ui-avatars.com/api/?name=D+H+P+P&color=7F9CF5&background=EBF4FF |
| 48  | Carlotta Gislason           | kamren.howell@example.org        | https://ui-avatars.com/api/?name=C+G&color=7F9CF5&background=EBF4FF     |
| 49  | Cordell Cremin              | harvey.kathryn@example.org       | https://ui-avatars.com/api/?name=C+C&color=7F9CF5&background=EBF4FF     |
| 50  | Erling Dibbert              | ortiz.rhea@example.com           | https://ui-avatars.com/api/?name=E+D&color=7F9CF5&background=EBF4FF     |
| 51  | Prof. Brannon Grimes        | uprosacco@example.org            | https://ui-avatars.com/api/?name=P+B+G&color=7F9CF5&background=EBF4FF   |
| 52  | Thea Kautzer III            | raheem36@example.net             | https://ui-avatars.com/api/?name=T+K+I&color=7F9CF5&background=EBF4FF   |
| 53  | Sarah Cruickshank           | savanna69@example.com            | https://ui-avatars.com/api/?name=S+C&color=7F9CF5&background=EBF4FF     |
| 54  | Oma Beer DDS                | lubowitz.tristian@example.com    | https://ui-avatars.com/api/?name=O+B+D&color=7F9CF5&background=EBF4FF   |
| 55  | Zoie Herzog                 | josephine.deckow@example.org     | https://ui-avatars.com/api/?name=Z+H&color=7F9CF5&background=EBF4FF     |
| 56  | Prof. Neha Ondricka V       | jeremy.lesch@example.net         | https://ui-avatars.com/api/?name=P+N+O+V&color=7F9CF5&background=EBF4FF |
| 57  | Jon Haley                   | schulist.stephany@example.com    | https://ui-avatars.com/api/?name=J+H&color=7F9CF5&background=EBF4FF     |
| 58  | Chadrick Maggio             | eladio.lueilwitz@example.net     | https://ui-avatars.com/api/?name=C+M&color=7F9CF5&background=EBF4FF     |
| 59  | Greta Mayert                | johanna25@example.net            | https://ui-avatars.com/api/?name=G+M&color=7F9CF5&background=EBF4FF     |
| 60  | Mr. Aidan Konopelski        | ilarkin@example.org              | https://ui-avatars.com/api/?name=M+A+K&color=7F9CF5&background=EBF4FF   |
| 61  | Prof. Lesley Gibson V       | roy.luettgen@example.com         | https://ui-avatars.com/api/?name=P+L+G+V&color=7F9CF5&background=EBF4FF |
| 62  | Haley Stiedemann            | labadie.samanta@example.com      | https://ui-avatars.com/api/?name=H+S&color=7F9CF5&background=EBF4FF     |
| 63  | Mr. Jameson Schiller        | bonita78@example.net             | https://ui-avatars.com/api/?name=M+J+S&color=7F9CF5&background=EBF4FF   |
| 64  | Albertha Gulgowski          | florida43@example.com            | https://ui-avatars.com/api/?name=A+G&color=7F9CF5&background=EBF4FF     |
| 65  | Harley Botsford             | rosenbaum.micah@example.net      | https://ui-avatars.com/api/?name=H+B&color=7F9CF5&background=EBF4FF     |
| 66  | Walter Schuster             | chad.oreilly@example.net         | https://ui-avatars.com/api/?name=W+S&color=7F9CF5&background=EBF4FF     |
| 67  | Mr. Tracey Yundt V          | vweimann@example.org             | https://ui-avatars.com/api/?name=M+T+Y+V&color=7F9CF5&background=EBF4FF |
| 68  | Malcolm Witting             | hglover@example.net              | https://ui-avatars.com/api/?name=M+W&color=7F9CF5&background=EBF4FF     |
| 69  | Loyal Wiegand               | paucek.annette@example.com       | https://ui-avatars.com/api/?name=L+W&color=7F9CF5&background=EBF4FF     |
| 70  | Mr. Joey Koelpin            | hermina.lockman@example.net      | https://ui-avatars.com/api/?name=M+J+K&color=7F9CF5&background=EBF4FF   |
| 71  | Wilhelmine Nienow           | mann.dayana@example.org          | https://ui-avatars.com/api/?name=W+N&color=7F9CF5&background=EBF4FF     |
| 72  | Bridget Feeney              | bsauer@example.com               | https://ui-avatars.com/api/?name=B+F&color=7F9CF5&background=EBF4FF     |
| 73  | Jana Waters Sr.             | vmurray@example.com              | https://ui-avatars.com/api/?name=J+W+S&color=7F9CF5&background=EBF4FF   |
| 74  | Mavis Hermiston             | grohan@example.net               | https://ui-avatars.com/api/?name=M+H&color=7F9CF5&background=EBF4FF     |
| 75  | Philip Balistreri           | leonard84@example.com            | https://ui-avatars.com/api/?name=P+B&color=7F9CF5&background=EBF4FF     |
| 76  | Jevon Kreiger               | fkuhn@example.org                | https://ui-avatars.com/api/?name=J+K&color=7F9CF5&background=EBF4FF     |
| 77  | Reanna Schaefer             | bartoletti.catharine@example.org | https://ui-avatars.com/api/?name=R+S&color=7F9CF5&background=EBF4FF     |
| 78  | Brando Schaden              | everett13@example.net            | https://ui-avatars.com/api/?name=B+S&color=7F9CF5&background=EBF4FF     |
| 79  | Deron Boyle                 | moshe.miller@example.org         | https://ui-avatars.com/api/?name=D+B&color=7F9CF5&background=EBF4FF     |
| 80  | Romaine Torphy              | boyd53@example.org               | https://ui-avatars.com/api/?name=R+T&color=7F9CF5&background=EBF4FF     |
| 81  | Lera Jast                   | haylee53@example.net             | https://ui-avatars.com/api/?name=L+J&color=7F9CF5&background=EBF4FF     |
| 82  | Maxine Blick MD             | eileen.friesen@example.org       | https://ui-avatars.com/api/?name=M+B+M&color=7F9CF5&background=EBF4FF   |
| 83  | Prof. Jarret Skiles         | lisandro51@example.com           | https://ui-avatars.com/api/?name=P+J+S&color=7F9CF5&background=EBF4FF   |
| 84  | Claudine Ferry              | thea09@example.org               | https://ui-avatars.com/api/?name=C+F&color=7F9CF5&background=EBF4FF     |
| 85  | Zoe Barton                  | gadams@example.net               | https://ui-avatars.com/api/?name=Z+B&color=7F9CF5&background=EBF4FF     |
| 86  | Edward Fritsch              | amayert@example.com              | https://ui-avatars.com/api/?name=E+F&color=7F9CF5&background=EBF4FF     |
| 87  | Dorian Kulas                | drath@example.com                | https://ui-avatars.com/api/?name=D+K&color=7F9CF5&background=EBF4FF     |
| 88  | Adrian Rowe                 | aron97@example.com               | https://ui-avatars.com/api/?name=A+R&color=7F9CF5&background=EBF4FF     |
| 89  | Ivy Torp I                  | lockman.gregg@example.org        | https://ui-avatars.com/api/?name=I+T+I&color=7F9CF5&background=EBF4FF   |
| 90  | Dr. Zachary Paucek I        | angela07@example.org             | https://ui-avatars.com/api/?name=D+Z+P+I&color=7F9CF5&background=EBF4FF |
| 91  | Makenna Ernser              | alejandrin.conn@example.net      | https://ui-avatars.com/api/?name=M+E&color=7F9CF5&background=EBF4FF     |
| 92  | Mr. Mike Corkery Sr.        | xhaag@example.net                | https://ui-avatars.com/api/?name=M+M+C+S&color=7F9CF5&background=EBF4FF |
| 93  | Kallie D'Amore              | rvonrueden@example.org           | https://ui-avatars.com/api/?name=K+D&color=7F9CF5&background=EBF4FF     |
| 94  | Dr. Jaron Greenfelder DVM   | spencer.elda@example.org         | https://ui-avatars.com/api/?name=D+J+G+D&color=7F9CF5&background=EBF4FF |
| 95  | Mrs. Maureen Cremin Sr.     | brandy.veum@example.com          | https://ui-avatars.com/api/?name=M+M+C+S&color=7F9CF5&background=EBF4FF |
| 96  | Mr. Joe Bednar PhD          | wheidenreich@example.net         | https://ui-avatars.com/api/?name=M+J+B+P&color=7F9CF5&background=EBF4FF |
| 97  | Dr. Dora Effertz III        | christina.cummings@example.org   | https://ui-avatars.com/api/?name=D+D+E+I&color=7F9CF5&background=EBF4FF |
| 98  | Regan Ernser MD             | art.gislason@example.net         | https://ui-avatars.com/api/?name=R+E+M&color=7F9CF5&background=EBF4FF   |
| 99  | Aubree Gleason              | levi.swaniawski@example.net      | https://ui-avatars.com/api/?name=A+G&color=7F9CF5&background=EBF4FF     |
| 100 | Delia Cruickshank           | monahan.sydnee@example.com       | https://ui-avatars.com/api/?name=D+C&color=7F9CF5&background=EBF4FF     |
| 101 | Nayeli McGlynn              | zruecker@example.org             | https://ui-avatars.com/api/?name=N+M&color=7F9CF5&background=EBF4FF     |
| 102 | Maude Boehm                 | greenfelder.sienna@example.com   | https://ui-avatars.com/api/?name=M+B&color=7F9CF5&background=EBF4FF     |
| 103 | Ashleigh Schmidt DDS        | humberto.crona@example.net       | https://ui-avatars.com/api/?name=A+S+D&color=7F9CF5&background=EBF4FF   |
| 104 | Prof. Yvette Von            | fmueller@example.net             | https://ui-avatars.com/api/?name=P+Y+V&color=7F9CF5&background=EBF4FF   |
| 105 | Prof. Brook Dibbert         | stewart.wintheiser@example.org   | https://ui-avatars.com/api/?name=P+B+D&color=7F9CF5&background=EBF4FF   |
| 106 | Raul Keebler                | arely.jakubowski@example.org     | https://ui-avatars.com/api/?name=R+K&color=7F9CF5&background=EBF4FF     |
| 107 | Arno Strosin                | mafalda71@example.net            | https://ui-avatars.com/api/?name=A+S&color=7F9CF5&background=EBF4FF     |
| 108 | Elfrieda Bosco              | friesen.van@example.net          | https://ui-avatars.com/api/?name=E+B&color=7F9CF5&background=EBF4FF     |
| 109 | Prof. Landen Jacobson PhD   | goodwin.trisha@example.org       | https://ui-avatars.com/api/?name=P+L+J+P&color=7F9CF5&background=EBF4FF |
| 110 | Kathryne Flatley PhD        | lindgren.pablo@example.org       | https://ui-avatars.com/api/?name=K+F+P&color=7F9CF5&background=EBF4FF   |
+-----+-----------------------------+----------------------------------+-------------------------------------------------------------------------+


===================================================================

Command with argument

<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


/**
 *
*/
class UserListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list {id}'; // argument name "id"


    /**
     * The console command description.
     *
     * @var string
    */
    protected $description = 'List all users from users table';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $headers = ["ID", "Name", "Email"];

        $users = User::select('id', 'name', 'email')->where('id', $this->argument('id'))->get();

        $this->table($headers, $users);

    }
}


Find user by ID (Example id=2 argument)
$ php artisan users:list 2

+----+----------------------+------------------------+-----------------------------------------------------------------------+
| ID | Name                 | Email                  |                                                                       |
+----+----------------------+------------------------+-----------------------------------------------------------------------+
| 2  | Prof. D'angelo Morar | adolphus95@example.org | https://ui-avatars.com/api/?name=P+D+M&color=7F9CF5&background=EBF4FF |
+----+----------------------+------------------------+-----------------------------------------------------------------------+

Find user by ID (Example id=25 argument)
$ php artisan users:list 25
+----+-----------+-------------------------+---------------------------------------------------------------------+
| ID | Name      | Email                   |                                                                     |
+----+-----------+-------------------------+---------------------------------------------------------------------+
| 25 | Stan Metz | elisabeth67@example.com | https://ui-avatars.com/api/?name=S+M&color=7F9CF5&background=EBF4FF |
+----+-----------+-------------------------+---------------------------------------------------------------------+



```
