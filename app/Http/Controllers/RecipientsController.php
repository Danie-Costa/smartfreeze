<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Recipient;

class RecipientsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $recipients = Recipient::orderBy("id", "ASC");

        if ($param = $request->search) {
            $recipients->where("title", "LIKE", "%{$param}%");
        }

        $recipients->paginate(20);
        $recipients = $recipients->get();
        
        return view("admin.recipients.index", compact("recipients"));
    }

    public function create()
    {
        $recipient = new Recipient();
        $route = "recipients";
        $title = "Novo usuário";
        $data = $recipient;
        return view("admin.automatic.create", compact("data","route","title"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request['company_id'] = GetMayCompanyId();
            Recipient::create($request->all());
            DB::commit();
            return redirect()->route("admin.recipients.index")->with("success", "Item cadastrado com sucesso!");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $recipient = Recipient::findOrFail($id);
        $route = "recipients";
        $title = "Ver usuário";
        $data = $recipient;
        return view("admin.automatic.show", compact("data","route","title"));
    }

    public function edit($id)
    {
        $recipient = Recipient::findOrFail($id);
        $route = "recipients";
        $title = "Editar usuário";
        $data = $recipient;
        return view("admin.automatic.edit", compact("data","route","title"));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $recipient = Recipient::findOrFail($id);
            $recipient->update($request->all());
            DB::commit();
            return redirect()->route("admin.recipients.index");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $recipient = Recipient::findOrFail($id);
        $recipient->delete();
        return redirect()->route("admin.recipients.index");
    }
}
