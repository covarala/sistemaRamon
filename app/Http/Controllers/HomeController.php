<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Users;
use App\User;
use App\Models\Endereco;
use App\Models\Fisica;
use App\Models\Juridica;
use App\Models\Produto;
use App\Models\ValorProduto;
use App\Models\Telefone;
use App\Models\ViewTelefone;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function produtos()
    {
        $produtos = DB::table('produto')->orderBy('nome', 'asc')->get();
        $valorProdutos = DB::table('valorproduto')->get();
        return view('admin.produtos',compact('produtos', 'valorProdutos'));
    }
    public function clientes()
    {
      $clientes = DB::table('users')->where('tipousuario','=','cliente')->orderBy('nome', 'asc')->get();
      $telefones = DB::table('telefonesusuarios')->get();

      return view('admin.clientes',compact('clientes', 'telefones'));
    }
    public function usuarios()
    {

      $usuarios = DB::table('users')->orderBy('nome', 'asc')->get();
        return view('admin.usuarios', compact('usuarios'));
    }
    public function distribuidor()
    {
        $distribuidores = DB::table('users')->where('tipousuario','=','distribuidor')->orderBy('nome', 'asc')->get();
        $telefones = ViewTelefone::all();

        return view('admin.distribuidor', compact('distribuidores', 'telefones'));
    }
    public function relatorio()
    {
        return view('admin.relatorio');
    }
    public function visaocliente()
    {
        return view('comuns.inicial');
    }
    public function visaodistribuidor()
    {
        return view('admin.visaodistribuidor');
    }

      public function viewAtualizaProduto($idProduto)
      {

        $valorProduto = ValorProduto::where('idProduto','=', "$idProduto")->first();
        $produto =  Produto::where('idProduto','=', "$idProduto")->first();
        return view('admin/atualiza/produto', compact('produto', 'valorProduto'));
      }

    public function updateProduto(Request $request)
    {
      $dadosValorProduto = [
        'idProduto' => $request->idProduto,
        'valor'  =>  $request->valorProduto,
      ];
      $dadosProduto = [
        'nome'  =>  $request->nome,
        'descricao'  =>  $request->descricao,
      ];
      $updateProduto = Produto::where('idProduto', '=', $request->idProduto)->update($dadosProduto);
      $updateValorProduto = ValorProduto::where('idProduto', '=', $request->idProduto)->update($dadosValorProduto);

      return redirect()->route('admin.produtos')->with('status', 'Editado com sucesso!');
    }

    public function atualizadistribuidor()
    {
      return null;
    }
    public function excluidistribuidor()
    {
      return null;
    }
}
