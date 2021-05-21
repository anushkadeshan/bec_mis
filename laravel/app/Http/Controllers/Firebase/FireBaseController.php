<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morrislaptop\Firestore\Factory;
use Kreait\Firebase\ServiceAccount;
use \Kreait\Firebase\Firestore;
use Kreait\Firebase\Auth;
use Google\Cloud\Firestore\FirestoreClient;
class FireBaseController extends Controller
{

    function distVincenty($lat1, $lon1, $lat2, $lon2)
    {
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $lon1 = deg2rad($lon1);
        $lon2 = deg2rad($lon2);

        $a = 6378137;
        $b = 6356752.3142;
        $f = 1 / 298.257223563; // WGS-84 ellipsoid

        $L = $lon2 - $lon1;

        $U1 = atan((1 - $f) * tan($lat1));
        $U2 = atan((1 - $f) * tan($lat2));

        $sinU1 = sin($U1);
        $cosU1 = cos($U1);
        $sinU2 = sin($U2);
        $cosU2 = cos($U2);

        $lambda = $L;
        $lambdaP = 2 * M_PI;

        $iterLimit = 20;

        while (abs($lambda - $lambdaP) > 1e-12 && --$iterLimit > 0) {
            $sinLambda = sin($lambda);
            $cosLambda = cos($lambda);
            $sinSigma  = sqrt(($cosU2 * $sinLambda) * ($cosU2 * $sinLambda) +
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda) *
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda));

            if ($sinSigma == 0) return 0; // co-incident points

            $cosSigma   = $sinU1 * $sinU2 + $cosU1 * $cosU2 * $cosLambda;
            $sigma      = atan2($sinSigma, $cosSigma); // was atan2
            $alpha      = asin($cosU1 * $cosU2 * $sinLambda / $sinSigma);
            $cosSqAlpha = cos($alpha) * cos($alpha);
            $cos2SigmaM = $cosSigma - 2 * $sinU1 * $sinU2 / $cosSqAlpha;
            $C          = $f / 16 * $cosSqAlpha * (4 + $f * (4 - 3 * $cosSqAlpha));
            $lambdaP    = $lambda;
            $lambda     = $L + (1 - $C) * $f * sin($alpha) *
                ($sigma + $C * $sinSigma * ($cos2SigmaM + $C * $cosSigma *
                    (-1 + 2 * $cos2SigmaM * $cos2SigmaM)));
        }
        if ($iterLimit == 0) return false; // formula failed to converge

        $uSq = $cosSqAlpha * ($a * $a - $b * $b) / ($b * $b);
        $A   = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $B   = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));

        $deltaSigma = $B * $sinSigma * ($cos2SigmaM + $B / 4 * ($cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM) -
            $B / 6 * $cos2SigmaM * (-3 + 4 * $sinSigma * $sinSigma) * (-3 + 4 * $cos2SigmaM * $cos2SigmaM)));

        $s = $b * $A * ($sigma - $deltaSigma);

        $s = round($s, 3); // round to 1mm precision

        return $s;
    }

    public function firebaseConnect(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        return $firebase;
    }

    public function index(){
        $auth_users = $this->firebaseConnect()->getAuth();
        $users = $auth_users->listUsers();
        $userCount = iterator_count($users);

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        $firestore = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createFirestore();

        $sessions = $firestore->collection('sessions');
        $snapshot_sessions = $sessions->documents();
        $session_count = iterator_count($snapshot_sessions);
       // dd($snapshot_sessions);


        return view('Firebase.index',compact('userCount', 'session_count', 'snapshot_sessions'));
    }

    public function disableUsers(Request $request){
        $auth = $this->firebaseConnect()->getAuth();
        $uid = $request->uid;
        if($request->status=='true'){
            $updatedUser = $auth->disableUser($uid);
        }
        else{
            $updatedUser = $auth->enableUser($uid);
        }

        return redirect()->back();

    }

    public function deleteUsers($uid)
    {
        $auth = $this->firebaseConnect()->getAuth();
        $updatedUser = $auth->deleteUser($uid);
        return redirect()->back();
    }

    public function authUsers(){
        $auth_users = $this->firebaseConnect()->getAuth();
        $users = $auth_users->listUsers();

        return view('Firebase.users', compact('users'));
    }

    public function staff()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        $firestore = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createFirestore();
        $users = $firestore->collection('users');
        //dd($users);
        $snapshot_users = $users->documents();
        return view('Firebase.staff', compact('snapshot_users'));
    }

    public function sessions()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        $firestore = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createFirestore();
        $sessions = $firestore->collection('sessions');
        //dd($sessions);
        $snapshot_sessions = $sessions->documents();

        //dd(iterator_count($snapshot_sessions));
        return view('Firebase.sessions', compact('snapshot_sessions'));
    }
    public function ViewSession($uid,$id){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        $firestore = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->createFirestore();
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
       // dd($firebase);
        $users = $firestore->collection('users');
        $user_document = $users->document($uid);
        $user = $user_document->snapshot();

        $sessions= $firestore->collection('sessions');
        $session_documents = $sessions->documents();

        $session = [];
        foreach($session_documents as $sd){
            if($sd->data()['id']==$id){
                $session = $sd->data();
            }
        }

        $distance = $this->distVincenty($session['start_lat'], $session['start_long'], $session['end_lat'], $session['end_long']);
       // dd($session,$user, $distance/1000);

        return view('Firebase.sessionView', compact('user', 'session', 'distance'));

    }

    public function StaffSessions($uid){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        $firestore = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->createFirestore();
        $sessions = $firestore->collection('sessions');
        //dd($sessions);
        $snapshot_sessions = $sessions->documents();

        return view('Firebase.StaffSessions',compact('snapshot_sessions','uid'));

    }
    public function users(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/Firebase.json');
        //dd($serviceAccount);
        $firestore = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->createFirestore();

        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->create();

        $collection = $firestore->collection('users');
        $snapshot = $collection->documents();

        $user = $collection->document('H9qwywM8OCgqQIV3UzQFS44FTFE3');
        $user->set(['epf' => '300','name' => 'Anushka Deshan', 'district'=> 'Colombo']);
        $auth = $firebase->getAuth();


        $users = $auth->listUsers();

        $userCount = iterator_count($users);
        // dd($users, $userCount);
        $sessions = $firestore->collection('sessions');
        $snapshot_sessoion = $sessions->documents();

        dd($snapshot, $snapshot_sessoion);
    }


}
