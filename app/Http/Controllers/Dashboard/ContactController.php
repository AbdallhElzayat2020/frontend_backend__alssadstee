<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('dashboard.pages.contacts.index', compact('contacts'));
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('dashboard.contacts.index')
            ->with('success', 'deleted successfully');
    }
}
