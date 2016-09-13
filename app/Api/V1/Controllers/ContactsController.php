<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Contacts;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class ContactsController extends Controller {

    use Helpers;

    public function index() {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
                        ->contacts()
                        ->orderBy('created_at', 'DESC')
                        ->get()
                        ->toArray();
    }

    public function store(Request $request) {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $contact = new Contacts;

        $user = \Auth::User();
        $contact->mobile = \DB::table('users')
                ->select('mobile')
                ->where('id', $user->id)
                ->value('mobile');

        $contact->name = $request->get('name');
        $contact->phonetic_name = $request->get('phonetic_name');
        $contact->nick_name = $request->get('nick_name');
        $contact->photo = $request->get('photo');
        $contact->mobile_no = $request->get('mobile_no');
        $contact->type = $request->get('type');
        $contact->phone = $request->get('phone');
        $contact->email = $request->get('email');
        $contact->address = $request->get('address');
        $contact->date = $request->get('date');
        $contact->birthdate = $request->get('birthdate');
        $contact->company = $request->get('company');
        $contact->title = $request->get('title');
        $contact->notes = $request->get('notes');
        $contact->im = $request->get('im');
        $contact->sip = $request->get('sip');
        $contact->group_name = $request->get('group_name');
        $contact->website = $request->get('website');
        $contact->relationship = $request->get('relationship');

        if ($currentUser->contacts()->save($contact))
            return response()->json(['message' => 'contact_added', 'status_code' => '1']);
        //return $this->response->created();
        else
            return response()->json(['message' => 'could_not_add_contact', 'status_code' => '0']);
        //return $this->response->error('could_not_create_book', 500);
    }

}
