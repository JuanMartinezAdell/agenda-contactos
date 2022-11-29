<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

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
        $contacts = Contact::all();

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
    public function store()
    {
        //
        Contact::create(
            Request::validate([
                'name' => ['required', 'max:50'],
                'organization_id' => ['max:50'],
                'position_id' => ['max:50'],
                'service_id' => ['max:50'],
                'location_id' => ['max:50'],
                'phone' => ['min:9', 'max:50'],
                'short_phone' => ['min:6', 'max:6'],
                'phone_code' => ['min:4', 'max:4'],
                'email' => ['max:50', 'email'],
                'description' => ['max:100'],
            ])
        );

        return Redirect::route('contacts.create');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        return Inertia::render('Contacts/EditContacts', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
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
    }
}
