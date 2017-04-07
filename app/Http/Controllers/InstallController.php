<?php

namespace App\Http\Controllers;

// controllers
use App\Http\Controllers\Controller;
// requests
use App\Http\Requests\install\DatabaseRequest;
use App\Http\Requests\install\InstallerRequest;
use App\User;
use Artisan;
// classes
use Cache;
use Config;
use DB;
use Exception;
use File;
use Hash;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Session;
use View;

/**
 * |=======================================================================
 * |Class: InstallController
 * |=======================================================================.
 *
 *  Class to perform the first install operation without this the database
 *  settings could not be started
 *
 *  @author     Ramesh <rameshsrinivasanbe@gmail.com>
 */
class InstallController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Get Licence (step 1).
     *
     * @return type view
     */
    public function licence()
    {
        // checking if the installation is running for the first time or not
        $directory = base_path();
        if (file_exists($directory.DIRECTORY_SEPARATOR.'.env')) {
            return redirect('login');
        } else {
            Session::forget('step1');
            Session::forget('step2');
            Session::forget('step3');
            Session::forget('step4');
            Session::forget('step5');
            Session::forget('step6');
            Artisan::call('config:clear');

            return view('installer/page/view1');
        }
    }

    /**
     * Post Licencecheck.
     *
     * @return type view
     */
    public function licencecheck(Request $request)
    {
        // checking if the user have accepted the licence agreement
        $accept = (Input::has('accept1')) ? true : false;
        if ($accept == 'accept') {
            Session::put('step1', 'step1');

            return Redirect::route('prerequisites');
        } else {
            return Redirect::route('licence')->with('fails', 'Failed! first accept the licence agreeement');
        }
    }

    /**
     * Get prerequisites (step 2).
     *
     * Checking the extensions enabled required for installing the Laravel
     * without which the project cannot be executed properly
     *
     * @return type view
     */
    public function prerequisites(Request $request)
    {
        // checking if the installation is running for the first time or not
        if (Session::get('step1') == 'step1') {
            return View::make('installer/page/view2');
        } else {
            return Redirect::route('licence');
        }
    }

    /**
     * Post Prerequisitescheck
     * checking prerequisites.
     *
     * @return type view
     */
    public function prerequisitescheck(Request $request)
    {
        Session::put('step2', 'step2');

        return Redirect::route('configuration');
    }

    /**
     * Get Localization (step 3)
     * Requesting user recomended settings for installation.
     *
     * @return type view
     */
    public function localization(Request $request)
    {
        // checking if the installation is running for the first time or not
        if (Session::get('step2') == 'step2') {
            return View::make('installer/page/view3');
        } else {
            return Redirect::route('prerequisites');
        }
    }

    /**
     * Post localizationcheck
     * checking prerequisites.
     *
     * @return type view
     */
    // public function localizationcheck(Request $request)
    // {
    //     Session::put('step3', 'step3');

    //     $request->session()->put('step3', 'step3');
    //     $request->session()->put('language', Input::get('language'));
    //     $request->session()->put('timezone', Input::get('timezone'));
    //     $request->session()->put('date', Input::get('date'));
    //     $request->session()->put('datetime', Input::get('datetime'));

    //     return Redirect::route('configuration');
    // }

    /**
     * Get Configuration (step 4)
     * checking prerequisites.
     *
     * @return type view
     */
    public function configuration(Request $request)
    {
        // checking if the installation is running for the first time or not
        if (Session::get('step2') == 'step2') {
            return View::make('installer/page/view3');
        } else {
            return Redirect::route('prerequisites');
        }
    }

    /**
     * Post configurationcheck
     * checking prerequisites.
     *
     * @return type view
     */
    public function configurationcheck(DatabaseRequest $request)
    {
        Session::put('step4', 'step4');
        Session::set('default', $request->input('default'));
        Session::set('host', $request->input('host'));
        Session::set('databasename', $request->input('databasename'));
        Session::set('username', $request->input('username'));
        Session::set('password', $request->input('password'));
        Session::set('port', $request->input('port'));

        return Redirect::route('database');
    }

    /**
     * postconnection.
     *
     * @return type view
     */
    public function postconnection(Request $request)
    {
        error_reporting(E_ALL & ~E_NOTICE);
        $default = Input::get('default');
        $host = Input::get('host');
        $database = Input::get('databasename');
        $dbusername = Input::get('username');
        $dbpassword = Input::get('password');
        $port = Input::get('port');

        $ENV['APP_NAME'] = 'Boiler';
        $ENV['APP_ENV'] = 'local';
        $ENV['APP_DEBUG'] = 'true';
        $ENV['APP_KEY'] = '5BHpdLDxwB9DD85i2WsmV9AuDouRSfk3';
        $ENV['APP_BUGSNAG'] = 'true';
        $ENV['APP_URL'] = 'http://localhost/boiler/public/';
        $ENV['DB_INSTALL'] = '%0%';
        $ENV['DB_CONNECTION'] = $default;
        $ENV['DB_HOST'] = $host;
        $ENV['DB_PORT'] = $port;
        $ENV['DB_DATABASE'] = $database;
        $ENV['DB_USERNAME'] = $dbusername;
        $ENV['DB_PASSWORD'] = $dbpassword;
        $ENV['MAIL_DRIVER'] = 'smtp';
        $ENV['MAIL_HOST'] = 'smtp.mailgun.org';
        $ENV['MAIL_PORT'] = '587';
        $ENV['MAIL_USERNAME'] = 'null';
        $ENV['MAIL_PASSWORD'] = 'null';
        $ENV['MAILGUN_SECRET'] = 'null';
        $ENV['MAILGUN_DOMAIN'] = 'null';
        $ENV['CACHE_DRIVER'] = 'array';
        $ENV['SESSION_DRIVER'] = 'file';
        $ENV['QUEUE_DRIVER'] = 'sync';

        $config = '';
        foreach ($ENV as $key => $val) {
            $config .= "{$key}={$val}\n";
        }
        // Write environment file
        $fp = fopen(base_path().DIRECTORY_SEPARATOR.'example.env', 'w');
        fwrite($fp, $config);
        fclose($fp);
        rename(base_path().DIRECTORY_SEPARATOR.'example.env', base_path().DIRECTORY_SEPARATOR.'.env');

        return 1;
    }

    /**
     * Get database
     * checking prerequisites.
     *
     * @return type view
     */
    public function database(Request $request)
    {
        // checking if the installation is running for the first time or not
        if (Session::get('step4') == 'step4') {
            return View::make('installer/page/view4');
        } else {
            return Redirect::route('configuration');
        }
    }

    /**
     * Get account
     * checking prerequisites.
     *
     * @return type view
     */
    public function account(Request $request)
    {
        // checking if the installation is running for the first time or not
        if (Session::get('step4') == 'step4') {
            $request->session()->put('step5', $request->input('step5'));

            return View::make('installer/page/view5');
        } else {
            return Redirect::route('configuration');
        }
    }

    /**
     * Post accountcheck
     * checking prerequisites.
     *
     * @param type InstallerRequest $request
     *
     * @return type view
     */
    public function accountcheck(Request $request)
    {
        // checking is the installation was done previously
        try {
            $check_for_pre_installation = User::all();
            if ($check_for_pre_installation) {
                rename(base_path().DIRECTORY_SEPARATOR.'.env', base_path().DIRECTORY_SEPARATOR.'example.env');
                Session::put('fails', 'The data in database already exist. Please provide fresh database', 2);
                return redirect()->route('configuration');
            }
        } catch (Exception $e) {
        }
        if ($request->input('dummy-data') == 'on') {
            // $path = base_path().'/DB/dummy-data.sql';
            // DB::unprepared(file_get_contents($path));
        } else {
            // migrate database
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
        }
        // create user
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::create([
            'first_name'   => $firstname,
            'last_name'    => $lastname,
            'email'        => $email,
            'password'     => Hash::make($password)
        ]);
        $admin_role_id = DB::table('roles')->select('id')->where('name', 'admin')->first()->id;
        $user->attachRole($admin_role_id);

        // checking if the user have been created
        if ($user) {
            Session::put('step6', 'step6');
            return Redirect::route('final');
        }
    }

    /**
     * Get finalize
     * checking prerequisites.
     *
     * @return type view
     */
    public function finalize()
    {
        // checking if the installation have been completed or not
        if (Session::get('step6') == 'step6') {
            $value = '1';
            $install = base_path().DIRECTORY_SEPARATOR.'.env';
            $datacontent = File::get($install);
            $datacontent = str_replace('%0%', $value, $datacontent);
            File::put($install, $datacontent);
// setting email settings in route
            $smtpfilepath = "\App\Http\Controllers\Common\SettingsController::smtp()";

            $link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $pos = strpos($link, 'final');
            $link = substr($link, 0, $pos);
            $app_url = base_path().DIRECTORY_SEPARATOR.'.env';
            $datacontent2 = File::get($app_url);
            $datacontent2 = str_replace('http://localhost', $link, $datacontent2);
            File::put($app_url, $datacontent2);
            try {
                Session::flush();

                Artisan::call('key:generate');

                return View::make('installer/page/view7');
            } catch (Exception $e) {
                return Redirect::route('account')->with('fails', $e->getMessage());
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Post finalcheck
     * checking prerequisites.
     *
     * @return type view
     */
    public function finalcheck()
    {
        try {
            return redirect('login');
        } catch (Exception $e) {
            return redirect('login');
        }
    }

    public function changeFilePermission()
    {
        $path1 = base_path().DIRECTORY_SEPARATOR.'.env';
        if (chmod($path1, 0644)) {
            $f1 = substr(sprintf('%o', fileperms($path1)), -3);
            if ($f1 >= '644') {
                return Redirect::back();
            } else {
                return Redirect::back()->with('fail_to_change', 'We are unable to change file permission on your server please try to change permission manually.');
            }
        } else {
            return Redirect::back()->with('fail_to_change', 'We are unable to change file permission on your server please try to change permission manually.');
        }
    }

    public function jsDisabled()
    {
        return view('installer/page/check-js')->with('url', 'step1');
    }
}