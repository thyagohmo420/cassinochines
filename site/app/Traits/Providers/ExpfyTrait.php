<?php

namespace App\Traits\Providers;

use App\Helpers\Core as Helper;
use App\Models\Game;
use App\Models\Provider;
use App\Models\GamesKey;
use App\Models\GGRGames;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Missions\MissionTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait ExpfyTrait
{
    use MissionTrait;




    public static function GameLaunchExpfy($provider_code, $game_code, $lang, $userId)
    {
       

             

            $endpointwo = "https://api.expfygaming.online/api/v1/game_launch";


                $wallet = Wallet::where('user_id', $userId)->where('active', 1)->first();

                error_log($game_code);

                switch ($game_code) {
                    case '40':
                        $gamename = "jungle-delight";
                        break;
						
						      case '98':
                        $gamename = "fortune-ox";
                        break;
						        case '63':
                        $gamename = "dragon-tiger-luck";
                        break;
						
						 case '42':
                        $gamename = "ganesha-gold";
                        break;
						
							 case '48':
                        $gamename = "double-fortune";
                        break;
						
						
                    case '68':
                        $gamename = "fortune-mouse";
                        break;
                    case '69':
                        $gamename = "bikini-paradise";
                    break;
                    case '126':
                        $gamename = "fortune-tiger";
                        break;
                    case '1543462':
                        $gamename = "fortune-rabbit";
                        break;
                    case '1695365':
                        $gamename = "fortune-dragon";
                        break;
                }

                $postArray = [
                    "secretKey"    => 'secret_0Rhzj1hYcgH8iuPZ81eeQmdo4Q9f2BMr',
                    "agentToken"   => 'pub_3xHiW8FnbXQMrAjkT0LNQ0KnwF55kHO7',
                    "user_code"     => $userId.'',
                    "provider_code" => $provider_code,
                    "game_code"     => $gamename,
                    "user_balance" => $wallet->total_balance,
                    "lang"          => $lang
                ];
                $wallet = Wallet::where('user_id', $userId)->where('active', 1)->first();


                $response = Http::post($endpointwo, $postArray);
                $data = $response->json();

                $data['launchUrl'] = $data['launch_url'];

            

            return $data;

        }

    }

 









?>