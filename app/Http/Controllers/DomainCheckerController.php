<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Embed\Embed;

class DomainCheckerController extends Controller
{
    public function viewDomainChecker(Request $request)
    {
        $count = DB::select('SELECT COUNT(*) FROM domains')[0]->{'COUNT(*)'};
        $domain_input = $request->input('domain');
        $available = null;
        $domain_detail = null;

        if ($domain_input) {
            if (!str_ends_with($domain_input, '.sk')) {
                $domain_input .= '.sk';
            }
            if (substr($domain_input, 0, 4) === 'www.') {
                $domain_input = substr($domain_input, 4);
            }

            $domain_detail = DB::select('SELECT * FROM domains WHERE domain_name = ?', [$domain_input])[0] ?? null;

            if ($domain_detail) {
                $available = false;
            } else {
                $available = true;
            }
        }

        return view('domain_checker', ['available' => $available, 'domain_input' => $domain_input, 'domain_detail' => $domain_detail, 'count' => $count]);
    }

    public function viewDomains(Request $request)
    {
        $column = $request->input('column');
        $direction = $request->input('direction');

        $search = $request->input('search');

        $search ? $domains = DB::TABLE('domains')
            ->where('domain_name', 'like', "%${search}%")
            ->orWhere('registrar_id', 'like', "%${search}%")
            ->orWhere('registrant_id', 'like', "%${search}%")
            ->orWhere('domain_status', 'like', "%${search}%")
            ->orWhere('NS1', 'like', "%${search}%")
            ->orWhere('NS2', 'like', "%${search}%")
            ->orWhere('NS3', 'like', "%${search}%")
            ->orWhere('NS4', 'like', "%${search}%")
            ->orWhere('expiration_date', 'like', "%${search}%")
            : $domains = DB::table('domains');

        return $column && $direction
            ? view('domains_list', ['domains' => $domains->orderBy($column, $direction)->paginate(20)])
            : view('domains_list', ['domains' => $domains->paginate(20)]);
    }

    public function viewRegistrant(Request $request, $id)
    {
        return view('registrant_detail', ['domains' => DB::table('domains')->where('registrant_id', '=', $id)->paginate(20), 'registrant' => $id]);
    }
}
