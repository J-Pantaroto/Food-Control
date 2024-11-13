<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Produto;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{
    public function create($pedidoId)
    {
        $pedido = Pedido::findOrFail($pedidoId);
        $produtos = Produto::all();
        return view('itens_pedido.create', compact('pedido', 'produtos'));
    }

    public function store(Request $request, $pedidoId)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco' => 'required|numeric',
        ]);

        $itemPedido = new ItemPedido($request->all());
        $itemPedido->pedido_id = $pedidoId;
        $itemPedido->save();

        // Atualiza o valor total do pedido
        $pedido = Pedido::findOrFail($pedidoId);
        $pedido->valor_total += $itemPedido->preco * $itemPedido->quantidade;
        $pedido->save();

        return redirect()->route('pedido.show', $pedidoId)->with('success', 'Item adicionado ao pedido com sucesso!');
    }

    public function edit($id)
    {
        $itemPedido = ItemPedido::findOrFail($id);
        $produtos = Produto::all();
        return view('itens_pedido.edit', compact('itemPedido', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco' => 'required|numeric',
        ]);

        $itemPedido = ItemPedido::findOrFail($id);
        $pedido = $itemPedido->pedido;
        
        // Atualiza o valor total do pedido antes de modificar o item
        $pedido->valor_total -= $itemPedido->preco * $itemPedido->quantidade;

        $itemPedido->update($request->all());

        // Recalcula o valor total do pedido
        $pedido->valor_total += $itemPedido->preco * $itemPedido->quantidade;
        $pedido->save();

        return redirect()->route('pedido.show', $pedido->id)->with('success', 'Item atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $itemPedido = ItemPedido::findOrFail($id);
        $pedido = $itemPedido->pedido;

        // Atualiza o valor total do pedido antes de remover o item
        $pedido->valor_total -= $itemPedido->preco * $itemPedido->quantidade;
        $pedido->save();

        $itemPedido->delete();

        return redirect()->route('pedido.show', $pedido->id)->with('success', 'Item removido do pedido com sucesso!');
    }
}
