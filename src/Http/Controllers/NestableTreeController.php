<?php
namespace Gtrig\NestableTree\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\SortableCategoryCollection;
use Gtrig\NestableTree\Services\ListService;

class NestableTreeController extends Controller
{
    public function load(Request $request, $resource)
    {
        $ls = new ListService($resource);
        $list = $ls->getCollection();
        return response()->json($list, 200);
    }

    public function update(Request $request, $resource)
    {
        $ls = new ListService($resource);
        $count = $ls->updateOrder($request->input('list'));
        
        return response('Successfully updated '.$count.' entries', 200);
    }

    
}