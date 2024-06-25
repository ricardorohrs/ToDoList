<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Builder[]
     */
    public function index(): array|Collection
    {
        return Item::query()->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Item
     */
    public function store(Request $request): Item
    {
        $newItem = new Item;
        $newItem->content = $request->input('item.content');
        $newItem->save();

        return $newItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response|string
     */
    public function update(Request $request, int $id): Response|string
    {
        $existingItem = Item::query()->find($id);

        if ($existingItem) {
            $existingItem->completed = (bool)$request->input('item.completed');
            $existingItem->completed_at = $request->input('item.completed') ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }

        return "Item não encontrado!";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy(int $id): string
    {
        $existingItem = Item::query()->find($id);

        if ($existingItem) {
            $existingItem->delete();
            return "Item excluído com sucesso!";
        }

        return "Item não encontrado.";
    }
}
