<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;

use Monarobase\CountryList\CountryListFacade;
use App\Models\Profile;
use App\Models\clientInsurance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;


class InsuranceController extends Controller
{

    //
    public function index(){
        $user_session= Auth::user();
        //en insurances tenemos que ferificar si el usuario esta en clientInsurances con el profile se busca si se habilita el boton de agregar seguro 
        //entonces si lol es se pasa y la informacion del pago se registra en el insurance Id de client Insurance -> profile id deberia darnos la cantidad de personas elegidas al seguro 
        // se debe de agregar a la base de datos cuantas personas se van a asegurar ademas de eso se pasa a un json la data que se mando por medio de profiles 
        // la forma de verlos una vez agregado es colocando un dropdown menu con los fields a asegurados
        $ClientInsuranceData=ClientInsurance::where('user_id',$user_session->id)->get();
        return view('insurance_new.table_insurance',compact('ClientInsuranceData','user_session'));


    }
    public function index_admin()
    {
        $profiles = Profile::all();
        $profiles_user = [];

        foreach ($profiles as $profile) {
            $userData = [];

            // Concatenar el nombre y apellido
            $userData['name'] = $profile->first_name . ' ' . $profile->lastname;

            // Obtener el total de personas aseguradas
            $dataFilledInsured = json_decode($profile->data_filled_insured, true);
            
            $userData['total_users'] = is_array($dataFilledInsured) ? count($dataFilledInsured) : 0;

            // Buscar el seguro asociado al usuario
            $insurance = ClientInsurance::where('user_id', $profile->user_id)->first();

            if ($insurance && $insurance->insurance_id) {
                $insuranceData = Insurance::find($insurance->insurance_id);

                if ($insuranceData) {
                    $jsonData = json_decode($insuranceData->json, true);

                    // Sumar los montos de pago en el JSON
                    $userData['insurance_payment'] = collect($jsonData)->flatMap(function ($month) {
                        return collect($month)->pluck('monto');
                    })->sum();

                    // Obtener el mes de creación del seguro
                    $userData['month'] = $insuranceData->created_at->format('F Y');
                } else {
                    $userData['insurance_payment'] = null;
                    $userData['month'] = null;
                }
            } else {
                $userData['insurance_payment'] = null;
                $userData['month'] = null;
            }

            // Agregar datos del usuario al array final
            $profiles_user[] = $userData;
        }


        // Enviar los datos a la vista
        return view('insurance_new.table_admin', [
            'profiles_user' => $profiles_user,
        ]);
    }


    public function show($id){
        // $insurance=ClientInsurance::find($id);
        // $dataInsurance=Insurance::find($insurance->insurance_id);
        return view('insurance_new.show');

    }

    public function showInsurancePlans(){
        return view('insurance_new.select_plan');
    }

    public function create()
    {
        $user = Auth::user(); // Obtener usuario autenticado
        $profile = Profile::where('user_id',$user->id)->first(); // Obtener el perfil del usuario

        $insuredPersons = $profile ? json_decode($profile->data_filled_insured, true) : []; // Personas aseguradas

        $costPerPerson = 100; // Monto fijo por persona
        // dd($insuredPersons,$user,$profile);

        return view('insurance_new.detail', [
            'profile' => $profile,
            'insuredPersons' => $insuredPersons,
            'costPerPerson' => $costPerPerson
        ]);
    }
    public function pay()
    {
        $user = Auth::user(); // Obtener usuario autenticado
        $profile = Profile::where('user_id',$user->id)->first(); // Obtener el perfil del usuario

        $insuredPersons = $profile ? json_decode($profile->data_filled_insured, true) : []; // Personas aseguradas
// 
        $costPerPerson = 100; // Monto fijo por persona
        $annualPayment = 180; // Pago anual
        $monthlyPayment = 15; // Pago mensual
        // dd($insuredPersons,$user,$profile);

        return view('insurance_new.proceed_with_payment', [
            'profile' => $profile,
            'insuredPersons' => $insuredPersons,
            'costPerPerson' => $costPerPerson
        ]);
    }

    public function insurance_pay(Request $request)
{
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'voucher_picture' => 'required|image|max:2048',
        'paid_persons' => 'required|array|min:1', // Asegurar que al menos una persona esté seleccionada
    ]);

    // Subir el archivo de imagen y obtener su ruta
    $voucherPath = $request->file('voucher_picture')->store('vouchers', 'public');

    // Obtener el usuario autenticado
    $user = Auth::user();

    $profile = Profile::where('user_id', $user->id)->first(); // Obtener el perfil del usuario

    // Validar y calcular el monto total a pagar basado en las personas seleccionadas
    $paidPersons = $request->input('paid_persons');
    $costPerPerson = 100; // Costo por persona (puedes obtenerlo dinámicamente si es necesario)
    $totalAmount = count($paidPersons) * $costPerPerson;

    // Buscar si ya existe un seguro para este usuario basado en el número de teléfono
    $insurance = Insurance::where('phonenumber', $profile->phone_extension . '.' . $profile->phone)->first();

    // Si el seguro no existe, crear uno nuevo
    if (!$insurance) {
        $insurance = new Insurance();
        $insurance->user_id = $user->id;
        $insurance->phonenumber = $profile->phone_extension . '.' . $profile->phone; // Número de teléfono único
        $insurance->email = $user->email;
    }

    // Crear el JSON con la información del pago por persona
    $currentMonth = Carbon::now()->format('F');
    $currentDate = Carbon::now()->toDateString();

    $insuranceData = [];
    
    // Si el seguro ya tiene datos, los decodificamos
    if ($insurance->json) {
        $existingData = json_decode($insurance->json, true);
        if (isset($existingData[$currentMonth])) {
            $insuranceData = $existingData[$currentMonth]; // Usamos los datos existentes de este mes
        }
    }

    // Agregar las nuevas personas al JSON
    foreach ($paidPersons as $index) {
        $insuranceData["persona#$index"] = [
            'nombre' => "Persona $index", // Esto debe ser ajustado si tienes los datos reales de cada persona
            'fecha' => $currentDate,
            'monto_pay' => $request->payment_type,
            'monto' => $costPerPerson,
            'img_url' => $voucherPath,
            'contrato_id' => null,
        ];
    }

    // Guardar el JSON actualizado
    $insurance->json = json_encode([$currentMonth => $insuranceData]);
    $insurance->save(); // Si el seguro ya existía, esto actualizará el registro

    // Crear o actualizar la entrada en ClientInsurance
    ClientInsurance::updateOrCreate(
        ['user_id' => $user->id], // Condición para verificar si ya existe
        [
            'status' => false, // Estado inicial del seguro
            'profile_id' => $user->profile_id, // Asegúrate de obtener el perfil relacionado
            'insurance_id' => $insurance->id, // Relación con el seguro
        ]
    );

    return redirect()->route('insurance.index')->with('success', 'Pago realizado y seguro creado/actualizado correctamente.');
}
     

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }


    
}
