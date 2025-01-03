<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;

use Monarobase\CountryList\CountryListFacade;
use App\Models\Profile;
use App\Models\clientInsurance;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use DB;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

use Illuminate\Support\Facades\Storage;


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
        // Filtrar usuarios con rol 3 o 4
        $user_where = User::whereIn('rol', [3, 4])->pluck('id');
        // Filtrar perfiles de los usuarios con los roles especificados
        $profiles = Profile::whereIn('user_id', $user_where)->get();
        $profiles_user = [];

        foreach ($profiles as $profile) {
            $userData = [];

            // Concatenar el nombre y apellido
            $userData['name'] = $profile->first_name . ' ' . $profile->lastname;

            $userData['user_id'] = $profile->user_id;
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


    public function show($id)
    {
        // Obtener el perfil del usuario
        $profile = Profile::where('user_id', $id)->first();
        $data_filled_insured = [];
    
        if ($profile && $profile->data_filled_insured) {
            // Decodificar JSON en el campo data_filled_insured
            $data_filled_insured = json_decode($profile->data_filled_insured, true);
        }
    
        $insurance_data_client = clientInsurance::where('user_id', $id)->first();
        // Obtener seguros relacionados al usuario
        $insurance_data_all = Insurance::where('id', $insurance_data_client->insurance_id)->first();
    
        // Preparar el arreglo combinado
        $insurance_data=json_decode($insurance_data_all->json,true);

        $insured_with_details = [];

        // dd($insurance_data);
        foreach ($data_filled_insured as $index => $person) {
            $persona_key = "persona#{$index}";
    
            // Datos base de la persona
            $insured_with_details[$persona_key] = [
                "nombre" => "{$person['first_name']} {$person['lastname']}",
                "dni" => "{$person['type_document']} - {$person['dni_number']}",
                "country_document" => $person['country_document'],
                "Club" => $person['club'] ?? 'N/A',
                "deporte" => $person['deporte'] ?? 'N/A',
                "photo_url" => [
                    "front" => asset($person['dni_file']),
                    "back" => asset($person['dni_r_file']),
                    // "voucher" => asset
                ],
                "address" => $person['address'],
                "insurance_details" => [], // Inicializar seguros
            ];
        }
    
       // Pasar por los datos de seguro y combinar con insured_with_details
       foreach ($insurance_data as $month => $details) {
            foreach ($details as $persona_key => $insurance_details) {
                // Validar si el persona_key existe en insured_with_details
                if (isset($insured_with_details[$persona_key])) {
                    $insured_with_details[$persona_key]['insurance_details'][] = [
                        "mes" => $month,
                        "fecha" => $insurance_details['fecha'],
                        "monto_pay" => $insurance_details['monto_pay'],
                        "monto" => $insurance_details['monto'],
                        "img_url" => asset($insurance_details['img_url']),
                    ];
                }
            }
        }
    
        // Renderizar la vista
        // dd($insured_with_details);
        return view('insurance_new.show', [
            'insured_with_details' => $insured_with_details,
            'user' => User::find($id),
            'profile' => $profile,
        ]);
    }
     
       

    public function showInsurancePlans(){
        return view('insurance_new.select_plan');
    }

    public function updateStatus(Request $request, $id)
    {
        // Recuperar los datos de seguro del cliente
        $insurance_data_client = clientInsurance::where('user_id', $id)->first();

        if (!$insurance_data_client) {
            return redirect()->back()->with('error', 'Seguro no encontrado para este usuario.');
        }

        // Buscar el seguro
        $insurance_data_all = Insurance::where('id', $insurance_data_client->insurance_id)->first();

        if (!$insurance_data_all) {
            return redirect()->back()->with('error', 'Cobertura de seguro no encontrada.');
        }

        // Decodificar el JSON de datos del seguro
        $insurance_json = json_decode($insurance_data_all->json, true);

        // Validar el input de estado que viene del request (validar, no validar, etc.)
        $validated = $request->validate([
            'persona_id' => 'required|string', // Ejemplo persona#0, persona#1, etc.
            'status' => 'required|string|in:validar,no_validar,corregir_data', // estado validado o no validado
            'month' => 'required|string', // mes, en este caso December
        ]);

        // Obtener la persona y mes desde el request
        $persona_key = $request->input('persona_id'); // ejemplo persona#0
        $month_key = $request->input('month');  // Aquí recibes "December"

        // Verificar si el mes existe en el JSON
        if (isset($insurance_json[$month_key])) {
            // Verificar si la persona existe dentro del mes
            if (isset($insurance_json[$month_key][$persona_key])) {
                // Actualizar el valor "stats" dentro de la persona
                $insurance_json[$month_key][$persona_key]['stats'] = $request->input('status');
            } else {
                return redirect()->back()->with('error', "Persona no encontrada en el mes $month_key.");
            }
        } else {
            return redirect()->back()->with('error', 'Mes no encontrado en los datos del seguro.');
        }

        // Volver a codificar el JSON y guardarlo en el modelo
        $insurance_data_all->json = json_encode($insurance_json);

        // Guardar los cambios en la base de datos
        $insurance_data_all->save();

        // Redirigir con éxito
        return redirect()->route('insurance.show', ['id' => $id])
                         ->with('success', 'Estado actualizado correctamente');
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
            'payment_type'=> 'required|string',
        ]);
    
        // Subir el archivo de imagen y obtener su ruta
        $filePath = 'insurance_payment/';
        $name = uniqid() . '.' . $request->file('voucher_picture')->getClientOriginalExtension();

        if (!Storage::exists('public/' . $filePath)) {
            Storage::makeDirectory('public/' . $filePath, 0777, true);
        }

        $user = Auth::user();
    
        $profile = Profile::where('user_id', $user->id)->first(); // Obtener el perfil del usuario
    
        // Validar y calcular el monto total a pagar basado en las personas seleccionadas
        $paidPersons = $request->input('paid_persons');
        $costPerPerson = 100; // Costo por persona (puedes obtenerlo dinámicamente si es necesario)
        $totalAmount = count($paidPersons) * $costPerPerson;

        // Subir el archivo de imagen y obtener su ruta
        $voucherPath = $filePath . $name; 
        $request->file("voucher_picture")->storeAs('public/' . $filePath, $name);


    
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
                'profile_id'=>$profile->id,
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
