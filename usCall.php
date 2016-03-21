<?php

class usCall {
	
	public $graph, $taxMap, $originalCost;

	function __construct() {
		$this->graph = new graph();
		$this->taxMap = array();
		$this->originalCost = 0.5;
	}

	public function generateMap() {
		$this->graph->addEdges("NY", array("PA"));
	    $this->graph->addEdges("PA", array("WV", "VA", "OH"));
	    $this->graph->addEdges("OH", array("IN", "KY"));
	    $this->graph->addEdges("WV", array("OH", "KY"));
	    $this->graph->addEdges("VA", array("NC", "WV"));
	    $this->graph->addEdges("IN", array("IL", "KY"));
	    $this->graph->addEdges("IL", array("W1", "IA", "MO"));
	    $this->graph->addEdges("W1", array("MN", "IA"));
	    $this->graph->addEdges("IA", array("MN", "MO", "NE"));
	    $this->graph->addEdges("MN", array("ND", "SD", "IA"));
	    $this->graph->addEdges("MO", array("IA", "AR", "KS"));
	    $this->graph->addEdges("AR", array("MO", "LA", "OK"));
	    $this->graph->addEdges("LA", array("TX", "AR"));
	    $this->graph->addEdges("ND", array("MT", "SD"));
	    $this->graph->addEdges("SD", array("MT", "WY"));
	    $this->graph->addEdges("NE", array("WY", "CO"));
	    $this->graph->addEdges("KS", array("CO"));
	    $this->graph->addEdges("OK", array("TX", "NM", "KS"));
	    $this->graph->addEdges("TX", array("NM"));
	    $this->graph->addEdges("MT", array("WA","ID", "WY"));
	    $this->graph->addEdges("WY", array("MT","ID", "UT"));
	    $this->graph->addEdges("WY", array("MT","ID", "UT"));
	    $this->graph->addEdges("CO", array("WY", "UT", "NM"));
	    $this->graph->addEdges("NM", array("AZ", "CO"));
	    $this->graph->addEdges("ID", array("OR", "UT", "AZ"));
	    $this->graph->addEdges("UT", array("ID", "NV", "AZ"));
	    $this->graph->addEdges("AZ", array("UT", "CA"));
	    $this->graph->addEdges("NV", array("CA"));
	    $this->graph->addEdges("OR", array("CA"));
	    $this->graph->addEdges("WA", array("OR"));
	    $this->graph->addEdges("KY", array("TN", "MO"));
	    $this->graph->addEdges("NC", array("TN", "SC"));
	    $this->graph->addEdges("SC", array("GA", "TN"));
	    $this->graph->addEdges("GA", array("AL", "TN"));
	    $this->graph->addEdges("AL", array("MS", "TN"));
	    $this->graph->addEdges("TN", array("AL", "MS", "AR"));
	    $this->graph->addEdges("MS", array("LA", "AR"));
	}

	public function generateTaxMap() {
		foreach ($this->graph->adjacency as $key => $value) {
			$this->setTaxRate($key);
			
			array_map(function($v) {
				$this->setTaxRate($v);
			}, $value);
		}
	}

	public function setTaxRate($state) {
		if (empty($this->taxMap[$state])) {
			$this->taxMap[$state] = $this->generateRandomTaxRate();
		}
	}

	public function generateRandomTaxRate() {
		return rand(4, 6) / 100;
	}

	public function getSumOfTaxRate($path) {
		$sum = 0;
		
		foreach ($path as $v) {
			$sum += $this->taxMap[$v];
		}

		return $sum;
	}

	public function getPaths() {
		$paths = $this->graph->getPaths("NY", "CA");
		$solutions = array();
		$this->min = null;
		
		foreach ($paths as $path) {
			$cost = $this->originalCost * (1 + $this->getSumOfTaxRate($path));
			
			if (empty($this->min)) {
			    $this->min = $cost;
			}

			if ($this->min > $cost) {
				$this->min = $cost;
			}

			array_push($solutions, array(
				"path" => $path,
				"cost" => $cost
			));
		}
		
		$bestSolutions = array_filter($solutions, function($v) {
			return $v["cost"] <= $this->min;
		});

		return $bestSolutions;
	}
}