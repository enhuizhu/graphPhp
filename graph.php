<?php

interface graphInterface {
	public function addEdge($v1, $v2, $noDirection);
	public function addEdges($v1, $vArr);
	public function getPaths($start, $end);
}

class graph implements graphInterface{
	
	public $adjacency = array();

	public function addEdge($v1, $v2, $noDirection = false) {
		$this->addElementToAdjacency($v1, $v2);
		
		if ($noDirection) {
			$this->addElementToAdjacency($v2, $v1);
		}
	}

	public function addElementToAdjacency($v1, $v2) {
		if (empty($this->adjacency[$v1])) {
			$this->adjacency[$v1] = array();		
		}

		if (!in_array($v2, $this->adjacency[$v1])) {
			array_push($this->adjacency[$v1], $v2);
		}
	}

	public function addEdges($v1, $vArr) {
		foreach ($vArr as $key => $value) {
			$this->addEdge($v1, $value);
		}
	}

	public function getPaths($start, $end, $currentPath = array(), &$paths = array()) {
		//get all the adjacency of start
		if (empty($this->adjacency[$start])) {
			return ;
		}

		$newPath = $currentPath;
		array_push($newPath, $start);

		if (count($newPath) > 15) {
			return ;
		}

		foreach ($this->adjacency[$start] as $key => $value) {
			if ($value === $end) {
				array_push($newPath, $end);
				array_push($paths, $newPath);
			}else{
				$this->getPaths($value, $end, $newPath, $paths);
			}
		}

		return $paths;
	}
}
