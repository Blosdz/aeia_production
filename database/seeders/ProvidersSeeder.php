<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;
use Illuminate\Support\Facades\Crypt;


class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::truncate();

        //there are some providers which don't have binance_user
        //because the client haven't given enough info about it.
        Provider::insert([[
          'key' => 'API KEY AEIA GENERAL',
          'secret_key' => Crypt::encryptString('QYGQ0wugt2a2yqxQlKKdYTsibwrOU30emdpD26Zd1vGo5DrRDf8WAl8BDKdR0dL2'),
          'value' => Crypt::encryptString('CHMpPARtmrT0u9V84j0777jm0Nxs5RHOEXQVss4rCUWTWrEgZaD5ul99VPDj2pfZ'),
          'binance_user' => null,
          'slug' => 'api_general',
        ],[
          'key' => 'API SUSCRIPTORES',
          'secret_key' => Crypt::encryptString('DIg0EGuFTxsS9lf5dRScFfQPRVypszEGr3xgxijfLkXCAp2GIk2jqvReXaCmX88q'),
          'value' => Crypt::encryptString('fmjUv1kA24pCYxQRtanGQggx3EEYQK6Guk1jKDN6MiVwfJZL8MC54WiUPAfYjeqM'),
          'binance_user' => ('572351555'),
          'slug' => 'api_suscriptores',
        ],[
          'key' => 'API GERENTE COMERCIAL',
          'secret_key' => Crypt::encryptString('DIg0EGuFTxsS9lf5dRScFfQPRVypszEGr3xgxijfLkXCAp2GIk2jqvReXaCmX88q'),
          'value' => Crypt::encryptString('fgwrwApkk8ExAjAeyTwDDRCqPejRCwTMP8lCuxni1VTfO0qZ608a56ByUs1we2j7'),
          'binance_user' => ('572351560'),
          'slug' => 'api_comercial',
        ],[
          'key' => 'API FONDO ENERO',
          'secret_key' => Crypt::encryptString('P5zbHM0SBUUZmvvsve9iMNKPfyptJjWjRiamXcYq5U8SEKAkyfv8aMy3ucPrLRNH'),
          'value' => Crypt::encryptString('fgwrwApkk8ExAjAeyTwDDRCqPejRCwTMP8lCuxni1VTfO0qZ608a56ByUs1we2j7'),
          'binance_user' => ('452730028'),
          'slug' => 'fondo_enero',
        ],[
          'key' => 'API FONDO FEBRERO',
          'secret_key' => Crypt::encryptString('wAXaeWLtDIOW3eacFeRcYJQ2WSAYkTluGHbCHfOz9jLTSK6d7SH43ynDfpGnCoHp'),
          'value' => Crypt::encryptString('viYzNAvMfEtn4SQCqG40wThgdK5C81rRVIArJ8V5SdTGLULM4464DL3me2GypRof'),
          'binance_user' => ('452730033'),
          'slug' => 'fondo_febrero',
        ],[
          'key' => 'API FONDO MARZO',
          'secret_key' => Crypt::encryptString('rims8MQ9BgyBnPivcETVV7Dv1jWzfhBdgV4uVlwKR4Xb5euSi6TKjlHMmBt2Pc1J'),
          'value' => Crypt::encryptString('qoJpqEhLxvrgPt5y65LxRnL6Kg41AdR7TlkZefgWLAoJoCcsHWhpPRsEExWVcgtq'),
          'binance_user' => ('452730035'),
          'slug' => 'fondo_marzo',
        ],[
          'key' => 'API FONDO ABRIL',
          'secret_key' => Crypt::encryptString('E3nenV4YtFRx2uXhjCxSlA0IYWcYqqZo3qzme0ZRNatGGVTmDB3z29iOmUGFu34H'),
          'value' => Crypt::encryptString('sCwuopPOF508o3krNpyGxVTPBF2mXdtMQcuHJg6C2EzTWQUGdmQi86hyic6mCt2H'),
          'binance_user' => '452730036',
          'slug' => 'fondo_abril',
        ],[
          'key' => 'API FONDO MAYO',
          'secret_key' => Crypt::encryptString('gtCMvH557wys7fXR8Dke5geYB6Mpqc5pem8DJBz6lXQVyxfLPDCVcv776OOBwTGk'),
          'value' => Crypt::encryptString('rqsDF6LQCTOEsGG0M14S4T0i9KFeV8t6nN9jjbGoMAZEXUkbrMCSjlXkUG0K9sjG'),
          'binance_user' => '452730038',
          'slug' => 'fondo_mayo',
        ],[
          'key' => 'API FONDO JUNIO',
          'secret_key' => Crypt::encryptString('IE1lQKm9ne72qkbDuXIRzfF8IAZDtLpuremZOwNntU8re4Anwtf8Sppmu7ejlN1y'),
          'value' => Crypt::encryptString('Qsu4pv0EupbFzGG8FftzF7KcPbrBxwGrKYCTrXTTpICH7WNLSqWiurL6A9vV4EVu'),
          'binance_user' => '452730039',
          'slug' => 'fondo_junio',
        ],[
          'key' => 'API FONDO JULIO',
          'secret_key' => Crypt::encryptString('d37n6dOBAEwzntgjyM6DqsAyGCL4oy0vgCg5DPjYbg5gJSYUPwqUixKK0LFGY7Gx'),
          'value' => Crypt::encryptString('xi3g8Z7QfPh4bmQhnIqn7RdIizjfy9LXLMCY9IO0tA9f3zF53cFIVKQpJrF304eu'),
          'binance_user' => '452730040',
          'slug' => 'fondo_julio',
        ],[
          'key' => 'API FONDO AGOSTO',
          'secret_key' => Crypt::encryptString('F0waVC7efIiXMkaFTJdHZNxuNVl9lALUmBHbMfYwrkDINIox0Vq4GiCzvYN2acBU'),
          'value' => Crypt::encryptString('Pm9ymibgzynjDFYtkno9Ay2c92zqq4n4Gz5RVKG0ovbgmxxEMeWIrHSJDoK409RB'),
          'binance_user' => '452730041',
          'slug' => 'fondo_agosto',
        ],[
          'key' => 'API FONDO SETIEMBRE',
          'secret_key' => Crypt::encryptString('CB9uBWLgcOzBRQHuOcWVoYifpuHW8vTDDIZsiuCCT98gLAPSdtbSVJP4XGBSrpKh'),
          'value' => Crypt::encryptString('ls5OzSSOi2CkOhWY7y1cFomnb9NfT4LYc79qESG4bBMQF8cj3NCkRDmtH92ukK9i'),
          'binance_user' => '452730042',
          'slug' => 'fondo_setiembre',
        ],[
          'key' => 'API FONDO OCTUBRE',
          'secret_key' => Crypt::encryptString('GpUmh9flKm4uBOXPcObiuYncwN83JYXNFeH8dX8rljfg1ZTt7mJUJ6zKocJZD89o'),
          'value' => Crypt::encryptString('4DG1uOC0XcYovZG5GLnySbsZ2pA5pnYYyqwuUquEqGjcRjjfqtKvpGk8TUkjp1yI'),
          'binance_user' => '452730044',
          'slug' => 'fondo_octubre',
        ],[
          'key' => 'API FONDO NOVIEMBRE',
          'secret_key' => Crypt::encryptString('dBi6lEbJSRBXxNZmWLbnwb19KdFwar1OyKl27IfLBWiSwxat3nZJbIW50DsdCZ77'),
          'value' => Crypt::encryptString('fYmkr4e0BI5hWhQh1WI1YCqDc9vbFkYPUnmUvy1aH468Z7XRxeeErL6NNwOGzGyL'),
          'binance_user' => '452730045',
          'slug' => 'fondo_noviembre',
        ],[
          'key' => 'API FONDO DICIEMBRE',
          'secret_key' => Crypt::encryptString('qKdsk8kGhoKmohFVJ4lQRqhJpHDGMxYbDzy8VS5l9EYBq8s3rHh4SvHrHmQkTEbm'),
          'value' => Crypt::encryptString('2z5IC4anBsSRgaHZ6xGzzMdrdGSKT1X3FS1PzK5nt38J41BkMg2IMMHVF3kFNAL3'),
          'binance_user' => '452730046',
          'slug' => 'fondo_diciembre',
        ],[
          'key' => 'API CTA CAPITAL ACOPIADO',
          'secret_key' => Crypt::encryptString('1BeMiJnBVTL4h7bOQMjPB0ZFRJ9ouckqqhzTm17C1xnzS4EGpbpsMccR8oaNyK0C'),
          'value' => Crypt::encryptString('yC4VLLOIyXSQ2ydn7OaK4UKv9KqTyOr79rTX4iGARhwRoQPqiC5oyZNCV5lOEsRE'),
          'binance_user' => null,
          'slug' => 'api_acopiado',
        ],[
          'key' => 'API CTA MEMBRESÍAS',
          'secret_key' => Crypt::encryptString('lVbdl6lSzbhKjG61u1GKZ4rS2HCwqQNr0GAi67lpUpzS54mVlLOGFuZpIH9R6MNq'),
          'value' => Crypt::encryptString('BkQZrl690RxHyDC7dBS33Lr5ttcWg1tA1fQhp5gNNm1XiTNpVcATwHJPNuxPfLvp'),
          'binance_user' => '452730049',
          'slug' => 'api_membresias',
        ],[
          'key' => 'API PAGOS',
          'secret_key' => Crypt::encryptString('ptIT8Cf4Vl0Up3aoJwpORs7qEVITBubIfVjuI4GADfUPdhtn7daE7IB7K053NSyD'),
          'value' => Crypt::encryptString('9Oq4YrBSVn6c82GMPeT317EIvStq9mDJhQdJOjMmlYRUTvSOpq0LpUoQ1qums4Cb'),
          'binance_user' => null,
          'slug' => 'api_pagos',
        ],[
          'key' => 'API GENERAL BINANCE PAY',
          'secret_key' => Crypt::encryptString('2axiuuqbk9j6toi03xhyzim3mphih8juyz35vwvswdxdrpjwbcythi0mvajl1mf2'),
          'value' => Crypt::encryptString('apgd15ih53aaoikrbipr05v2e8mdewkv2hivtbmr3gsocqgrq6ulmryusjumnl5c'),
          'binance_user' => null,
          'slug' => 'binance_pay',
        ]]);
    }
}
