<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\PetModel;
use App\Models\DeletedPlanModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    use ResponseTrait;
    private $payload;
    public $baseApi;
    public $cepApi;
    public $requestURL;
    protected $k;
    public $pageData;
    public $dashData;
    
    public function __construct () {
        $this->baseApi = 'https://api.iugu.com/v1/';
        $this->cepApi = 'https://correios.brasilplataformas.com.br/api/cep';
        $this->k = base64_encode(env("KEY_IUGU").":"); //$_SERVER['KEY_IUGU'].":";
        // $this->payload = $this->request->getJSON();;
        $this->requestURL = "";
        
        $this->pageData = [];
        $this->dashData = [];
    }

    public function index()
    {
        helper(['text', 'number']);

        $this->pageData["title"] = "Dashboard";

        // $args = [];
        // $this->requestURL = $this->baseApi . "invoices?limit=10";
        // $args["m"] = "GET";
        // $args["pl"] = json_encode([
        // ]);
        
        // $r = $this->doRequest($this->requestURL, $args);
        // $faturas = json_decode($r, true);
        // // echo "<pre>";
        // foreach($faturas['items'] as $i => $f) {
        //     // print_r($f);
        //     foreach($f["variables"] as $v) {
        //         if($v["variable"] == "subscription_id") {
        //             unset($f["variables"]);
        //             $faturas['items'][$v["value"]] = $f;
        //             break;
        //         }
        //     }
        //     // $faturas[$f["variables"]];
        //     unset($faturas['items'][$i]);
        // }
        // print_r($faturas['items']);
        // exit;
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "plans";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $planos = json_decode($r, true);
        // print_r($planos);exit;
        $this->dashData["total_plans"] = $planos["totalItems"];


        //week
        $paid1Week = date_create("now -1 week");
        $args = [];
        $this->requestURL = $this->baseApi . "invoices";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'paid_at_from' => $paid1Week->format("Y-m-d"),
            'status_filter' => "paid"
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $invoices = json_decode($r, true);
        
        $totalWeekCents = 0; 
        foreach($invoices['items'] as $i=>$in) {
            unset($invoices["items"][$i]["variables"]);
            $totalWeekCents += $in["total_cents"];
        }
        $decimal = number_format(($totalWeekCents /100), 2, '.', ' ');
        
        $real = number_to_currency($decimal, "BRL", null, 2);
        $pago1Week = [
            "total_cents" => $totalWeekCents,
            "total" => $real,
            "start_week" => $paid1Week->format("d/m/Y")
        ];

        // 2 weeks
        $paid2Week = date_create("now -2 week");
        $args = [];
        $this->requestURL = $this->baseApi . "invoices";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'paid_at_from' => $paid2Week->format("Y-m-d"),
            'paid_at_to' => $paid1Week->format("Y-m-d"),
            'status_filter' => "paid"
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $invoices = json_decode($r, true);
        
        $totalWeekCents = 0; 
        foreach($invoices['items'] as $i=>$in) {
            unset($invoices["items"][$i]["variables"]);
            $totalWeekCents += $in["total_cents"];
        }
        
        $decimal = number_format(($totalWeekCents /100), 2, '.', ' ');
        
        $real = number_to_currency($decimal, "BRL", null, 2);
        $pago2Week = [
            "total_cents" => $totalWeekCents,
            "total" => $real,
            "start_week" => $paid2Week->format("d/m/Y"),
            "end_week" => $paid1Week->format("d/m/Y"),
        ];
        
        
        $planList = [];
        foreach($planos['items'] as $p) {
            $planList[$p["identifier"]] = $p;
            // var_dump($p);
        }
        // exit;
        // echo "<pre>";
        // print_r($planList);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'status_filter' => 'active'
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $assinaturas = json_decode($r, true);
        // echo "<pre>";
        
        // print_r($assinaturas);exit;
        $this->dashData["total_subs"] = $assinaturas["totalItems"];

        $args = [];
        $this->requestURL = $this->baseApi . "customers";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $customers = json_decode($r, true);
        $this->dashData["total_customers"] = $customers["totalItems"];
        // echo "<pre>";
        // print_r($customers);exit;
        $assPlan = [];
        foreach($assinaturas["items"] as $ass) {
            unset($ass["features"]);
            unset($ass["logs"]);
            unset($ass["custom_variables"]);
            unset($ass["subitems"]);
            if(!isset($assPlan[$ass["plan_identifier"]])) {
                $assPlan[$ass["id"]] = [];
            }
            $assPlan[$ass["id"]][] = $ass;
            // if(!isset($assPlan[$ass["plan_identifier"]][""]))
            // $assPlan[$ass["plan_identifier"]] = [
            //     "plan" => $ass["plan_ref"],
            //     "plan_ref" => $ass["plan_identifier"],
            //     "price_cents" => $ass["price_cents"]
            // ];
            $this->dashData["assinaturas"][$ass["plan_identifier"]][] = $ass;
        }
        // echo "<pre>";
        // print_r($this->dashData["assinaturas"]);exit;

        //invoices 3 months
        // $last3Months = date_create("now -3 weeks");
        // $args = [];
        // $this->requestURL = $this->baseApi . "accounts/invoices";
        // $args["m"] = "GET";
        // $args["pl"] = json_encode([
        //     // 'paid_at_from' => $last3Months->format("Y-m-d"),
        //     'status' => "paid"
        // ]);
        
        // $r = $this->doRequest($this->requestURL, $args);
        // $allInvoices = json_decode($r, true);
        // echo "<pre>";
        // print_r($allInvoices);exit;
        // $last3MonthsCents = 0;
        // $byPlans = [];
        // foreach($allInvoices as $i=>$in) {
            // echo "<pre>";
            // print_r($in);
            // foreach($in["variables"] as $vi => $v) {
            //     if($v["variable"] == "subscription_id") {
            //         if(isset($assPlan[$v["value"]]["plan"])) {
            //             // echo $assPlan[$v["value"]]["plan"] . "<br>";
            // $byPlans[""];
            //         }
                    
            //         break;
            //     }
            // }
            // unset($allInvoices["items"][$i]["variables"]);
            // $last3MonthsCents += $in["total_cents"];
        // }
        // print_r($)
        // exit;
        // $decimal = number_format(($last3MonthsCents /100), 2, '.', ' ');
        
        // $real = number_to_currency($decimal, "BRL", null, 2);
        // $pago1Week = [
        //     "total" => $real,
        //     "start_week" => $last3Months->format("d/m/Y")
        // ];

        $this->dashData["planList"] = $planList;
        // echo "<pre>";
        // print_r($this->dashData["assinaturas"]);exit;
        $c2 = [];
        $c2_r = [];
        $this->dashData["assinaturas_alt"] = [];
        foreach($this->dashData["assinaturas"] as $identifier => $a) {
            if(isset($this->dashData["planList"][$identifier])) {
                // print_r($a);
                if(!isset($c2[$identifier]["total_cents"])) {
                    $c2[$identifier]["total_cents"] = 0;
                }
                
                $c2[$identifier]["name"] = $this->dashData["planList"][$identifier]["name"];
                // $c2[$identifier]["total_cents"] =  0; //$this->dashData["planList"][$identifier]["price_cents"];
                foreach($this->dashData["assinaturas"][$identifier] as $ai) {
                    $c2[$identifier]["total_cents"] += $ai["price_cents"];
                    $decimal = number_format(($c2[$identifier]["total_cents"] /100), 2, '.', ' ');
                    $real = number_to_currency($decimal, "BRL", null, 2);
                    $ai["real"] = $real;
                    // $date = date_create($assinatura['cycled_at']);

                    $created = date_create($ai['created_at']);
                    $date = $created->format('d/m/Y') ;
                    $ai["created_pt"] = $date;
                    // echo $periodo;
                    // $assinaturas[$i]['periodo'] = $periodo;

                    $this->dashData["assinaturas_alt"][] = $ai;
                }
                if(!isset($c2[$identifier]["items"])) {
                    $c2[$identifier]["items"] = [];
                }
                // echo "<pre>";
                // print_r($a);
                // $c2[$identifier]["items"] = $a["price_cents"];
                $decimal = number_format(($c2[$identifier]["total_cents"] /100), 2, '.', ' ');
                $real = number_to_currency($decimal, "BRL", null, 2);
                $c2[$identifier]["total_real"] = $real;

                $c2[$identifier]["items"] = $this->dashData["assinaturas"][$identifier];
                // $c2[$identifier]['n'] = count($c2[$identifier]["items"]);
                // array_push
                if(!isset($c2_r["labels"])) {
                    $c2_r["labels"] = '';
                }
                if(!isset($c2_r["data"])) {
                    $c2_r["data"] = '';
                }
                $c2_r["labels"] .= '"'.$c2[$identifier]["name"].'",';
                $c2_r["data"] .= '"'.count($c2[$identifier]["items"]).'",';
            
                // array_push($c2[$identifier]["items"], $a);
                // $c2[$identifier]["name"][''] = $this->dashData["planList"][$identifier]["name"];

            }
        }
        $c2_r["labels"] = rtrim($c2_r["labels"], ',');
        $c2_r["data"] = rtrim($c2_r["data"], ',');
        // echo "<pre>";
        // print_r($this->dashData["assinaturas_alt"]);exit;
        //         $oldFigure = 0;
        // $newFigure = 50;

        // $percentChange = (1 - $oldFigure / $newFigure) * 100;

        // echo round($percentChange, 0);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "accounts/invoices";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            // 'paid_at_from' => $last3Months->format("Y-m-d"),
            'status' => "paid"
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $allInvoices = json_decode($r, true);
        
        $plansByMonth = [];
        
        // echo "<pre>";
        // print_r($assPlan);exit;
        foreach($allInvoices as $i) {
            $month = date_create($i["paid_at"])->format("m");
            $year = date_create($i["paid_at"])->format("Y");

            $sid = $i["subscription_id"];
            $subs = isset($assPlan[$sid]) ? $assPlan[$sid][0] : null;
            if(!isset($plansByMonth[$month])) {
                $plansByMonth[$month] = [];
            }
            if(!isset($plansByMonth[$month][$year])) {
                $plansByMonth[$month][$year] = [];
            }
            
            if($subs) {
                // print_r($subs);

                // var_dump($plansByMonth[$month][$assPlan[$i["subscription_id"]]]);
                if(!isset($plansByMonth[$month][$year][$subs["plan_identifier"]])) {
                    $plansByMonth[$month][$year][$subs["plan_identifier"]] = [
                        "Month" => $month,
                        "Year" => $year,
                        "Label" => $subs["plan_ref"],
                        "Items" => [],
                        "TotalItems" => 0
                    ];
                }
                $plansByMonth[$month][$year][$subs["plan_identifier"]]["Items"][] = $i;
                $plansByMonth[$month][$year][$subs["plan_identifier"]]["TotalItems"] = 
                    count($plansByMonth[$month][$year][$subs["plan_identifier"]]["Items"]);
            } else {
                if(!isset($plansByMonth[$month][$year]['deleted'])) {
                    $plansByMonth[$month][$year]['deleted'] = [
                        "Month" => $month,
                        "Year" => $year,
                        "Label" => "Desconhecido",
                        "Items" => [],
                        "TotalItems" => 0
                    ];
                }
                $i["assinatura"] = "Removida";
                $i["plan_ref"] = "Desconhecido";
                $plansByMonth[$month][$year]['deleted']["Items"][] = $i;
                $plansByMonth[$month][$year]['deleted']["TotalItems"] = 
                    count($plansByMonth[$month][$year]['deleted']["Items"]);
            }

            // print_r($assPlan[$i["id"]]);
            // print_r($this->dashData["planList"][]);
        }
        // echo "<pre>";
        $mList = [
            "01" => "Jan",
            "02" => "Fev",
            "03" => "Mar",
            "04" => "Abr",
            "05" => "Mai",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ago",
            "09" => "Set",
            "10" => "Out",
            "11" => "Nov",
            "12" => "Dez"
        ];
        $chart_1_months = "";
        $chart_data = [];
        foreach($plansByMonth as $m => $year) {
            $m = (integer) $m;
            
            if($m < 10) {
                $m = (string) "0".$m;
            }
            // print_r(key($year));
            $chart_1_months .= '"'.$mList[$m] . '/'.key($year).'", ';
            // echo "<hr>";
            foreach($year as $y => $plan) {
                // print_r($y);
                // echo "<hr>";
                foreach($plan as $p => $a) {
                    if(!isset($chart_data[$mList[$m]])) {
                        $chart_data[$mList[$m]] = [];
                        // $chart_data[$mList[$m]][$p] = [
                        //     "P" => $a["Label"],
                        //     "T" => 0
                        // ];
                    }
                    $chart_data[$mList[$m]][$p] = [
                        "Plano" => $a["Label"],
                        "Total" => $a["TotalItems"]
                    ];
                 }
                // echo "<hr>";
            }
        }
        $planListCopy = $planList;
        $planListCopy["deleted"] = [
            "name" => "Desconhecido"
        ];
        $pl = array_keys($planListCopy);
        // print_r($chart_data);exit;
        $chart_data2 = [];
        foreach($pl as $pi) {
            // print_r($pi);
            foreach($chart_data as $e => $t) {
                // print_r($e);
            
                if(!isset($chart_data[$e][$pi])) {
                    $chart_data[$e][$pi] = [
                        "Plano" => isset($planListCopy[$pi]["name"]) ? $planListCopy[$pi]["name"] : "Unknown",
                        "Total" => "0"
                    ];
                }  
                
                if(!isset($chart_data2)) {
                    $chart_data2 = [];
                } 

                if(!isset($chart_data2[$pi])) {
                    $chart_data2[$pi] = [
                        "P" => isset($planListCopy[$pi]["name"]) ? $planListCopy[$pi]["name"] : "Unknown",
                        "T" => ""
                    ];
                } 
                $chart_data2[$pi]["T"] .= $chart_data[$e][$pi]["Total"] . ", ";
                // var_dump($chart_data[$e][$pi]);
                // $chart_data2[$e][$pi]["T"] .= isset($chart_data[$e][$pi]["T"]) ? $chart_data[$e][$pi]["T"] : 0;
            }
            $chart_data2[$pi]["T"] = rtrim($chart_data2[$pi]["T"],", ");
            // if(!isset($chart_data[$e][key($t)])) {
            //     echo "tem<br>";
            // }
            // print_r($e);
            // print_r($t);
            // print_r($chart_data);
            
        }
        $chart_1_months = rtrim($chart_1_months, ", ");
        // print_r($chart_data);
        // print_r($chart_data);
        // exit;



        $this->dashData["chart_1_months"] = $chart_1_months;
        $this->dashData["chart_1_data"] = $chart_data2;
        $this->dashData["chart_1_data_plans"] = count($chart_data2);

        $this->dashData["chart2"]["js"] = $c2_r;
        $this->dashData["chart2"]["tb"] = $c2;
        $this->dashData["pago1Week"] = $pago1Week;
        $this->dashData["pago2Week"] = $pago2Week;
        $oldFigure = $pago2Week["total_cents"];
        $newFigure = $pago1Week["total_cents"];

        $percentChange = (1 - $oldFigure / $newFigure) * 100;

        $ds = null;
        $d = round($percentChange, 3);
        if($d == 0) {
            $ds = "bg-warning";
        } else if($d > 0) {
            $ds = "bg-success";
        } else {
            $ds = "bg-danger";
        }
        $this->dashData["pago2WeekPercent"] = ($d > 0) ? '+'.$d. "%" : $d . "%";
        $this->dashData["pago2WeekPercentDs"] = $ds;
        // print_r($pago1Week);
        // print_r($pago2Week);
        // exit;
        
        // exit;
        // [
        //     'chart2'=> [
        //         'bsico' => [
        //             'name' => "Básico",
        //             'item' => [
        //                 [],
        //                 []
        //             ]
        //         ]
        //     ]
        // ]
        // foreach($this->dashData["assinaturas"] as $identifier => $a) :
        //     if(isset($this->dashData["planList"][$identifier])): 
                
        //         $this->dashData["chart2"]["items"][$identifier]['n'] = count($this->dashData["chart2"]["items"][$identifier]['i']);
        //         // array_push
        //         $this->dashData["chart2"]["labels"] .= '"'.$this->dashData["planList"][$identifier]["name"].'",';
        //         $this->dashData["chart2"]["data"] .= '"'.count($this->dashData["assinaturas"][$identifier]).'",';
        //     endif;
        // endforeach;
        // $this->dashData["chart2"]["labels"] = rtrim($this->dashData["chart2"]["labels"], ',');
        // $this->dashData["chart2"]["data"] = rtrim($this->dashData["chart2"]["data"], ',');
        // print_r($this->dashData["chart2"]);exit;
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args = [];
            $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($this->dashData);exit;
        // print_r(json_decode($r, true));exit;
        return view('dashboard', ["plans" => $planos, "user" => $user, "pd" => $this->pageData, "dd" => $this->dashData]);
    }

    public function planoCreate()
    {
        helper("text");
        session();
        $this->pageData["title"] = "Criar plano";
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args = [];
            $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($user);exit;
        // print_r(json_decode($r, true));exit;
        return view('plan-add', ["pd" => $this->pageData, "user" => $user]);
    }

    public function planoEdit($id)
    {
        helper(['text',"number"]);
        // $this->pageData["title"] = "Planos";
        
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "plans/".$id;
        $args["m"] = "GET";
        // $args["pl"] = [

        // ];
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $this->doRequest($this->requestURL, $args);
        $plano = json_decode($r, true);
        $this->pageData["title"] = "Editar: ".$plano["name"];
        // echo "<pre>";
        // print_r($plano);exit;
        // foreach($planos as $i=>$plan) {
        if(count($plano['prices']) == 1) {
            $plano["price_cents"] = $plano["prices"][0]['value_cents'];
        
            $decimal = number_format(($plano['price_cents'] /100), 0, '.', ' ');
            $plano['decimal'] = $decimal;
            $plano['real'] = number_to_currency($decimal, $plano["prices"][0]['currency'], null, 2);
        }
        // }
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args = [];
            $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($user);exit;
        // print_r(json_decode($r, true));exit;
        return view('plan-edit', ["plan" => $plano, "user" => $user, "pd" => $this->pageData]);
    }

    public function planos()
    {
        helper(['text',"number"]);
        $this->pageData["title"] = "Planos";
        
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "plans";
        $args["m"] = "GET";
        // $args["pl"] = json_encode([
        // ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $this->doRequest($this->requestURL, $args);
        // print_r($r);exit;
        $planos = json_decode($r, true)["items"];
        // echo "<pre>";
        $delPlanModel = new DeletedPlanModel();
        $dp = $delPlanModel->findAll();
        $dpids = [];
        foreach($dp as $p) {
            $dpids[] = $p["plan_id"];
            
        }
        foreach($planos as $i=>$plan) {
            if(!in_array($plan["id"],$dpids)) {
                // echo "entra";
                if(count($plan['prices']) == 1) {
                    $plan["price_cents"] = $plan["prices"][0]['value_cents'];
                
                    $decimal = number_format(($plan['price_cents'] /100), 2, '.', ' ');
                    $planos[$i]['decimal'] = $decimal;
                    $planos[$i]['real'] = number_to_currency($decimal, $plan["prices"][0]['currency'], null, 2);
                }
            } else {
                unset($planos[$i]);
                // echo "não entra";
            }
            
        }
        // print_r($planos);exit;
        session();
        // echo "<pre>";
        // print_r($_SESSION['email']);exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($planos);exit;
        // print_r(json_decode($r, true));exit;
        return view('plans', ["plans" => $planos, "user" => $user, "pd" => $this->pageData]);
    }
    public function perfil()
    {
        helper(['text',"number"]);
        $this->pageData["title"] = "Perfil";
        
        
        // print_r($planos);exit;
        session();
        // echo "<pre>";
        // print_r($_SESSION['email']);exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($planos);exit;
        // print_r(json_decode($r, true));exit;
        return view('perfil', ["user" => $user, "pd" => $this->pageData]);
    }
    public function assinaturas()
    {
        helper(['text',"number"]);
        $this->pageData["title"] = "Assinaturas";
        
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "subscriptions";
        $args["m"] = "GET";
        // $args["pl"] = json_encode([
        // ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $this->doRequest($this->requestURL, $args);
        $assinaturas = json_decode($r, true)["items"];

        

        // print_r($assinaturas);exit;
        // echo "<pre>";
        // $delPlanModel = new DeletedPlanModel();
        // $dp = $delPlanModel->findAll();
        // $dpids = [];
        // foreach($dp as $p) {
        //     $dpids[] = $p["plan_id"];
        // }
        // print_r($assinaturas);exit;
        foreach($assinaturas as $i=>$assinatura) {
            // if(!in_array($assinatura["id"],$dpids)) {
                // echo "entra";
                // print_r($assinatura["recent_invoices"]);exit;
                $assinaturas[$i]['status'] = ($assinatura['suspended']) ? 'suspended' : 'active';
            
                $decimal = number_format(($assinatura['price_cents'] /100), 2, '.', ' ');
                $assinaturas[$i]['decimal'] = $decimal;
                $assinaturas[$i]['real'] = number_to_currency($decimal, $assinatura['currency'], null, 2);
                $date = date_create($assinatura['cycled_at']);

                $expi = date_create($assinatura['expires_at']);
                $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
                // echo $periodo;
                $assinaturas[$i]['periodo'] = $periodo;
            // } else {
                // unset($assinaturas[$i]);
                // echo "não entra";
            // }
            
        }
        // print_r($assinaturas);exit;
        session();
        // echo "<pre>";
        // print_r($_SESSION['email']);exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($assinaturas);exit;
        // print_r(json_decode($r, true));exit;
        return view('assinaturas', ["assinaturas" => $assinaturas, "user" => $user, "pd" => $this->pageData]);
    }
    public function assinatura($id)
    {
        helper(["number", "text"]);
        $this->pageData["title"] = "Detalhes da assinatura";
        $a = new Home();
        // // parent::Controller();
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            // $args = [];
            // $args["m"] = "GET";
            // $this->requestURL = $a->baseApi . "customers";
            // $args["pl"] = json_encode([
            //     "query" => $_SESSION['email'],
            //     "limit" => 1
            // ]);
            // $user = $a->doRequest($this->requestURL, $args);
            // // echo gettype(json_decode($user, true));exit;
            // $u = json_decode($user, true);
            // unset($user);
            // $user = [];
            // if($u["totalItems"] > 0) {
            //     $user = $u['items'][0];
            //     $user["m"] = ellipsize($user["email"], 18);
            // }
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // $petModel = new PetModel();
        // $petAssinatura = $petModel
        //     ->where("cid", $user['id'])
        //     ->where("aid", $id)
        //     ->first();
        // print_r($petAssinatura);exit;
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions/".$id;
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'id' => $id
        ]);
        $assinatura = json_decode($a->doRequest($this->requestURL, $args),true);
        if(isset($assinatura["errors"])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        // print_r($assinatura);exit;
        $args = [];
        $this->requestURL = $a->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'customer_id' => $assinatura["customer_id"]
        ]);
        $assinaturas = json_decode($a->doRequest($this->requestURL, $args),true);
        if(isset($assinaturas["errors"])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        foreach($assinaturas['items'] as $as) {
            if($as["id"] == $id) {
                // print_r($as);
                if(!empty($as['plan_identifier'])) {

                    $args = [];
                    $this->requestURL = $a->baseApi . "plans/identifier/".$as['plan_identifier'];
                    $args["m"] = "GET";
                    $args["pl"] = json_encode([
                        'identifier' => $as['plan_identifier']
                    ]);
                    $p = json_decode($a->doRequest($this->requestURL, $args),true);
                    if(!isset($p["errors"])) {
                        $assinatura["plan_id"] = $p['id'];
                    } 
                }
                $assinatura["plan_ref"] = $as['plan_ref'];
                break;
            }
        };
        // print_r($assinatura);exit;
        // exit;
        // $args = [];
        // $this->requestURL = $a->baseApi . "plans/identifier/".$assinatura["plan_identifier"];
        // $args["m"] = "GET";
        // $args["pl"] = json_encode([
        //     "identifier" => $assinatura["plan_identifier"]
        // ]);
        
        // $plano = $a->doRequest($this->requestURL, $args);
        // $assinatura["plano"] = json_decode($plano, true);
        
        // $decimal = number_format(($assinatura["plano"]["prices"][0]['value_cents'] /100), 2, '.', ' ');
        // $assinatura["plano"]["prices"][0]['decimal'] = $decimal;
        // $assinatura["plano"]["prices"][0]['real'] = number_to_currency($decimal, $assinatura["plano"]["prices"][0]['currency'], null, 2);

        // $assinatura["pet"] = $petAssinatura;
        // print_r($assinatura);exit;
        foreach($assinatura['recent_invoices'] as $i=> $ri): 
            // print_r($ri);
            if(is_numeric($ri['total'])) {
                $decimal = number_format(($ri['total'] /100), 2, '.', ' ');
                $assinatura['recent_invoices'][$i]['decimal'] = $decimal;
            }
            if($ri['status'] == 'paid') {
                $assinatura['recent_invoices'][$i]['status'] = "Pago";
            }
            // 
            // $assinatura['real'] = number_to_currency($decimal, $assinatura['currency'], null, 2);
                // $assinatura['recent_invoices'][$i]['decimal'] = $decimal;
            $due_date = date_create($ri['due_date']);
            $data = $due_date->format('d/m/Y');
            // // echo $due_date;
            $assinatura['recent_invoices'][$i]['data'] = $data;
        endforeach;

        foreach($assinatura['logs'] as $i=> $log): 
            $due_date = date_create($log['created_at']);
            $data = $due_date->format('d/m/Y H:i:s');
            // // echo $due_date;
            $assinatura['logs'][$i]['data'] = $data;
        endforeach;
        // exit;
        // print_r($assinatura['recent_invoices']);exit;
        $decimal = number_format(($assinatura['price_cents'] /100), 2, '.', ' ');
        $assinatura['decimal'] = $decimal;
        // print_r($assinatura);exit;
        $assinatura['real'] = number_to_currency($decimal, $assinatura['currency'], null, 2);
        $date = date_create($assinatura['cycled_at']);
        $expi = date_create($assinatura['expires_at']);
        $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
        // echo $periodo;
        $assinatura['periodo'] = $periodo;
        
        // print_r($assinatura);exit;
        
        return view('assinatura', ["assinatura" => $assinatura,true, "user" => $user, "pd" => $this->pageData]);

    }



    
    public function customers()
    {
        helper(['text',"number"]);
        $this->pageData["title"] = "Clientes";
        
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "customers";
        $args["m"] = "GET";
        // $args["pl"] = json_encode([
        // ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $this->doRequest($this->requestURL, $args);
        $customers = json_decode($r, true)["items"];

        
        $db = \Config\Database::connect('dbpet');
		$query = "SELECT * FROM pets"; 
		
		$pets = $db->query($query)->getResultArray();
        // print_r($qry);exit;
        // echo "<pre>";
        // $delPlanModel = new DeletedPlanModel();
        // $dp = $delPlanModel->findAll();
        $petlist = [];
        foreach($pets as $pet) {
            $petlist[$pet["cid"]][] = $pet;
        }

        $args = [];
        $this->requestURL = $this->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            // "customer_id" => $customer['id']
        ]);
        
        $r = $this->doRequest($this->requestURL, $args);
        $subscriptions = json_decode($r, true)['items'];
        $subscriptionlist = [];
        foreach($subscriptions as $subscription) {
            $subscriptionlist[$subscription["customer_id"]][] = $subscription;
        }
        // print_r($subscriptions);exit;
        // print_r($petlist);
        foreach($customers as $i=>$customer) {
            // print_r($customer["id"]);
            if(isset($petlist[$customer["id"]])) {
                // echo "tem";
                $customers[$i]["pets"] = $petlist[$customer['id']];
            } else {
                // echo "Nao tem";
            }
            if(isset($subscriptionlist[$customer["id"]])) {
                // echo "tem";
                $customers[$i]["assinaturas"] = $subscriptionlist[$customer['id']];
            } else {
                // echo "Nao tem";
            }
            // if(!in_array($customer["id"],$dpids)) {
                // echo "entra";
                // print_r($customer["recent_invoices"]);exit;
                /*
                $decimal = number_format(($customer['price_cents'] /100), 2, '.', ' ');
                $customers[$i]['decimal'] = $decimal;
                $customers[$i]['real'] = number_to_currency($decimal, $customer['currency'], null, 2);
                $date = date_create($customer['cycled_at']);

                $expi = date_create($customer['expires_at']);
                $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
                // echo $periodo;
                $customers[$i]['periodo'] = $periodo; */
            // } else {
                // unset($customers[$i]);
                // echo "não entra";
            // }
            
        }
        session();
        // echo "<pre>";
        // print_r($_SESSION['email']);exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($customers);exit;
        // print_r(json_decode($r, true));exit;
        return view('customers', ["customers" => $customers, "user" => $user, "pd" => $this->pageData]);
    }

    
    public function customer($id)
    {
        helper(['text',"number"]);
        $this->pageData["title"] = "Cliente";
        
        // echo base64_encode($this->k);exit;
        $args = [];
        $this->requestURL = $this->baseApi . "customers";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            'customer_id' => $id
        ]);
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $r = $this->doRequest($this->requestURL, $args);
        $customer = json_decode($r, true)["items"][0];

        
        $db = \Config\Database::connect('dbpet');
		$query = "SELECT * FROM pets where cid = ?"; 
		
		$pets = $db->query($query, $customer["id"])->getResultArray();
        $customer["pets"] = $pets;
        // print_r($customer);exit;
        // echo "<pre>";
        // $delPlanModel = new DeletedPlanModel();
        // $dp = $delPlanModel->findAll();
        // $petlist = [];
        

        $args = [];
        $this->requestURL = $this->baseApi . "subscriptions";
        $args["m"] = "GET";
        $args["pl"] = json_encode([
            "customer_id" => $customer['id']
        ]);
        $r = $this->doRequest($this->requestURL, $args);
        $subscriptions = json_decode($r, true)['items'];
        // print_r($subscriptions);exit;
        $subscriptionlist = [];
        foreach($subscriptions as $subscription) {
            $subscriptionlist[$subscription["id"]][] = $subscription;
        }

        $toStart = [];
        $toEnd = [];
        foreach($customer["pets"] as $i => $pet) {
            // print_r($pet);
            // print_r($subscriptionlist);
            $nasc = date_create($pet['pet_nasc']);
            $pet["nasc_br"] = $nasc->format('d/m/Y');
            if(isset($subscriptionlist[$pet["aid"]])) {
                $ass = $subscriptionlist[$pet["aid"]][0];
                
                $decimal = number_format(($ass['price_cents'] /100), 2, '.', ' ');
                $ass['decimal'] = $decimal;
                $ass['real'] = number_to_currency($decimal, $ass['currency'], null, 2);
                
                $date = date_create($ass['cycled_at']);
                $expi = date_create($ass['expires_at']);
                $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
                // echo $periodo;
                $ass['periodo'] = $periodo;
                $pet["assinatura"] = $ass;
                $toStart[] = $pet;
            } else {
                $toEnd[] = $pet;
            }
        }
        $customer["pets"] = array_merge($toStart, $toEnd);
        // print_r($customer);exit;
        // $customer["pets"][$i]['assinatura'] = $ass;
        
            // if(!in_array($customer["id"],$dpids)) {
                // echo "entra";
                // print_r($customer["recent_invoices"]);exit;
                /*
                $decimal = number_format(($customer['price_cents'] /100), 2, '.', ' ');
                $customers[$i]['decimal'] = $decimal;
                $customers[$i]['real'] = number_to_currency($decimal, $customer['currency'], null, 2);
                $date = date_create($customer['cycled_at']);

                $expi = date_create($customer['expires_at']);
                $periodo = $date->format('d/m/Y') . ' ~ ' . $expi->format('d/m/Y');
                // echo $periodo;
                $customers[$i]['periodo'] = $periodo; */
            // } else {
                // unset($customers[$i]);
                // echo "não entra";
            // }
            
        
        session();
        // echo "<pre>";
        // print_r($_SESSION['email']);exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            /* $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
                $user["m"] = ellipsize($user["email"], 18);
            } */
            $UsersModel = new UserModel();
        
            $email = $_SESSION['email'];
            
            
            $user = $UsersModel->where('email', $email)->first();
            $user["m"] = ellipsize($user["email"], 18);
        } else {
            $user = [];
        }
        // print_r($customer);exit;
        // print_r(json_decode($r, true));exit;
        return view('customer', ["customer" => $customer, "user" => $user, "pd" => $this->pageData]);
    }
    public function mailTeste() {
        $conf = [
            'name' => "marcelo",
            'code' => '132 123'
        ];
        return view("mail/codConfirm", $conf);
    }
    public function getCEP() {
        // $rdata = (array) $this->request->getPost();
        // if(empty($rdata)) {
        //     $rdata = (array) $this->request->getJSON();
        // }
        // $cep = isset($rdata["cep"]) ? $rdata["cep"] : null;
        // echo json_encode([
        //     'cep' => $cep
        // ]);exit;
        $rdata = (array) $this->request->getPost();
        if(empty($rdata)) {
            $rdata = (array) $this->request->getJSON();
        }
        $cep = isset($rdata["cep"]) ? $rdata["cep"] : null;
        if(!is_null($cep)) {
            $curl = curl_init();
            $data = [
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                
                CURLOPT_URL => $this->cepApi,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    'cep' => $cep
                ]),
                CURLOPT_HTTPHEADER => [
                    'Accept: application/json',
                    'Content-Type: application/json'
                ]
            ];
           
            curl_setopt_array($curl, $data);
            // echo "<pre>";
            // print_r(curl_getinfo($curl));exit;
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
        }
    }
    public function assinar($id)
    {
        // // parent::Controller();
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        
        $args = [];
        $this->requestURL = $this->baseApi . "plans/".$id;
        $args["m"] = "GET";
        // $args["pl"] = [

        // ];
        // if(in_array($rdata->method, ["POST", "PUT"]) && !isset($rdata->payload)) {
        //     throw new \Exception("invalid payload");
        // } else if(in_array($rdata->method, ["POST", "PUT"]) && isset($rdata->payload)) {
        //     $args["pl"] = json_encode($rdata->payload);
        // }
        $plano = $this->doRequest($this->requestURL, $args);
        $user_default_payment = NULL;
        $pets = [];
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }


            $petModel = new PetModel();
            $cid = (empty($user))? '' : $user["id"];
            $pets = $petModel->where('cid', $cid)->findAll();

            
            $dft_pmt = NULL; 
            if(isset($user["default_payment_method_id"]) &&
            !empty($user["default_payment_method_id"])) {
                $dft_pmt = $user["default_payment_method_id"];
            }
                // echo "<pre>";
                // print_r($user);
            if(isset($user["payment_methods"]) && 
            !empty($user["payment_methods"])) {
                foreach($user["payment_methods"] as $pm) {
                    if($pm["id"] == $dft_pmt) {
                        $user_default_payment = $pm;
                        break;
                    }
                }
            }
            $address = [];
            $address["rua"] = '';
            $address["rua"] .= (!empty($user["street"])) ? $user["street"] : '[Não informado]';
            $address["rua"] .= (strlen($user["number"]) > 0) ? ', '.$user["number"] : '[S/N]';
            $address["rua"] .= $user["complement"];
            $address["bairro"] = '';
            $address["bairro"] .= (!empty($user["district"])) ? $user["district"] : '[Não informado]';
            $address["cidade"] = '';
            $address["cidade"] .= (!empty($user["city"])) ? $user["city"] : '[Não informado]';
            $address["estado"] = '';
            $address["estado"] .= (!empty($user["state"])) ? $user["state"] : '[Não informado]';

            $user["address"] = $address;

            
        } else {
            $user = [];
        }
        $items = file_get_contents(ROOTPATH."/content/estados.json");
        $estados = json_decode($items, false); 
        // print_r($user);exit;
        
        // print_r($user_default_payment);exit;
            // echo "</pre>";
        
        // if(isset($user["custom_variables"]) && !empty($user["custom_variables"])) {
        //     $cf_refs = [
        //         'pet_name' => [
        //             'display' => "Nome do Pet",
        //         ],
        //         'pet_peso' => [
        //             'display' => "Peso",
        //         ],
        //         'pet_raca' => [
        //             'display' => "Raça",
        //         ],
        //         'pet_nasc' => [
        //             'display' => "Nascimento",
        //         ],
        //     ];
        //     $user["pet_data"] = [];
        //     foreach($user["custom_variables"] as $v) {
        //         $cf_refs[$v["name"]]["value"] = $v["value"];
        //         // print_r($cf_refs);
        //         $user["pet_data"][] = $cf_refs[$v["name"]];
        //     }
            
        // }

        
        // $args__ = [];
        // $args__["m"] = "GET";
        // $args__["pl"] = json_encode([
        //     "customer_id" => $user["id"]
        // ]);
        // $this->requestURL = $this->baseApi . 'customers/'.$user["id"].'/payment_methods';
        // // print_r($this->requestURL);exit;
        // // print_r($args__);
        // // exit;
        // $payment_forms = $this->doRequest($this->requestURL, $args__);
        // // echo gettype(json_decode($payment_forms, true));exit;
        // $pf = json_decode($payment_forms, true);
        // print_r($pf);
        // exit;
        
        // echo "<pre>";
        // print_r(json_decode($user, true));;
        // print_r(json_decode($plano, true));exit;
        return view('assinar', ["estados" => $estados, "plan" => json_decode($plano), "user" => $user, "payment"=>$user_default_payment, "pets" => $pets]);

    }

    public function services()
    {
        // echo base64_encode($this->k);exit;
        
        session();
        // echo "<pre>";print_r($a->get("name"));exit;
        if(isset($_SESSION['email'])) {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            $args = [];
            $args["m"] = "GET";
            $this->requestURL = $this->baseApi . "customers";
            $args["pl"] = json_encode([
                "query" => $_SESSION['email'],
                "limit" => 1
            ]);
            $user = $this->doRequest($this->requestURL, $args);
            // echo gettype(json_decode($user, true));exit;
            $u = json_decode($user, true);
            unset($user);
            $user = [];
            if($u["totalItems"] > 0) {
                $user = $u['items'][0];
            }
        } else {
            $user = [];
        }
        return view('services', ['user' => $user]);
    }

    public function doRequest($url, $args) {

        // echo "<pre>";
        // print_r($args);exit;
        // echo $this->k;
        // print_r($args);exit;
        $curl = curl_init();
        $data = [
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $args["m"],
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic '.$this->k,
                'Accept: application/json',
                'Content-Type: application/json'
            ]
        ];
        if(isset($args["pl"])) {
            $data[CURLOPT_POSTFIELDS] = $args["pl"];
        }
        curl_setopt_array($curl, $data);
        // echo "<pre>";
        // print_r(curl_getinfo($curl));exit;
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function api() {
        
        $rdata = (array) $this->request->getPost();
        if(empty($rdata)) {
            $rdata = (array) $this->request->getJSON();
        }
        // $rdata = (array) $this->request->getJSON();
        // var_dump($rdata);exit;
        try {
            $args = [];
            if(isset($rdata["call"])) {
                if($rdata["call"] == "payment_methods") {
                    $session = session();
                    $session->get('email');
                    $args_ = [];
                    $args_["m"] = "GET";
                    $this->requestURL = $this->baseApi . "customers";
                    $args_["pl"] = json_encode([
                        "query" => $session->get('email'),
                        "limit" => 1
                    ]);
                    $user = $this->doRequest($this->requestURL, $args_);
                    // echo gettype(json_decode($user, true));exit;
                    $u = json_decode($user, true)["items"][0];
                    // var_dump($u);exit;
                    // echo json_encode($u);
                    $this->requestURL = $this->baseApi . "customers/".$u["id"]."/".$rdata["call"];
                    $rdata["payload"]["set_as_default"] = true;
                    $rdata["payload"]["customer_id"] = $u["id"];
                    $rdata["payload"]["description"] = "Teste";


                    $args_cc = [];
                    $args_cc["m"] = "POST";
                    $args_cc["pl"] = json_encode($rdata["payload"]);

                    $r = $this->doRequest($this->requestURL, $args_cc);
                    $rr = json_decode($r, true);
                    if(isset($rr["errors"])) {
                        return $this->response->setJSON([
                            "error" => true,
                            "message" => "Erro ao salvar cartão",
                            "response" => $rr
                        ]);
                    } else {
                        $args_ = [];
                        $args_["m"] = "GET";
                        $this->requestURL = $this->baseApi . "customers";
                        $args_["pl"] = json_encode([
                            "query" => $session->get('email'),
                            "limit" => 1
                        ]);
                        $user = $this->doRequest($this->requestURL, $args_);
                        // echo gettype(json_decode($user, true));exit;
                        $u = json_decode($user, true)["items"][0];
                        $rr["cardCount"] = count($u["payment_methods"]);
                        return $this->response->setJSON([
                            "error" => false,
                            "message" => "Cartão salvo com sucesso",
                            "response_data" => $rr
                        ]);
                    }
                    
                    // echo $this->requestURL;
                    // exit;
                } else if ($rdata["call"] == "subscriptions" && $rdata["method"] == "POST") {
                    $this->requestURL = $this->baseApi . $rdata["call"];
                    // print_r($rdata);exit;
                    $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    $rdata["payload"]["only_charge_on_due_date"] = true;
                    $rdata["payload"]["only_on_charge_success"] = true;
                    $args = [];
                    $args["m"] = "POST";
                    $args["pl"] = json_encode($rdata["payload"]);
                    $rr = json_decode($this->doRequest($this->requestURL, $args),true);
                    if(isset($rr["errors"])) {
                        return $this->response->setJSON([
                            "error" => true,
                            "message" => "Erro ao criar assinatura!",
                            "response_data" => $rr
                        ]);
                    } else {
                        // $rdata["payload"]["two_step"] = true;
                        // print_r($rr);exit;
                        $petModel = new PetModel();

                        $d = [
                            'aid' => $rr["id"]
                        ];
                        $petModel->update($rdata["pet_id"], $d);

                        
                        return $this->response->setJSON([
                            "error" => false,
                            "message" => "Assinatura efetuada com sucesso!",
                            "response_data" => $rr
                        ]);
                        // print_r($assinatura);
                        exit;
                    }
                } else if (preg_match_all('/^subscriptions.*suspend$/', $rdata["call"]) && $rdata["method"] == "POST") {
                    $this->requestURL = $this->baseApi . "subscriptions/" . $rdata["payload"]['id'] ."/suspend";
                    // print_r($rdata);
                    $args = [];
                    $args["m"] = "POST";
                    $args["pl"] = json_encode($rdata["payload"]);
                    $assinatura = json_decode($this->doRequest($this->requestURL, $args),true);
                    foreach($assinatura['logs'] as $i=> $log): 
                        $due_date = date_create($log['created_at']);
                        $data = $due_date->format('d/m/Y H:i:s');
                        // // echo $due_date;
                        $assinatura['logs'][$i]['data'] = $data;
                    endforeach;
                    return $this->response->setJSON($assinatura);
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^plans/', $rdata["call"]) && $rdata["method"] == "DELETE") {
                    $this->requestURL = $this->baseApi . "plans/" . $rdata["payload"]['id'];
                    // print_r($rdata);
                    $args = [];
                    $args["m"] = $rdata["method"];
                    $args["pl"] = json_encode($rdata["payload"]);
                    // print_r($args);
                    // print_r($this->requestURL);exit;
                    
                    $deletePlan = json_decode($this->doRequest($this->requestURL, $args),true);
                    if(gettype($deletePlan) == 'array' && isset($deletePlan['id'])) {
                        // echo "entrou";
                        $delPlanModel = new DeletedPlanModel();
                        $d = [
                            "plan_id" => $deletePlan["id"]
                        ];
                        try {
                            $delPlanModel->save($d);
                            $delPlanModel->where("timestampdiff(hour, deleted_at, current_timestamp) > 1")->delete();
                        } catch(\Exception $e) {
                            print_r($e);exit;
                        }
                    }
                    return $this->response->setJSON($deletePlan);
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^subscriptions.*activate$/', $rdata["call"]) && $rdata["method"] == "POST") {
                    $this->requestURL = $this->baseApi . "subscriptions/" . $rdata["payload"]['id'] ."/activate";
                    $args = [];
                    $args["m"] = "POST";
                    $args["pl"] = json_encode($rdata["payload"]);
                    $assinatura = json_decode($this->doRequest($this->requestURL, $args),true);
                    // print_r($assinatura);exit;
                    foreach($assinatura['logs'] as $i=> $log): 
                        $due_date = date_create($log['created_at']);
                        $data = $due_date->format('d/m/Y H:i:s');
                        // echo "DUO" .$due_date;
                        $assinatura['logs'][$i]['data'] = $data;
                    endforeach;
                    
                    return $this->response->setJSON($assinatura);
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^customers.*payment_methods.*/', $rdata["call"]) && $rdata["method"] == "DELETE") {
                    session();
                    if(isset($_SESSION['email'])) {
                        // echo "<pre>";
                        // print_r($_SESSION);
                        // echo "</pre>";
                        $args = [];
                        $args["m"] = "GET";
                        $this->requestURL = $this->baseApi . "customers";
                        $args["pl"] = json_encode([
                            "query" => $_SESSION['email'],
                            "limit" => 1
                        ]);
                        $user = $this->doRequest($this->requestURL, $args);
                        // var_dump($user);exit;
                        $u = json_decode($user, true);
                        unset($user);
                        $user = [];
                        if($u["totalItems"] > 0) {
                            $user = $u['items'][0];
                        }

                        $this->requestURL = $this->baseApi . "customers/" . $user['id'] ."/payment_methods/".$rdata["payload"]['id'];
                        // print_r($this->requestURL);exit;
                    } 
                    
                    // return $this->response->setJSON($this->requestURL);
                    // exit;
                    // $rdata["payload"]["suspend_on_invoice_expired"] = true;
                    // $rdata["payload"]["only_charge_on_due_date"] = false;
                    // $rdata["payload"]["only_on_charge_success"] = true;
                } else if (preg_match_all('/^customers.*/', $rdata["call"]) && $rdata["method"] == "PUT") {
                    session();
                    if(isset($_SESSION['email'])) {
                        // echo "<pre>";
                        // print_r($_SESSION);
                        // echo "</pre>";
                        $args = [];
                        $args["m"] = "GET";
                        $this->requestURL = $this->baseApi . "customers";
                        $args["pl"] = json_encode([
                            "query" => $_SESSION['email'],
                            "limit" => 1
                        ]);
                        $user = $this->doRequest($this->requestURL, $args);
                        // var_dump($user);exit;
                        $u = json_decode($user, true);
                        unset($user);
                        $user = [];
                        if($u["totalItems"] > 0) {
                            $user = $u['items'][0];
                        }
                        $args = [];
                        $args["m"] = "PUT";
                        $rdata["payload"]["default_payment_method_id"] = $rdata["payload"]['id'];
                        $args["pl"] = json_encode($rdata["payload"]);
                        
                        $this->requestURL = $this->baseApi . "customers/" . $user['id'];
                        $user = json_decode($this->doRequest($this->requestURL, $args),true);
                        // print_r($user);exit;
                        
                        
                        return $this->response->setJSON($user);
                        
                    }
                } else {
                    // echo "else";
                    // print_r($rdata);
                    $this->requestURL = $this->baseApi . $rdata["call"];
                }
                
                
            } else {
                throw new \Exception("invalid call");
            }
        } catch (\Exception $e) {
            
        }
        
        if(isset($rdata["method"])) {
            $args["m"] = $rdata["method"];
        } else{
            throw new \Exception("invalid method");
        }
        if(in_array($rdata["method"], ["POST", "PUT"]) && !isset($rdata["payload"])) {
            throw new \Exception("invalid payload");
        } else if(in_array($rdata["method"], ["POST", "PUT"]) && isset($rdata["payload"])) {
            
            $args["pl"] = json_encode($rdata["payload"]);
        }
        
        // print_r($this->requestURL);exit;
        // $this->requestURL = $this->baseApi . $rdata['call'];
        // $pl = $rdata['payload'];
        $r = $this->doRequest($this->requestURL, $args);
        
        print_r($r);
        
    }
}