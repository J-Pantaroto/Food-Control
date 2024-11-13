<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        // Busca todos os pedidos com o relacionamento de cliente para exibir na listagem
        $pedidos = Pedido::with('cliente')->get();
        
        // Retorna a view de listagem dos pedidos
        return view('pedidos.index', compact('pedidos'));
    }
    public function show($id)
    {
        // Carrega o pedido pelo ID e carrega os itens associados e o cliente
        $pedido = Pedido::with('itensPedido.produto', 'cliente')->findOrFail($id);
        
        // Retorna a view com os detalhes do pedido
        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        // Carrega o pedido pelo ID e carrega os itens associados
        $pedido = Pedido::with('itensPedido.produto')->findOrFail($id);

        // Carrega a lista de clientes e produtos para os campos de seleção
        $clientes = Cliente::all();
        $produtos = Produto::all();

        // Retorna a view de edição
        return view('pedidos.edit', compact('pedido', 'clientes', 'produtos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('pedidos.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.preco' => 'required|numeric|min:0.01',
        ]);

        // Cria o pedido
        $pedido = Pedido::create([
            'cliente_id' => $request->cliente_id,
            'valor_total' => 0, // Vamos calcular o valor total abaixo
        ]);

        $valorTotal = 0;

        // Adiciona os itens ao pedido
        foreach ($request->itens as $item) {
            $itemPedido = new ItemPedido([
                'produto_id' => $item['produto_id'],
                'quantidade' => $item['quantidade'],
                'preco' => $item['preco'],
            ]);

            // Calcula o valor total do pedido
            $valorTotal += $item['preco'] * $item['quantidade'];

            $pedido->itensPedido()->save($itemPedido);
        }

        // Atualiza o valor total do pedido
        $pedido->update(['valor_total' => $valorTotal]);

        return redirect()->route('pedido.index')->with('success', 'Pedido e itens cadastrados com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.preco' => 'required|numeric|min:0.01',
        ]);

        // Encontra o pedido e atualiza o cliente
        $pedido = Pedido::findOrFail($id);
        $pedido->cliente_id = $request->cliente_id;
        $pedido->save();

        // Atualiza os itens do pedido
        $pedido->itensPedido()->delete(); // Remove os itens antigos
        $valorTotal = 0;

        foreach ($request->itens as $item) {
            $pedido->itensPedido()->create([
                'produto_id' => $item['produto_id'],
                'quantidade' => $item['quantidade'],
                'preco' => $item['preco'],
            ]);

            $valorTotal += $item['quantidade'] * $item['preco'];
        }

        // Atualiza o valor total do pedido
        $pedido->valor_total = $valorTotal;
        $pedido->save();

        return redirect()->route('pedido.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy($id)
    {
        // Carrega o pedido pelo ID
        $pedido = Pedido::findOrFail($id);

        // Exclui o pedido e seus itens associados
        $pedido->itensPedido()->delete(); // Remove todos os itens do pedido
        $pedido->delete(); // Remove o próprio pedido

        // Redireciona de volta para a lista de pedidos com uma mensagem de sucesso
        return redirect()->route('pedido.index')->with('success', 'Pedido excluído com sucesso!');
    }
}
