<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.contact.contact');
    }

    /**
     * display all of the contacts
     */

    public function all()
    {
        return view('admin.contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'view' => 0
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $contact->update(['view' => 1]);
        return view('admin.contact.show', compact('contact'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect("/admin-panel/contacts/");
    }

    /**
     * delete messages aleardy read
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteReadMessages()
    {
        Contact::where('view', '=', 1)->delete();
        return response(['msg' => ' تم حذف جميع الرسائل المقروءة'], 200);
    }

    /**
     * delete all the table
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        Contact::truncate();
        return response(['msg' => 'تم حذف جميع الرسائل'], 200);
    }

    /**
     * make message not read (new)
     * @param Concat $contact
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function notRead(Contact $contact)
    {
        $contact->update(['view' => 0]);
        return response(['msg' => 'هذه الرسالة اصبحت غير مقروءة'], 200);
    }

    /**
     * return datatables with contacts data
     * @return mixed
     * @throws \Exception
     */
    public function allMessages()
    {
        $contact = Contact::all();

        return Datatables::of($contact)
            ->editColumn('name', function ($model) {
                return '<a href="' . url('/admin-panel/contacts/' . $model->id . '/show') . '">' . $model->name . '</a>';
            })
            ->editColumn('subject', function ($model) {
                return '<span class="badge badge-info">' . $model->subject . '</span>';
            })
            ->editColumn('view', function ($model) {
                return $model->view == 0 ? '<span class="badge badge-info">' . 'جديدة' . '</span>' : '<span class="badge badge-warning">' . 'قديمة' . '</span>';
            })
            ->editColumn('control', function ($model) {
                $all = '';

                $all .=
                    '<form action="' . url('/admin-panel/contacts') . '/' . $model->id . '" method="post">'
                    . method_field("delete")
                    . csrf_field() . '
                          <button class="btn btn-danger btn-circle delete" style="margin-top: 5px">  <i class="fa fa-trash-o"></i>  </button>
                          </form>';

                return $all;
            })->escapeColumns([])
            ->make(true);

    }

}
