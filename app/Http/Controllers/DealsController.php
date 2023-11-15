<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealsRequest;
use App\Http\Requests\PropertiesRequest;
use App\Services\DealsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Deal;

class DealsController extends Controller
{
    public function __construct(protected DealsServices $dealsServices)
    {}

    public function index(): View
    {
        $deals = $this->dealsServices->getDealsByUserId(Auth::user()->getAuthIdentifier());

        return \view('user/deals', ['deals' => $deals]);
    }

    public function store(DealsRequest $request)
    {

        $save = $this->dealsServices->createDeal($request);
        if ($save) {
            return redirect()->route('user.deals.index');
        }
        return back()->with('error', 'Не удалось забронировать');
    }

    public function destroy(Deal $deal) {
        if ($deal->delete()) {
            return redirect()->route('user.deals.index')->with('success', 'Заявка на бронирование успешно удалена');
        }
        return redirect()->route('user.deals.index')->with('error', 'Не удалось удалить заявка на бронирование');
    }

}
