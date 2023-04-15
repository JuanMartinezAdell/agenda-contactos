<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Organization;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filters = $request->all('search');

        //return $filters;

        $contacts = Contact::with(['organization', 'position', 'service', 'location'])
            ->filter($filters)
            ->latest('id')
            ->paginate();

        // return $contacts;

        return Inertia::render('Contacts/IndexContacts', compact('contacts', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $contacts = \App\Models\Contact::all();
        $organizations = \App\Models\Organization::all();
        $positions = \App\Models\Position::all();
        $services = \App\Models\Service::all();
        $locations = \App\Models\Location::all();

        return Inertia::render('Contacts/CreateContacts', compact('organizations', 'positions', 'services', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'max:50'],
            'organization_id' => ['required', 'max:50'],
            'position_id' => ['required', 'max:50'],
            'service_id' => ['required', 'max:50'],
            'location_id' => ['required', 'max:50'],
            'phone' => ['required', 'unique:contacts', 'max:50'],
            'short_phone' => ['required', 'unique:contacts', 'max:50'],
            'phone_code' => ['required', 'max:50'],
            'email' => ['required', 'unique:contacts', 'max:50', 'email'],
            'description' => ['required'],
        ]);

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->organization_id = $request->organization_id;
        $contact->position_id = $request->position_id;
        $contact->service_id = $request->service_id;
        $contact->location_id = $request->location_id;
        $contact->phone = $request->phone;
        $contact->short_phone = $request->short_phone;
        $contact->phone_code = $request->phone;
        $contact->email = $request->email;
        $contact->description = $request->description;
        $contact->save();
        sleep(1);

        return redirect()->route('contacts.index');

        /*Contact::create($request->all());
        sleep(1);

        return redirect()->route('contacts.index')->with('message', 'Contacto Creado Correctamente');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
        $contacts = \App\Models\Contact::all();
        $organizations = \App\Models\Organization::all();
        $positions = \App\Models\Position::all();
        $services = \App\Models\Service::all();
        $locations = \App\Models\Location::all();

        return Inertia::render(
            'Contacts/EditContacts',
            //compact('organizations', 'positions', 'services', 'locations'),
            [
                'contact' => $contact
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     **/

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $request->validate([
            'name' => ['required', 'max:50'],
            'organization_id' => ['required', 'max:50'],
            'position_id' => ['required', 'max:50'],
            'service_id' => ['required', 'max:50'],
            'location_id' => ['required', 'max:50'],
            'phone' => ['required', 'max:50'],
            'short_phone' => ['required', 'max:50'],
            'phone_code' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
            'description' => ['required'],
        ]);

        $contact = Contact::find($request->id);
        $contact->name = $request->name;
        $contact->organization_id = $request->organization_id;
        $contact->position_id = $request->position_id;
        $contact->service_id = $request->service_id;
        $contact->location_id = $request->location_id;
        $contact->phone = $request->phone;
        $contact->short_phone = $request->short_phone;
        $contact->phone_code = $request->phone;
        $contact->email = $request->email;
        $contact->description = $request->description;
        $contact->save();
        sleep(1);

        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();
        return redirect()->route('contacts.index');
    }
}
