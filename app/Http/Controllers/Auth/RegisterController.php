<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserEvent;
use App\Models\Event;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\SubscriptorDataModel;
use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/start";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
     
        //dd($data);
        $data['name'] = explode("@", $data['email'])[0];
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol' => $data['rol'],
            'remember_token' => Str::random(32),
            'unique_code' => Str::random(5),
            'refered_code' => $data['refered_code'] ?? 'aeia',
        ]);

    // Crear el registro en SubscritorData si el rol es 1, 2 o 5
        if (in_array($data['rol'], [1, 2, 5])) {
            $suscriptor_data=SubscriptorDataModel::create([
                'name' => $data['name'],
                'membership_collected' => 0,
                'user_table_id' => $user->id, // Aquí asignamos el ID del usuario recién creado
            ]);
        }

        // dd($suscriptor_data);

        $profile = Profile::create([
            'user_id' => $user->id
        ]);

        $event = Event::find($data['event_id']);

        if (!empty($event)) {
            UserEvent::create([
                'user_id' => $user->id,
                'event_id' => $data['event_id'],
                'inscription_date' => Carbon::parse()->format('Y-m-d')
            ]);
            $event->total = $event->total + 1;
            $event->save();
        }

        $data = [
            "email_send" => $data['email'],
            "token" => $user->remember_token,
            "view" => "emails.register",
            "subject" => "AEIA EMPIEZA A INVERTIR [REGISTRO]",
        ];
        $MailCustom = MailCustom::to($data['email_send'])->queue(new SendMail($data));

        return $user;
    }

    public function showRegistrationSuscriptor($invite_link)
    {
        $dataUser = User::where('link', $invite_link)->with('profile')->get()->first();

        //dd($dataUser->profile);
        $profile = Profile::where('user_id', $dataUser->id)->get()->first();
        //dd($profile);
        $dataUser->profile = $profile;
        return view('auth.register')->with('dataUser', $dataUser);
    }

    public function showRegistrationClient($invite_link)
    {
        $dataUser = User::where('link', $invite_link)->with('profile')->get()->first();

        //dd($dataUser->profile);
        $profile = Profile::where('user_id', $dataUser->id)->get()->first();
        //dd($profile);
        $dataUser->profile = $profile;
        return view('auth.register')->with('dataUser', $dataUser);
    }
}
