<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RelatoriosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $primeira_data = time();

        $scopes=['total', '411', '412'];

        foreach ($scopes as $scope) {
            $receitas[$scope.'_acumulado'] = $this->getFloatDataAcumulado('venda', $primeira_data, $scope=='total'?'':'and id_wbs='.$scope );
            $despesas[$scope.'_acumulado'] = $this->getFloatDataAcumulado('compra', $primeira_data, $scope=='total'?'':'and id_wbs='.$scope );
            $receitas[$scope.'_comparado'] = $this->getFloatDataBarras('venda', $primeira_data, $scope=='total'?'':'and id_wbs='.$scope );
            $despesas[$scope.'_comparado'] = $this->getFloatDataBarras('compra', $primeira_data, $scope=='total'?'':'and id_wbs='.$scope );
            $lucro[$scope] = $this->getFloatDataLucro($primeira_data, $scope=='total'?'':'and id_wbs='.$scope );
        }


//        $receitas['411_acumulado'] = $this->getFloatDataAcumulado('venda', $primeira_data, 'and id_wbs=411');
//        $despesas['411_acumulado'] = $this->getFloatDataAcumulado('compra', $primeira_data, 'and id_wbs=411');
//        $receitas['411_comparado'] = $this->getFloatDataBarras('venda', $primeira_data, 'and id_wbs=411');
//        $despesas['411_comparado'] = $this->getFloatDataBarras('compra', $primeira_data, 'and id_wbs=411');
//        $lucro['411'] = $this->getFloatDataLucro($primeira_data, 'and id_wbs=411');
//
//        $receitas['412_acumulado'] = $this->getFloatDataAcumulado('venda', $primeira_data, 'and id_wbs=411');
//        $despesas['412_acumulado'] = $this->getFloatDataAcumulado('compra', $primeira_data, 'and id_wbs=411');
//        $receitas['412_comparado'] = $this->getFloatDataBarras('venda', $primeira_data, 'and id_wbs=411');
//        $despesas['412_comparado'] = $this->getFloatDataBarras('compra', $primeira_data, 'and id_wbs=411');
//        $lucro['412'] = $this->getFloatDataLucro($primeira_data, 'and id_wbs=411');



        //dd($lucro);

        return view('relatorios.listar', compact(
            'receitas',
            'despesas',
            'lucro',
            'scopes',
            'primeira_data'
        ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    /**
     * @param $tipo
     * @param $primeira_data
     * @return string
     */
    private function getFloatDataAcumulado($tipo, &$primeira_data, $conditions ='')
    {
        $ordens = (new \App\OldOrder)->listarOrdens($tipo, $conditions);
        $soma = 0;
        $datas = array();
        $saida = '';
        foreach ($ordens as $ordem) {
            if ($ordem->data_termino < $primeira_data) $primeira_data = $ordem->data_termino;
            $soma = $soma + (is_object($ordem) ? $ordem->valor : 0);
            $datas[$ordem->data_termino] = $soma;
            //$saida=$saida."[".($ordem->data_termino*1000).", $soma],";
        }
        foreach ($datas as $key => $valor) {
            $saida = $saida . "[" . ($key * 1000) . ", $valor],";
        }
        return substr($saida, 0, -1);
    }


    /**
     * @param $tipo
     * @param $primeira_data
     * @return string
     */
    private function getFloatDataBarras($tipo, &$primeira_data, $conditions ='')
    {
        $ordens = (new \App\OldOrder)->listarOrdensResumidas($tipo, $conditions);
        $saida = '';
        foreach ($ordens as $ordem) {
//            if ($ordem->data_termino < $primeira_data) $primeira_data = $ordem->data_termino;
//            $saida=$saida."[".($ordem->data_termino*1000).", ".$ordem->valor."],";
            if (strtotime($ordem->data)<$primeira_data) $primeira_data=strtotime($ordem->data);
            $saida=$saida."[".(strtotime($ordem->data)*1000).", ".$ordem->valor."],";
        }
        return substr($saida, 0, -1);
    }

    /**
     * @param $tipo
     * @param $primeira_data
     * @return string
     */
    private function getFloatDataLucro(&$primeira_data, $conditions ='')
    {
        //$vendas = (new \App\OldOrder)->listarOrdensResumidas('vendas');
        //$compras = (new \App\OldOrder)->listarOrdensResumidas('compras');

        $ordens = (new \App\OldOrder)->listarOrdens('%', $conditions);
        //$soma = 0;
        $datas = array();
        $saida = '';
        foreach ($ordens as $ordem) {
            if ($ordem->data_termino < $primeira_data) $primeira_data = $ordem->data_termino;
            //$soma = $soma + (is_object($ordem) ? $ordem->valor : 0);
            $mes=mktime(null,null,null,date('m',$ordem->data_termino),1,date('Y',$ordem->data_termino));
            isset($datas[$mes])?:$datas[$mes]=0;
            $datas[$mes] = ($ordem->tipo=='venda' ? $datas[$mes]+$ordem->valor : ($ordem->tipo=='compra' ? $datas[$mes]-$ordem->valor : $datas[$mes]));
            //$saida=$saida."[".($ordem->data_termino*1000).", $soma],";
        }
        //dd($datas);
        foreach ($datas as $key => $valor) {
            $saida = $saida . "[" . ($key * 1000) . ", $valor],";
        }
        return substr($saida, 0, -1);
    }

}
